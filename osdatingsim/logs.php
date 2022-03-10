<?php
include_once("inc/simple_html_dom.php");
include_once("inc/html2text.php");
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "Cookie: mybbuser=62259_PCF7EseSeoBsD9zhhZ0rWIvH0dngpnxNajhbTOkCcv7X0eRUXr"
    ]
];
$context = stream_context_create($opts);

if (isset($_POST)) {
    if ($_POST["mode"] == "users") {
        $html = str_get_html(file_get_contents("https://onlinesequencer.net/logs?search=".$_POST["search"]."&submit=Search+Users", false, $context));
    } else if ($_POST["mode"] == "messages") {
        $html = str_get_html(file_get_contents("https://onlinesequencer.net/logs?search=".$_POST["search"]."&submit=Search+Messages", false, $context));
    } else {
        echo "Error";
        exit();
    }
    foreach($html->find('div.chat') as $element) {
        $h2t = new Html2Text\Html2Text($element->find("div.message")[0]->innertext);
        echo str_replace(" ", " at ", str_replace("→ ", "", $element->find("div.info span.date a")[0]->innertext));
        echo "<br>";
        echo $h2t->getText();
        echo "<br>";
    }
}
?>
