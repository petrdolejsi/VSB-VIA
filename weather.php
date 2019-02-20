<?php
    header('Access-Control-Allow-Origin: *');
    if (isset($_GET["lng"])&&isset($_GET["lat"])) {
        $units = "";
        if (isset($_GET["units"])) {
            if ($_GET["units"]!="") {
                $units="&units=".$_GET["units"];
            }
        }
        //echo "http://api.openweathermap.org/data/2.5/weather?lon=" . $_GET["lng"] . "&lat=" . $_GET["lat"] . "&APPID=8bf7893fe41541dc38f3abd57fc1de32&lang=cz".$units;
        $json = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?lon=" . $_GET["lng"] . "&lat=" . $_GET["lat"] . "&APPID=key&lang=".$_GET["language"].$units), true);
        if (isset($_GET["id"])) {
            $json['myID'] = $_GET["id"];
        }
        echo json_encode($json);
    }
?>