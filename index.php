<!DOCTYPE html>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <?php
    // hopefully this is fine
    define("IN_MYBB", 1);
    require "./forum/global.php";
    require "./inc/init.php";
    ?>
    <head>
    <?php
    out_head("Home");
    ?>
    </head>
    <body>
        <div id="container">
            <a name="top" id="top"></a>
            <div id="logo">
                <div class="wrapper">
                    <a href="/"><img src="../assets/logo.png" title="Return home"></a>
                </div>
            </div>
            <div id="header">
                <div id="panel">
                    <div class="upper">
                        <div class="wrapper">
                            <div class="float_left">
                                <?php if ($mybb->user["guest"]) { ?>
                                <span>Welcome, guest!</span>
                                <a href=""><span class="login-btn">Log in</span></a><a href=""><span class="register-btn">Register</span></a>
                                <?php } else { ?>
                                <a href="" id="ddnmenu"><span>Welcome back, <?php echo $mybb->user["username"]; ?>!</span></a>
                                <a href=""><span class="logout-btn">Log out</span></a>
                                <?php } ?>
                            </div>
                            <ul class="menu top_links float_right">
                                <li><a href="https://dumbserg.al/forum/">Forums</a></li>
                                <li><a href="https://dumbserg.al/forum/search">Search</a></li>
                                <li><a href="https://dumbserg.al/forum/memberlist">Member List</a></li>
                                <li><a href="https://dumbserg.al/forum/calendar">Calendar</a></li>
                                <li><a href="https://dumbserg.al/pages/about">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="wrapper">
                    <?php
                    out_section(
                        "Projects",
                        array(
                            "OStat" => array(
                                "desc" => "Online Sequencer Sequence Statistics",
                                "url" => "/project/ostat"
                            )
                        )
                    );
                    ?>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <h1>More coming soon!</h1>
                </div>
                <a class="backtop"><span id="backtop" style="display: none;"><i class="fa fa-angle-up arr-adj"></i></span></a>
                <?php
                out_footer();
                ?>
            </div>
        </div>
    </body>
</html>