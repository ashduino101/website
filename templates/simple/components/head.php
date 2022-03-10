
    <title><?php echo $pageName ?> - <?php echo $siteName ?></title>
    <script type="text/javascript">
    cookiePrefix = "/";
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <script type="text/javascript" src="https://dumbserg.al/forum/jscripts/jquery.js?ver=1820"></script>
    <script type="text/javascript" src="https://dumbserg.al/forum/jscripts/jquery.plugins.min.js?ver=1820"></script>
    <script type="text/javascript" src="https://dumbserg.al/forum/jscripts/general.js?ver=1820"></script>
    <link type="text/css" rel="stylesheet" href="https://dumbserg.al/templates/simple/css3.css">
    <link type="text/css" rel="stylesheet" href="https://dumbserg.al/templates/simple/global.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    <script type="text/javascript">
    jQuery(function($) {
        $("#backtop").hide();
        $(window).scroll(function () {
        if ($(this).scrollTop() > 400) {
            $("#backtop").fadeIn(160);
        } else {
            $("#backtop").fadeOut(160);
        }
        });
    $('.backtop').on( "click", function () {
        $('html, body').animate({
            scrollTop: 0
        }, 650);
        return false;
    });
    });
    jQuery(function($) {
        $(".leftbutton").hide();
        $(".rightbutton").on("click", function() {
            $(".sidebar").animate({
                height: "hide",
                opacity: 0
            }, 150, function() {
                $(".forums").animate({
                    width: "100%"
                }, 400)
            });
            $(this).hide();
            $(".leftbutton").show();
            Cookie.set("sidebar", "collapsed", 60 * 60 * 24 * 365);
            return false;
        });
        $(".leftbutton").on("click", function() {
            $(".forums").animate({
                width: "76%"
            }, 400, function() {
                $(".sidebar").animate({
                    height: "show",
                    opacity: 1
                }, 150)
            });
            $(this).hide();
            $(".rightbutton").show();
            Cookie.set("sidebar", "expanded", 60 * 60 * 24 * 365);
            return false;
        });
        if (Cookie.get("sidebar") == "collapsed") {
            $(".rightbutton").hide();
            $(".leftbutton").show();
            $(".forums").css("width", "100%");
            $(".sidebar").hide();
        }
        if ($(".forums").length < 1) $(".toggle-container").hide();
    });
    </script>
