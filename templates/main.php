<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start(); ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require("/home/ashduino101/ash.isonlykinda.gay/templates/style.php"); ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap" rel="stylesheet">

        <meta content="ashduino101" property="og:title">
        <meta content="<?php echo $desc; ?>" property="og:description">
        <meta content="https://ash.isonlykinda.gay" property="og:url">
        <meta content="https://ash.isonlykinda.gay/files/icons/icon_large.png" property="og:image">
        <meta content="#07C900" data-react-helmet="true" name="theme-color">
    </head>
    <body>
        <header>
            <span class="title">ashduino101</span><br>
            <span class="buttons-span">
                <span class="buttons">
                    <button class="btn" onclick="window.location = '/log4j'">test</button>
                    <button class="btn" onclick="window.location = '/about'">asdfghjk</button>
                    <button class="btn" onclick="window.location = '/about'">another btn</button>
                    <button class="btn" onclick="window.location = '/about'">s</button>
                </span>
            </span>
        </header>
        <?php echo $body ?>
        <footer>
            <a href="https://www.youtube.com/channel/UCe7-maWifLXQKcAAGLP70FQ">
                <h4>YouTube</h4>
            </a>
            <a href="https://www.github.com/ashduino101">
                <h4>Github</h4>
            </a>
            <a href="https://www.reddit.com/user/ashduino101">
                <h4>Reddit</h4>
            </a>
            <a href="https://steamcommunity.com/profiles/76561199035878909">
                <h4>Steam</h4>
            </a>
            <h4>© 2021 ashduino101</h4>
            <h4>Big thanks to Cinnamon for making this website possible!</h4>
        </footer>
    </body>
</html>
