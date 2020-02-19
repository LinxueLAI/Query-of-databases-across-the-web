<?php

$err = "0";
$msg = "";
$request = "";
$result = "";

$table = $_GET['table'];
$file = "../CSV/" .  $_GET['file'];

require_once "../functions.php";

if ($handle = fopen($file, "r")) {
    while ($row = fgetcsv($handle, 1000, ";")) {
        $params =  "'" . implode("','", $row) . "'";
        $request = "INSERT INTO ".$table." VALUES (".$params.")";
        $msg = "successfully added";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "1";
            break;
        }
    }
    fclose($handle);
}

$res = ['err' => $err, 'msg' => $msg, 'request' => $request];
echo json_encode($res);  

?>