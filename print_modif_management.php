<?php 

require_once "functions.php";

$text = "";

$table = $_GET["table"];
$mode = $_GET["mode"];

if ($mode == "insert"){
    $text .= "<h3>Insertion de données</h3>";
} else if ($mode == "update"){
    $text .= "<h3>Mise à jour de données</h3>";
} else if ($mode == "delete"){
    $text .= "<h3>Suppression de données</h3>";           
}

$result = queryRequest("SELECT * FROM ".$table);

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j)
{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	$temp_result = queryRequest("UPDATE relation SET rang = 'argonaute', id_classe = '0' WHERE id_utilisateur = '$row[0]'");
}

$value1=$value2=$value3=$value4=$value5="";

if ($table == "Service"){
    if ($mode == "insert"){
        $text .= "<div> <h4>Insertion directe</h4> <table>
        <tr>
            <td><label for='NumService'>NumService :</label></td>
            <td><label for='Nom'>Nom :</label></td>
            <td><label for='Batiment'>Batiment :</label></td>
            <td><label for='NumMed'>NumMed :</label></td>
            <td></td>
        </tr>";
        $text .= "<tr>
        <td>	<input type='text' name='NumService' placeholder='NumService' maxlength='20' value=$value1></td>
        <td>	<input type='text' name='Nom' placeholder='Nom' maxlength='20' value=$value2></td>
        <td>	<input type='text' name='Batiment' placeholder='Batiment' maxlength='20' value=$value3></td>
        <td>	<input type='text' name='NumMed' placeholder='NumMed' maxlength='20' value=$value4></td>
        <td><button onclick=addData()>Ajouter</button></td>
        </tr>
        </table> <span id='msg'></span><br> </div>
        <div> <h4>Insertion via CSV</h4>
        <form enctype='multipart/form-data' action='addDataFromCSV.php' method='post'>
            <input type='hidden' name='table' id='table' value='Service'>
            <input type='file' name='file' id='file' accept='.csv'>
            <button type='submit' id='submit' name='import'>Importation CSV</button>
        </form>
        </div>";
    }else {
        if($mode=="delete"){
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        $result = queryRequest("SELECT * FROM ".$table);
        $nbRows = $result->num_rows;
        if($nbRows == 0){
            $text .= "<p> Aucune Donnée </p>";
        } else {
            $text .= "<span id='msg'></span><br><table>
            <tr>
                <td><label for='NumService'>NumService :</label></td>
                <td><label for='Nom'>Nom :</label></td>
                <td><label for='Batiment'>Batiment :</label></td>
                <td><label for='NumMed'>NumMed :</label></td>
                <td></td>
            </tr>";
            for ($j = 0; $j < $nbRows; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                $text .= "<tr>
                <td>	<input type='text' name='NumService' placeholder='NumService' maxlength='20' value='$row[0]' ".$disabled."></td>
                <td>	<input type='text' name='Nom' placeholder='Nom' maxlength='20' value='$row[1]' ".$disabled."></td>
                <td>	<input type='text' name='Batiment' placeholder='Batiment' maxlength='20' value='$row[2]' ".$disabled."></td>
                <td>	<input type='text' name='NumMed' placeholder='NumMed' maxlength='20' value='$row[3]' ".$disabled."></td>";
                if($mode == "update"){
                    $text .= "<td><button onclick=\"updateData('$row[0]', 'NumService','$j')\">Mettre à jour</button></td>
                    </tr>";
                } else if ($mode == "delete"){
                    $text .= "<td><button onclick=\"deleteData('$row[0]', 'NumService')\">Supprimer</button></td>
                    </tr>";
                } 
            }
            $text .= "</table>";
        }
    }
} else if ($table == "Salle"){
    if ($mode == "insert"){
        $text .= "<div> <h4>Insertion directe</h4> <table>
        <tr>
            <td><label for='NumSalle'>NumSalle :</label></td>
            <td><label for='NumServ'>NumServ :</label></td>
            <td><label for='Nblits'>Nblits :</label></td>
            <td><label for='NumInf'>NumInf :</label></td>
            <td></td>
        </tr>";
        $text .= "<tr>
        <td>	<input type='text' name='NumSalle' placeholder='NumSalle' maxlength='20' value=$value1></td>
        <td>	<input type='text' name='NumServ' placeholder='NumServ' maxlength='20' value=$value2></td>
        <td>	<input type='text' name='Nblits' placeholder='Nblits' maxlength='20' value=$value3></td>
        <td>	<input type='text' name='NumInf' placeholder='NumInf' maxlength='20' value=$value4></td>
        <td><button onclick=addData()>Ajouter</button></td>
        </tr>
        </table> <span id='msg'></span><br> </div>
        <div> <h4>Insertion via CSV</h4>
        <form enctype='multipart/form-data' action='addDataFromCSV.php' method='post'>
            <input type='hidden' name='table' id='table' value='Salle'>
            <input type='file' name='file' id='file' accept='.csv'>
            <button type='submit' id='submit' name='import'>Importation CSV</button>
        </form>
        </div>";
    }else {
        if($mode=="delete"){
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        $result = queryRequest("SELECT * FROM ".$table);
        $nbRows = $result->num_rows;
        if($nbRows == 0){
            $text .= "<p> Aucune Donnée </p>";
        } else {
            $text .= "<span id='msg'></span><br><table>
            <tr>
                <td><label for='NumSalle'>NumSalle :</label></td>
                <td><label for='NumServ'>NumServ :</label></td>
                <td><label for='Nblits'>Nblits :</label></td>
                <td><label for='NumInf'>NumInf :</label></td>
                <td></td>
            </tr>";
            for ($j = 0; $j < $nbRows; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                $text .= "<tr>
                <td>	<input type='text' name='NumSalle' placeholder='NumSalle' maxlength='20' value='$row[0]' ".$disabled."></td>
                <td>	<input type='text' name='NumServ' placeholder='NumServ' maxlength='20' value='$row[1]' ".$disabled."></td>
                <td>	<input type='text' name='Nblits' placeholder='Nblits' maxlength='20' value='$row[2]' ".$disabled."></td>
                <td>	<input type='text' name='NumInf' placeholder='NumInf' maxlength='20' value='$row[3]' ".$disabled."></td>";
                if($mode == "update"){
                    $text .= "<td><button onclick=\"updateData(['$row[0]', '$row[1]'], ['NumSalle', 'NumServ'],'$j')\">Mettre à jour</button></td>
                    </tr>";
                } else if ($mode == "delete"){
                    $text .= "<td><button onclick=\"deleteData(['$row[0]', '$row[1]'], ['NumSalle', 'NumServ'])\">Supprimer</button></td>
                    </tr>";
                } 
            }
            $text .= "</table>";
        }
    }
} else if ($table == "Infirmier"){
    if ($mode == "insert"){
        $text .= "<div> <h4>Insertion directe</h4> <table>
        <tr>
            <td><label for='NumInf'>NumInf :</label></td>
            <td><label for='Nom'>Nom :</label></td>
            <td><label for='Adresse'>Adresse :</label></td>
            <td><label for='Telephone'>Telephone :</label></td>
            <td></td>
        </tr>";
        $text .= "<tr>
        <td>	<input type='text' name='NumInf' placeholder='NumInf' maxlength='20' value=$value1></td>
        <td>	<input type='text' name='Nom' placeholder='Nom' maxlength='20' value=$value2></td>
        <td>	<input type='text' name='Adresse' placeholder='Adresse' maxlength='20' value=$value3></td>
        <td>	<input type='text' name='Telephone' placeholder='Telephone' maxlength='20' value=$value4></td>    
        <td><button onclick=addData()>Ajouter</button></td>
        </tr>
        </table> <span id='msg'></span><br> </div>
        <div> <h4>Insertion via CSV</h4>
        <form enctype='multipart/form-data' action='addDataFromCSV.php' method='post'>
            <input type='hidden' name='table' id='table' value='Infirmier'>
            <input type='file' name='file' id='file' accept='.csv'>
            <button type='submit' id='submit' name='import'>Importation CSV</button>
        </form>
        </div>";
    }else {
        if($mode=="delete"){
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        $result = queryRequest("SELECT * FROM ".$table);
        $nbRows = $result->num_rows;
        if($nbRows == 0){
            $text .= "<p> Aucune Donnée </p>";;
        } else {
            $text .= "<span id='msg'></span><br><table>
            <tr>
                <td><label for='NumInf'>NumInf :</label></td>
                <td><label for='Nom'>Nom :</label></td>
                <td><label for='Adresse'>Adresse :</label></td>
                <td><label for='Telephone'>Telephone :</label></td>
                <td></td>
            </tr>";
            for ($j = 0; $j < $nbRows; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                $text .= "<tr>
                <td>	<input type='text' name='NumInf' placeholder='NumInf' maxlength='20' value='$row[0]' ".$disabled."></td>
                <td>	<input type='text' name='Nom' placeholder='Nom' maxlength='20' value='$row[1]' ".$disabled."></td>
                <td>	<input type='text' name='Adresse' placeholder='Adresse' maxlength='20' value='$row[2]' ".$disabled."></td>
                <td>	<input type='text' name='Telephone' placeholder='Telephone' maxlength='20' value='$row[3]' ".$disabled."></td>";            
                if($mode == "update"){
                    $text .= "<td><button onclick=\"updateData('$row[0]', 'NumInf','$j')\">Mettre à jour</button></td>
                    </tr>";
                } else if ($mode == "delete"){
                    $text .= "<td><button onclick=\"deleteData('$row[0]', 'NumInf')\">Supprimer</button></td>
                    </tr>";
                } 
            }
            $text .= "</table>";
        }
    }
} else if ($table == "Patient"){
    if ($mode == "insert"){
        $text .= "<div> <h4>Insertion directe</h4> <table>
        <tr>
            <td><label for='NumPat'>NumPat :</label></td>
            <td><label for='Nom'>Nom :</label></td>
            <td><label for='Prenom'>Prenom :</label></td>
            <td><label for='Mutuelle'>Mutuelle :</label></td>
            <td></td>
        </tr>";
        $text .= "<tr>
        <td>	<input type='text' name='NumPat' placeholder='NumPat' maxlength='20' value=$value1></td>
        <td>	<input type='text' name='Nom' placeholder='Nom' maxlength='20' value=$value2></td>
        <td>	<input type='text' name='Prenom' placeholder='Prenom' maxlength='20' value=$value3></td>
        <td>	<input type='text' name='Mutuelle' placeholder='Mutuelle' maxlength='20' value=$value4></td>
        <td><button onclick=addData()>Ajouter</button></td>
        </tr>
        </table> <span id='msg'></span><br> </div>
        <div> <h4>Insertion via CSV</h4>
        <form enctype='multipart/form-data' action='addDataFromCSV.php' method='post'>
            <input type='hidden' name='table' id='table' value='Patient'>
            <input type='file' name='file' id='file' accept='.csv'>
            <button type='submit' id='submit' name='import'>Importation CSV</button>
        </form>
        </div>";
    }else {
        if($mode=="delete"){
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        $result = queryRequest("SELECT * FROM ".$table);
        $nbRows = $result->num_rows;
        if($nbRows == 0){
            $text .= "<p> Aucune Donnée </p>";;
        } else {
            $text .= "<span id='msg'></span><br><table>
            <tr>
                <td><label for='NumPat'>NumPat :</label></td>
                <td><label for='Nom'>Nom :</label></td>
                <td><label for='Prenom'>Prenom :</label></td>
                <td><label for='Mutuelle'>Mutuelle :</label></td>
                <td></td>
            </tr>";
            for ($j = 0; $j < $nbRows; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                $text .= "<tr>
                <td>	<input type='text' name='NumPat' placeholder='NumPat' maxlength='20' value='$row[0]' ".$disabled."></td>
                <td>	<input type='text' name='Nom' placeholder='Nom' maxlength='20' value='$row[1]' ".$disabled."></td>
                <td>	<input type='text' name='Prenom' placeholder='Prenom' maxlength='20' value='$row[2]' ".$disabled."></td>
                <td>	<input type='text' name='Mutuelle' placeholder='Mutuelle' maxlength='20' value='$row[3]' ".$disabled."></td>";
                if($mode == "update"){
                    $text .= "<td><button onclick=\"updateData('$row[0]', 'NumPat','$j')\">Mettre à jour</button></td>
                    </tr>";
                } else if ($mode == "delete"){
                    $text .= "<td><button onclick=\"deleteData('$row[0]', 'NumPat')\">Supprimer</button></td>
                    </tr>";
                } 
            }
            $text .= "</table>";
        }
    }
} else if ($table == "Medecin"){
    if ($mode == "insert"){
        $text .= "<div> <h4>Insertion directe</h4> <table>
        <tr>
            <td><label for='NumMed'>NumMed :</label></td>
            <td><label for='nom'>nom :</label></td>
            <td><label for='Specialite'>Specialite :</label></td>
            <td></td>
        </tr>";
        $text .= "<tr>
        <td>	<input type='text' name='NumMed' placeholder='NumMed' maxlength='20' value=$value1></td>
        <td>	<input type='text' name='nom' placeholder='nom' maxlength='20' value=$value2></td>
        <td>	<input type='text' name='Specialite' placeholder='Specialite' maxlength='20' value=$value3></td>
        <td><button onclick=addData()>Ajouter</button></td>
        </tr>
        </table> <span id='msg'></span><br> </div>
        <div> <h4>Insertion via CSV</h4>
        <form enctype='multipart/form-data' action='addDataFromCSV.php' method='post'>
            <input type='hidden' name='table' id='table' value='Medecin'>
            <input type='file' name='file' id='file' accept='.csv'>
            <button type='submit' id='submit' name='import'>Importation CSV</button>
        </form>
        </div>";
    }else {
        if($mode=="delete"){
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        $result = queryRequest("SELECT * FROM ".$table);
        $nbRows = $result->num_rows;
        if($nbRows == 0){
            $text .= "<p> Aucune Donnée </p>";;
        } else {
            $text .= "<span id='msg'></span><br><table>
            <tr>
                <td><label for='NumMed'>NumMed :</label></td>
                <td><label for='nom'>nom :</label></td>
                <td><label for='Specialite'>Specialite :</label></td>
                <td></td>
            </tr>";
            for ($j = 0; $j < $nbRows; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                $text .= "<tr>
                <td>	<input type='text' name='NumMed' placeholder='NumMed' maxlength='20' value='$row[0]' ".$disabled."></td>
                <td>	<input type='text' name='nom' placeholder='nom' maxlength='20' value='$row[1]' ".$disabled."></td>
                <td>	<input type='text' name='Specialite' placeholder='Specialite' maxlength='20' value='$row[2]' ".$disabled."></td>";
                if($mode == "update"){
                    $text .= "<td><button onclick=\"updateData('$row[0]', 'NumMed','$j')\">Mettre à jour</button></td>
                    </tr>";
                } else if ($mode == "delete"){
                    $text .= "<td><button onclick=\"deleteData('$row[0]', 'NumMed')\">Supprimer</button></td>
                    </tr>";
                } 
            }
            $text .= "</table>";
        }
    }

} else if ($table == "Hospitalisation"){
    if ($mode == "insert"){
        $text .= "<div> <h4>Insertion directe</h4> <table>
        <tr>
            <td><label for='NumPat'>NumPat :</label></td>
            <td><label for='DateEntree'>DateEntree :</label></td>
            <td><label for='NumSalle'>NumSalle :</label></td>
            <td><label for='NumService'>NumService :</label></td>
            <td><label for='DateSortie'>DateSortie :</label></td>
            <td></td>
        </tr>";
        $text .= "<tr>
        <td>	<input type='text' name='NumPat' placeholder='NumPat' maxlength='20' value=$value1></td>
        <td>	<input type='date' name='DateEntree' placeholder='DateEntree' maxlength='20' value=$value2></td>
        <td>	<input type='text' name='NumSalle' placeholder='NumSalle' maxlength='20' value=$value3></td>
        <td>	<input type='text' name='NumService' placeholder='NumService' maxlength='20' value=$value4></td>
        <td>	<input type='date' name='DateSortie' placeholder='DateSortie' maxlength='20' value=$value5></td>
        <td><button onclick=addData()>Ajouter</button></td>
        </tr>
        </table> <span id='msg'></span><br> </div>
        <div> <h4>Insertion via CSV</h4>
        <form enctype='multipart/form-data' action='addDataFromCSV.php' method='post'>
            <input type='hidden' name='table' id='table' value='Hospitalisation'>
            <input type='file' name='file' id='file' accept='.csv'>
            <button type='submit' id='submit' name='import'>Importation CSV</button>
        </form>
        </div>";
    }else {
        if($mode=="delete"){
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        $result = queryRequest("SELECT * FROM ".$table);
        $nbRows = $result->num_rows;
        if($nbRows == 0){
            $text .= "<p> Aucune Donnée </p>";;
        } else {
            $text .= "<span id='msg'></span><br><table>
            <tr>
                <td><label for='NumPat'>NumPat :</label></td>
                <td><label for='DateEntree'>DateEntree :</label></td>
                <td><label for='NumSalle'>NumSalle :</label></td>
                <td><label for='NumService'>NumService :</label></td>
                <td><label for='DateSortie'>DateSortie :</label></td>
                <td></td>
            </tr>";
            for ($j = 0; $j < $nbRows; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                $text .= "<tr>
                <td>	<input type='text' name='NumPat' placeholder='NumPat' maxlength='20' value='$row[0]' ".$disabled."></td>
                <td>	<input type='date' name='DateEntree' placeholder='DateEntree' maxlength='20' value='$row[1]' ".$disabled."></td>
                <td>	<input type='text' name='NumSalle' placeholder='NumSalle' maxlength='20' value='$row[2]' ".$disabled."></td>
                <td>	<input type='text' name='NumService' placeholder='NumService' maxlength='20' value='$row[3]' ".$disabled."></td>
                <td>	<input type='date' name='DateSortie' placeholder='DateSortie' maxlength='20' value='$row[4]' ".$disabled."></td>";
                if($mode == "update"){
                    $text .= "<td><button onclick=\"updateData(['$row[0]', '$row[1]', '$row[2]'], ['NumPat', 'DateEntree', 'NumSalle'],'$j')\">Mettre à jour</button></td>
                    </tr>";
                } else if ($mode == "delete"){
                    $text .= "<td><button onclick=\"deleteData(['$row[0]', '$row[1]', '$row[2]'], ['NumPat', 'DateEntree', 'NumSalle'])\">Supprimer</button></td>
                    </tr>";
                } 
            }
            $text .= "</table>";
        }
    }
} else if ($table == "Acte"){
    if ($mode == "insert"){
        $text .= "<div> <h4>Insertion directe</h4> <table>
        <tr>
            <td><label for='NumMed'>NumMed :</label></td>
            <td><label for='NumPat'>NumPat :</label></td>
            <td><label for='DateActe'>DateActe :</label></td>
            <td><label for='NumService'>NumService :</label></td>
            <td><label for='Description'>Description :</label></td>
            <td></td>
        </tr>";
        $text .= "<tr>
        <td>	<input type='text' name='NumMed' placeholder='NumMed' maxlength='20' value=$value1></td>
        <td>	<input type='text' name='NumPat' placeholder='NumPat' maxlength='20' value=$value2></td>
        <td>	<input type='date' name='DateActe' placeholder='DateActe' maxlength='20' value=$value3></td>
        <td>	<input type='text' name='NumService' placeholder='NumService' maxlength='20' value=$value4></td>
        <td>	<input type='text' name='Description' placeholder='Description' maxlength='20' value=$value5></td>
        <td><button onclick=addData()>Ajouter</button></td>
        </tr>
        </table> <span id='msg'></span><br> </div>
        <div> <h4>Insertion via CSV</h4>
        <form enctype='multipart/form-data' action='addDataFromCSV.php' method='post'>
            <input type='hidden' name='table' id='table' value='Acte'>
            <input type='file' name='file' id='file' accept='.csv'>
            <button type='submit' id='submit' name='import'>Importation CSV</button>
        </form>
        </div>";
    }else {
        if($mode=="delete"){
            $disabled = "disabled";
        }
        else{
            $disabled = "";
        }
        $result = queryRequest("SELECT * FROM ".$table);
        $nbRows = $result->num_rows;
        if($nbRows == 0){
            $text .= "<p> Aucune Donnée </p>";;
        } else {
            $text .= "<span id='msg'></span><br><table>
            <tr>
                <td><label for='NumMed'>NumMed :</label></td>
                <td><label for='NumPat'>NumPat :</label></td>
                <td><label for='DateActe'>DateActe :</label></td>
                <td><label for='NumService'>NumService :</label></td>
                <td><label for='Description'>Description :</label></td>
                <td></td>
            </tr>";
            for ($j = 0; $j < $nbRows; ++$j)
            {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_NUM);
                $text .= "<tr>
                <td>	<input type='text' name='NumMed' placeholder='NumMed' maxlength='20' value='$row[0]' ".$disabled."></td>
                <td>	<input type='text' name='NumPat' placeholder='NumPat' maxlength='20' value='$row[1]' ".$disabled."></td>
                <td>	<input type='date' name='DateActe' placeholder='DateActe' maxlength='20' value='$row[2]' ".$disabled."></td>
                <td>	<input type='text' name='NumService' placeholder='NumService' maxlength='20' value='$row[3]' ".$disabled."></td>
                <td>	<input type='text' name='Description' placeholder='Description' maxlength='20' value='$row[4]' ".$disabled."></td>";
                if($mode == "update"){
                    $text .= "<td><button onclick=\"updateData(['$row[0]', '$row[1]', '$row[2]'], ['NumMed', 'NumPat', 'DateActe'],'$j')\">Mettre à jour</button></td>
                    </tr>";
                } else if ($mode == "delete"){
                    $text .= "<td><button onclick=\"deleteData(['$row[0]', '$row[1]', '$row[2]'], ['NumMed', 'NumPat', 'DateActe'])\">Supprimer</button></td>
                    </tr>";
                } 
            }
            $text .= "</table>";
        }
    }
}

$res = ['text' => $text];
echo json_encode($res);

?>