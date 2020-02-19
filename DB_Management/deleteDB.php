<?php

$msg = "everything alright";
$err = "0";
$result = false;

require_once "doesDBExistTmp.php";

if($exist==1){
    require_once "../functions.php";
    
    //Database suppression
    
    $name = "hopital";
    
    $result = queryRequest("DROP DATABASE $name");
    if($result!=1){
        $msg = "an error occured";
        $err = "1";
    }
} else {
    $msg = "database does not exist";
    $err = "2";
}


$res = ['msg' => $msg, 'err' => $err, 'result' => $result];
echo json_encode($res);

?>