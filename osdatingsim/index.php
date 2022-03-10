<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="js/jquery.min.js"></script>
    <style>
    body {
        margin: 0;
    }
    </style>
</head>
<body>
    <div id="container"></div>
    <script type="module">
    import * as THREE from 'https://cdn.skypack.dev/three@0.137';
    import { Stats } from 'https://unpkg.com/three@0.138.3/examples/jsm/libs/stats.module.js';
    import { ImprovedNoise } from 'https://unpkg.com/three@0.138.3/examples/jsm/math/ImprovedNoise.js';
    import { Water } from 'https://unpkg.com/three@0.138.3/examples/jsm/objects/Water.js';
    import { Sky } from 'https://unpkg.com/three@0.138.3/examples/jsm/objects/Sky.js';
    import { PointerLockControls } from 'https://unpkg.com/three@0.138.3/examples/jsm/controls/PointerLockControls.js';
    let moveForward = false;
    let moveBackward = false;
    let moveLeft = false;
    let moveRight = false;
    let moveUp = false;
    let moveDown = false;

    let water, sun;

    let prevTime = performance.now();
    const velocity = new THREE.Vector3();
    const direction = new THREE.Vector3();
    const vertex = new THREE.Vector3();
    const color = new THREE.Color();
    let container, stats;
    let camera, controls, scene, renderer;
    let mesh, texture;
    const worldWidth = 256, worldDepth = 256;
    const clock = new THREE.Clock();
    init();
    animate();
    function init() {
        container = document.getElementById( 'container' );

        camera = new THREE.PerspectiveCamera( 60, window.innerWidth / window.innerHeight, 1, 10000 );

        scene = new THREE.Scene();
        scene.background = new THREE.Color( 0xefd1b5 );
        // scene.fog = new THREE.FogExp2( 0xefd1b5, 0.001 );

        const data = generateHeight( worldWidth, worldDepth );

        camera.position.set( 100, 800, - 800 );
        camera.lookAt( - 100, 810, - 800 );

        const geometry = new THREE.PlaneGeometry( 10000, 10000, worldWidth - 1, worldDepth - 1 );
        geometry.rotateX( - Math.PI / 2 );
        const vertices = geometry.attributes.position.array;
        for ( let i = 0, j = 0, l = vertices.length; i < l; i ++, j += 3 ) {
            vertices[ j + 1 ] = data[ i ] * 10;
        }

        container.addEventListener('click', function () {controls.lock();});

        sun = new THREE.Vector3();
        const waterGeometry = new THREE.PlaneGeometry( 10000, 10000 );
        water = new Water(
            waterGeometry,
            {
                textureWidth: 512,
                textureHeight: 512,
                waterNormals: new THREE.TextureLoader().load('images/waternormals.jpg', function (texture) {
                    texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                } ),
                sunDirection: new THREE.Vector3(),
                sunColor: 0xffffff,
                waterColor: 0x001e0f,
                distortionScale: 3.7,
                fog: scene.fog !== undefined
            }
        );
        water.position.y += 192;
        water.rotation.x = - Math.PI / 2;
        scene.add( water );

        const sky = new Sky();
        sky.scale.setScalar( 10000 );
        scene.add( sky );
        const skyUniforms = sky.material.uniforms;

        skyUniforms[ 'turbidity' ].value = 10;
        skyUniforms[ 'rayleigh' ].value = 2;
        skyUniforms[ 'mieCoefficient' ].value = 0.005;
        skyUniforms[ 'mieDirectionalG' ].value = 0.8;

        const parameters = {
            elevation: 2,
            azimuth: 180
        };

        renderer = new THREE.WebGLRenderer();
        renderer.setPixelRatio( window.devicePixelRatio );
        renderer.setSize( window.innerWidth, window.innerHeight );
        renderer.toneMapping = THREE.ACESFilmicToneMapping;

        const pmremGenerator = new THREE.PMREMGenerator(renderer);

        function updateSun() {
            const phi = THREE.MathUtils.degToRad( 90 - parameters.elevation );
            const theta = THREE.MathUtils.degToRad( parameters.azimuth );
            sun.setFromSphericalCoords( 1, phi, theta );
            sky.material.uniforms[ 'sunPosition' ].value.copy( sun );
            water.material.uniforms[ 'sunDirection' ].value.copy( sun ).normalize();
            scene.environment = pmremGenerator.fromScene( sky ).texture;
        }

        updateSun();

        texture = new THREE.CanvasTexture( generateTexture( data, worldWidth, worldDepth ) );
        texture.wrapS = THREE.ClampToEdgeWrapping;
        texture.wrapT = THREE.ClampToEdgeWrapping;
        mesh = new THREE.Mesh( geometry, new THREE.MeshBasicMaterial( { map: texture } ) );
        scene.add( mesh );

        container.appendChild( renderer.domElement );
        stats = new Stats();
        container.appendChild( stats.dom );

        window.addEventListener( 'resize', onWindowResize );

        controls = new PointerLockControls( camera, renderer.domElement );
        scene.add(controls.getObject());
        const onKeyDown = function ( event ) {
            switch ( event.code ) {
                case 'ArrowUp':
                case 'KeyW':
                    moveForward = true;
                    break;
                case 'ArrowLeft':
                case 'KeyA':
                    moveLeft = true;
                    break;
                case 'ArrowDown':
                case 'KeyS':
                    moveBackward = true;
                    break;
                case 'ArrowRight':
                case 'KeyD':
                    moveRight = true;
                    break;
                case 'Space':
                    moveUp = true;
                    break;
                case 'ShiftLeft':
                case 'ShiftRight':
                    moveDown = true;
                    break;
            }
        }
        const onKeyUp = function ( event ) {
            switch ( event.code ) {
                case 'ArrowUp':
                case 'KeyW':
                    moveForward = false;
                    break;
                case 'ArrowLeft':
                case 'KeyA':
                    moveLeft = false;
                    break;
                case 'ArrowDown':
                case 'KeyS':
                    moveBackward = false;
                    break;
                case 'ArrowRight':
                case 'KeyD':
                    moveRight = false;
                    break;
                case 'Space':
                    moveUp = false;
                    break;
                case 'ShiftLeft':
                case 'ShiftRight':
                    moveDown = false;
                    break;
            }
        }
        document.addEventListener( 'keydown', onKeyDown );
        document.addEventListener( 'keyup', onKeyUp );
    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize( window.innerWidth, window.innerHeight );
    }

    function generateHeight( width, height ) {
        let seed = Math.random();
        window.Math.random = function () {
            const x = Math.sin( seed ++ ) * 100000;
            return x - Math.floor( x );
        };
        const size = width * height, data = new Uint8Array( size );
        const perlin = new ImprovedNoise(), z = Math.random() * 100;
        let quality = 1;
        for ( let j = 0; j < 4; j ++ ) {
            for ( let i = 0; i < size; i ++ ) {
                const x = i % width, y = ~ ~ ( i / width );
                data[ i ] += Math.abs( perlin.noise( x / quality, y / quality, z ) * quality * 1.75 );
            }
            quality *= 5;
        }
        return data;
    }
    function generateTexture( data, width, height ) {
        let context, image, imageData, shade;
        const vector3 = new THREE.Vector3( 0, 0, 0 );
        const sun = new THREE.Vector3( 1, 1, 1 );
        sun.normalize();
        const canvas = document.createElement( 'canvas' );
        canvas.width = width;
        canvas.height = height;
        context = canvas.getContext( '2d' );
        context.fillStyle = '#000';
        context.fillRect( 0, 0, width, height );
        image = context.getImageData( 0, 0, canvas.width, canvas.height );
        imageData = image.data;
        for ( let i = 0, j = 0, l = imageData.length; i < l; i += 4, j ++ ) {
            vector3.x = data[ j - 2 ] - data[ j + 2 ];
            vector3.y = 2;
            vector3.z = data[ j - width * 2 ] - data[ j + width * 2 ];
            vector3.normalize();
            shade = vector3.dot( sun );
            imageData[ i ] = ( 16 + shade * 128 ) * ( 0.5 + data[ j ] * 0.007 );
            imageData[ i + 1 ] = ( 64 + shade * 96 ) * ( 0.5 + data[ j ] * 0.007 );
            imageData[ i + 2 ] = ( shade * 96 ) * ( 0.5 + data[ j ] * 0.007 );
        }
        context.putImageData( image, 0, 0 );
        const canvasScaled = document.createElement( 'canvas' );
        canvasScaled.width = width * 4;
        canvasScaled.height = height * 4;
        context = canvasScaled.getContext( '2d' );
        context.scale( 4, 4 );
        context.drawImage( canvas, 0, 0 );
        image = context.getImageData( 0, 0, canvasScaled.width, canvasScaled.height );
        imageData = image.data;
        for ( let i = 0, l = imageData.length; i < l; i += 4 ) {
            const v = ~ ~ ( Math.random() * 5 );
            imageData[ i ] += v;
            imageData[ i + 1 ] += v;
            imageData[ i + 2 ] += v;
        }
        context.putImageData( image, 0, 0 );
        return canvasScaled;
    }
    function animate() {
        requestAnimationFrame( animate );
        const time = performance.now();
        if ( controls.isLocked === true ) {
            const delta = ( time - prevTime ) / 1000;
            velocity.x -= velocity.x * 10 * delta;
            velocity.y -= velocity.y * 10 * delta;
            velocity.z -= velocity.z * 10 * delta;
            direction.z = Number( moveForward ) - Number( moveBackward );
            direction.y = Number( moveDown ) - Number( moveUp );
            direction.x = Number( moveRight ) - Number( moveLeft );
            direction.normalize();
            if ( moveForward || moveBackward ) velocity.z -= direction.z * 8000 * delta;
            if ( moveLeft || moveRight ) velocity.x -= direction.x * 8000 * delta;
            if ( moveDown || moveUp ) velocity.y -= direction.y * 8000 * delta;
            controls.moveRight( - velocity.x * delta );
            controls.moveForward( - velocity.z * delta );
            controls.getObject().position.y += ( velocity.y * delta );
        }
        prevTime = time;
        water.material.uniforms[ 'time' ].value += 1.0 / 60.0;
        render();
        stats.update();
    }


    function render() {
        renderer.render( scene, camera );
    }


    </script>
</body>
</html>
