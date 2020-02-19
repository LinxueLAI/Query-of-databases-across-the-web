<?php

    require_once "../functions.php";

    $err = "0";
    $text = "";

    $date = $_GET['date'];

    $sql = "SELECT p.Nom, p.Prenom FROM patient AS p JOIN hospitalisation AS h ON p.NumPat=h.NumPat WHERE h.DateEntree = '$date'";
    $result = queryRequest($sql);
    $nbRows = $result->num_rows;

    if($nbRows==0){
        $text = "Aucun résultats";
    } else {
        $text = "<table><tr><td><B>Nom</B></td><td><B>Prenom</B></td></tr>";
        for($i=0; $i<$nbRows;$i++){
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_NUM);
            $text .= "<tr>";
            for($j=0; $j<count($row);$j++){
                $text .= "<td>".$row[$j]."</td>";
            }
            $text .= "</tr>";
        }
        $text .= "</table>"; 
    }
    
    echo json_encode(['err' => $err, 'text' => $text]);

?>