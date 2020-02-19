<?php

function isTable($current, $actual){
    return strcasecmp($current, $actual) == 0;
}

function tableLength($table) {
    $cmpMed = isTable($table, "Medecin");
    $cmpInf = isTable($table, "Infirmier");
    $cmpPat = isTable($table, "Patient");
    $cmpServ = isTable($table, "Service");
    $cmpSal = isTable($table, "Salle");
    $cmpHosp = isTable($table, "Hospitalisation");
    $cmpAct = isTable($table, "Acte");

    if($cmpMed) {
        return 3;
    } else if ($cmpInf || $cmpPat || $cmpServ || $cmpSal){
        return 4;
    } else if ($cmpHosp || $cmpAct){
        return 5;
    } else {
        return 0;
    }
}

function isEmptyRow($row, $beginInd, $length){
    for($i = $beginInd; $i < $beginInd+$length; $i++){
        if (strcmp($row[$i], "") != 0){
            return FALSE;
        }
    }
    return TRUE;
}

function whichSep($file, $length){
    if ($handle = fopen($file, "r")) {
        $rows = fgetcsv($handle, 10000, "\r");
        $tmp1 = count($rows);
    } else {
        return "err";
    }
    fclose($handle);
    if ($handle = fopen($file, "r")) {
        $rows = fgetcsv($handle, 10000, ";");
        $tmp2 = count($rows);
    } else {
        return "err";
    }
    fclose($handle);
    if($tmp2 == $length && $tmp1 == 1){
        return ";";
    } else {
        return "\r";
    }
}

function processRows($rows, $table){
    $rowsBegInd = 0; 
    $rowBegInd = 0;
    $err = FALSE;
    for($i = 0; $i<count($rows);$i++){
        $rows[$i] = explode(";", $rows[$i]);
        for($j = 0; $j<count($rows[$i]); $j++){
            if(isTable($rows[$i][$j],$table)){
                if(!$err && $rowsBegInd == 0){
                    $rowsBegInd = $i;
                    $rowBegInd = $j+1;
                } else {
                    $err = TRUE;
                }
            }
        }
    }
    $rowsInitialLen = count($rows);
    $tableLen = tableLength($table);
    $rowsEndInd = $rowsBegInd;
    while(!isEmptyRow($rows[$rowsEndInd],$rowBegInd,$tableLen) && $rowsEndInd < $rowsInitialLen){
        $rowsEndInd++;
    }
    $rowsLen = $rowsEndInd - $rowsBegInd;
    $result = array_slice($rows, $rowsBegInd, $rowsLen);
    for($i = 0; $i<$rowsLen; $i++){
        $result[$i] = array_slice($result[$i], $rowBegInd, $tableLen);
    }

    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";

    // echo $rowsBegInd . "<br>";
    // echo $rowsEndInd . "<br>";
    // echo $rowBegInd . "<br>";

    return $result;
}

function sep_pv($file, $table, $length){
    if ($handle = fopen($file, "r")) {
        while ($row = fgetcsv($handle, 1000, ";")) {
            for($i = 0; $i<count($row);$i++){
                $row[$i] = fix_string($row[$i]);
            }
            $params =  "'" . implode("','", $row) . "'";

            echo "Try to import : (".$params.") <br>";
  
            if(!isHeader($params)){
                $request = "INSERT INTO ".$table." VALUES (".$params.")";
                $result = queryRequest($request);
                
                if ($result === TRUE) {
                  echo "<B> Successfully imported </B> <br><br>";
                } else {
                  echo $result." <br> <font color='red'> <B> Failed to import </B> </font> <br><br>";
                }
            } else {
              echo "<font color='red'> <B> is header </B> </font><br><br>";
            }
        }
        fclose($handle);
    }
}

function buildRows($handle){
    $count = 0;
    $rows = [];
    while ($row = fgetcsv($handle, 10000, "\r")){
        if(count($row)==1){
            $rows[$count ++] = $row[0];
        } else {
            return $row;
        }
    }
    return $rows;
}

function sep_r($file, $table, $length){

    $count = 0;

    if ($handle = fopen($file, "r")) {
        $rows = buildRows($handle);
        $nbValPerRow = count(explode(";", $rows[0]));
  
        if($nbValPerRow!=$length){
          $rows = processRows($rows, $table);
          echo "hey";
        }
  
        for($i = 0; $i<count($rows);$i++){
          if ($nbValPerRow==$length){
            $row = explode(";", $rows[$i]);
          } else {
            $row = $rows[$i];
          }
          for($j = 0; $j<count($row);$j++){
            $row[$j] = fix_string($row[$j]);
          }
  
          $params =  "'" . implode("','", $row) . "'";
  
          echo "Try to import : (".$params.") <br>";
  
          if(!isHeader($params)){
              $request = "INSERT INTO ".$table." VALUES (".$params.")";
              $result = queryRequest($request);
              $count++;
              
              if ($result === TRUE) {
                echo "<B> Successfully imported </B> <br><br>";
              } else {
                echo $result." <br> <font color='red'> <B> Failed to import </B> </font> <br><br>";
              }
          } else {
            echo "<font color='red'> <B> is header </B> </font><br><br>";
          }
        }
    }
    fclose($handle);

    return $count;
}


?>