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
                                <li><a href="https://dumbserg.al/about">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>