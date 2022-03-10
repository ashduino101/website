<!DOCTYPE html>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <?php
    // this is probably fine since this is using mybb but somebody tell me if it isn't
    define("IN_MYBB", 1);
    require "../forum/global.php";

    require "../inc/init.php";
    ?>
    <head>
    <?php
    out_head("OStat");
    ?>
    <script src="https://onlinesequencer.net/resources/google-protobuf.js"></script>
    <script src="https://onlinesequencer.net/proto/js/instrumentsettings.js"></script>
    <script src="https://onlinesequencer.net/proto/js/marker.js"></script>
    <script src="https://onlinesequencer.net/proto/js/note.js"></script>
    <script src="https://onlinesequencer.net/proto/js/notetype.js"></script>
    <script src="https://onlinesequencer.net/proto/js/sequence.js"></script>
    <script src="https://onlinesequencer.net/proto/js/sequencesettings.js"></script>
    <script src="https://onlinesequencer.net/app/consoleCommands.js"></script>
    <link rel="stylesheet" href="style-custom.css">
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
                                <li><a href="https://dumbserg.al/about">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
	        <div id="content">
		        <div class="wrapper">
                    <div class="project-desc">
                        <h1>OStat</h1>
                        <h1>UNFINISHED: CURRENTLY DOES NOT FUNCTION</h1>
                        <p>OStat is a utility that allows you to analyze and generate statistical reports on OnlineSequencer sequences. To use, simply upload a sequence or enter the URL of one.</p>
                    </div>
                    <?php
                    if (isset($_FILES['file'])) {
                        $uploaddir = "uploads/";
                        $uploadfile = $uploaddir.basename($_FILES['file']['name']);

                        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                            echo "The file has been uploaded successfully";
                        } else {
                            echo "There was an error uploading the file";
                        }
                    }
                    ?>

                    <form id="sequence-stat-in" action="" method="post" enctype="multipart/form-data">
                        <label class="file-in">
                            <input id="sequence-in" type="file" name="file" accept=".sequence">Upload sequence&nbsp;</input>
                            <button type="submit">Generate Statistics</button>
                        </label>
                    </form>
                </div>
                <a class="backtop"><span id="backtop" style="display: none;"><i class="fa fa-angle-up arr-adj"></i></span></a>
                <?php
                out_footer();
                ?>
            </div>
        </div>
    </body>
</html>