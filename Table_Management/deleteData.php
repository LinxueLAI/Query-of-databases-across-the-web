<?php

    require_once "../functions.php";

    $err = "0";
    $msg = "";
    $request = "";
    $result = "";

    $table = $_GET['table'];
    $lengthId = $_GET['lengthId'];

    if($lengthId == 1){
        $id0 = $_GET['id0'];
        $name0 = $_GET['name0'];

        $request = "DELETE FROM ".$table." WHERE ".$name0."='$id0'";
        $msg = "successfully deleted";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if ($lengthId == 2){
        $id0 = $_GET['id0'];
        $name0 = $_GET['name0'];
        $id1 = $_GET['id1'];
        $name1 = $_GET['name1'];

        $request = "DELETE FROM ".$table." WHERE ".$name0."='$id0' AND ".$name1."='$id1'";
        $msg = "successfully deleted";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if ($lengthId == 3){
        $id0 = $_GET['id0'];
        $name0 = $_GET['name0'];
        $id1 = $_GET['id1'];
        $name1 = $_GET['name1'];
        $id2 = $_GET['id2'];
        $name2 = $_GET['name2'];

        $request = "DELETE FROM ".$table." WHERE ".$name0."='$id0' AND ".$name1."='$id1'AND ".$name2."='$id2'";
        $msg = "successfully deleted";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else {
        $msg = "an error occured";
        $err = "1";
    }


    
    $res = ['err' => $err, 'msg' => $msg, 'request' => $request];
    echo json_encode($res);        

?>