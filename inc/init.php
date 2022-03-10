<?php
// these were private settings, but I'm relying on MyBB for the most part now, if I ever need to use credentials, I'd use exports or external files
// require __DIR__."/config.php";
require __DIR__."/settings.php";

$COMPDIR = $_SERVER["DOCUMENT_ROOT"]."/templates/simple/components";

function out_head($pageName) {
    global $COMPDIR;
    global $siteName;
    require $COMPDIR."/head.php";
}

function out_section($name, $items) {
    echo '
    <table class="tborder" cellspacing="0" cellpadding="5" border="0">
    <thead>
        <tr>
            <td class="thead" colspan="5">
                <div><strong>'.$name.'</strong><br><div class="smalltext clr_lgh"></div></div>
            </td>
        </tr>
    </thead>
    <tbody id="cat_1_e">';
    foreach ($items as $item => $details) {
        echo '

                    <tr>
                        <td class="trow1" style="white-space: nowrap;" align="left">
                            <a href='.$details["url"].'><span>'.$item.'</span></a>
                        </td>
                        <td style="white-space: nowrap;" align="right" class="item-desc">
                            <span>'.$details["desc"].'</span>
                        </td>
                    </tr>';
        }
    echo '
            </tbody>
        </table>
    <br>';
}

function out_header() {
    global $COMPDIR;
    require $COMPDIR."/header.php";
}

function out_footer() {
    global $COMPDIR;
    require $COMPDIR."/footer.php";
}


?>
