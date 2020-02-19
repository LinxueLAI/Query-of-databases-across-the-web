<?php

    require_once "../functions.php";

    $err = "0";
    $msg = "";
    $request = "";
    $result = "";

    $table = $_GET['table'];
    $lengthId = $_GET['lengthId'];
    $length = $_GET['length'];

    if($table == "Service"){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);
        $id0 = $_GET['id0'];

        $request = "UPDATE ".$table." SET NumService = '$param0', Nom = '$param1', Batiment = '$param2', NumMed = '$param3' WHERE ".$_GET['name0']."='$id0'";
        $msg = "successfully updated";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if($table == "Salle"){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);
        $id0 = $_GET['id0'];
        $id1 = $_GET['id1'];

        $request = "UPDATE ".$table." SET NumSalle = '$param0', NumServ = '$param1', Nblits = '$param2', NumInf = '$param3' WHERE ".$_GET['name0']."='$id0' AND ".$_GET['name1']."='$id1'";
        $msg = "successfully updated";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if($table == "Infimier"){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);
        $id0 = $_GET['id0'];
        
        $request = "UPDATE ".$table." SET NumInf = '$param0', Nom = '$param1', Adresse = '$param2', Telephone = '$param3' WHERE ".$_GET['name0']."='$id0'";
        $msg = "successfully updated";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if($table == "Patient"){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);
        $id0 = $_GET['id0'];

        $request = "UPDATE ".$table." SET NumPat = '$param0', Nom = '$param1', Prenom = '$param2', Mutuelle = '$param3' WHERE ".$_GET['name0']."='$id0'";
        $msg = "successfully updated";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if($table == "Medecin"){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $id0 = $_GET['id0'];

        $request = "UPDATE ".$table." SET NumMed = '$param0', nom = '$param1', Specialite = '$param2' WHERE ".$_GET['name0']."='$id0'";        $msg = "successfully updated";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if($table == "Hospitalisation"){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);
        $param4 = fix_string($_GET['param4']);
        $id0 = $_GET['id0'];
        $id1 = $_GET['id1'];
        $id2 = $_GET['id2'];
    
        $request = "UPDATE ".$table." SET NumPat = '$param0', DateEntree = '$param1', NumSalle = '$param2', NumService = '$param3', DateSortie = '$param4' WHERE ".$_GET['name0']."='$id0' AND ".$_GET['name1']."='$id1' AND ".$_GET['name2']."='$id2'";
        $msg = "successfully updated";
        $result = queryRequest($request);
        if($result!=1){
            $msg = $result;
            $err = "2";
        }
    } else if($table == "Acte"){
        $param0 = fix_string($_GET['param0']);
        $param1 = fix_string($_GET['param1']);
        $param2 = fix_string($_GET['param2']);
        $param3 = fix_string($_GET['param3']);
        $param4 = fix_string($_GET['param4']);
        $id0 = $_GET['id0'];
        $id1 = $_GET['id1'];
        $id2 = $_GET['id2'];
        
        $request = "UPDATE ".$table." SET NumMed = '$param0', NumPat = '$param1', DateActe = '$param2', NumService = '$param3', Description = '$param4' WHERE ".$_GET['name0']."='$id0' AND ".$_GET['name1']."='$id1' AND ".$_GET['name2']."='$id2'";
        $msg = "successfully updated";
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