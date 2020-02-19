<?php

    require_once "../functions.php";

    $err = "0";
    $msg = "";
    $request = "";
    $result = "";

    $length = $_GET['length'];
    $table = $_GET['table'];

    if($length == 3){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);

        if($param0 != "" && $param1 != "" && $param2 != ""){
            $request = "INSERT INTO ".$table." VALUES ('$param0','$param1','$param2')";
            $msg = "successfully added";
            $result = queryRequest($request);
            if($result!=1){
                $msg = $result;
                $err = "1";
            }
        }
        else{
            $msg = "empty field";
            $err = "2";
        }

    }else if($length == 4){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);

        if($param0 != "" && $param1 != "" && $param2 != "" && $param3 != ""){
            $request = "INSERT INTO ".$table." VALUES ('$param0','$param1','$param2','$param3')";
            $msg = "successfully added";
            $result = queryRequest($request);
            if($result!=1){
                $msg = $result;
                $err = "1";
            }
        }
        else{
            $msg = "empty field";
            $err = "2";
        }        

    }else if($length == 5){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);
        $param4 = fix_string($_GET['param4']);

        if($param0 != "" && $param1 != "" && $param2 != "" && $param3 != "" && $param4 != ""){
            $request = "INSERT INTO ".$table." VALUES ('$param0','$param1','$param2','$param3','$param4')";
            $msg = "successfully added";
            $result = queryRequest($request);
            if($result!=1){
                $msg = $result;
                $err = "1";
            }
        }
        else{
            $msg = "empty field";
            $err = "2";
        }     

    }else {
        $err = "1";
        $msg = "an error occured";
    }
    
    $res = ['err' => $err, 'msg' => $msg, 'request' => $request];
    echo json_encode($res);        

?>