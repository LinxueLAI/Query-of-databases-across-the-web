<?php 

$results = ""; 
$msg = "everything alright";
$err = "0";

//Database creation

$name = "hopital";

$hostnetwork = 'localhost';
$username = 'root';
$password = '';

$conn = new mysqli($hostnetwork, $username, $password);
if ($conn->connect_error) {
    $msg = "Connection failed: " . $conn->connect_error;
    $err = "1";
}

//Database creation
$result = $conn->query("CREATE DATABASE IF NOT EXISTS $name");
if (!$result) {
    $msg = "Error creating database: " . $conn->error;
    $err = "2";
}

$conn->close();

require_once "../functions.php";

//Table creation

$name = "Medecin";
$values = "NumMed INT(10), nom VARCHAR(20), Specialite  VARCHAR(20), 
PRIMARY KEY(NumMed)";

$result = queryRequest("CREATE TABLE IF NOT EXISTS $name($values) CHARSET utf8");
try{
    $results .= $result."&"; 
} finally {}

$name = "Infirmier";
$values = "NumInf INT(10), Nom VARCHAR(20), Adresse VARCHAR(50), Telephone INT(20), 
PRIMARY KEY(NumInf)";

$result = queryRequest("CREATE TABLE IF NOT EXISTS $name($values) CHARSET utf8");
try{
    $results .= $result."&"; 
} finally {}

$name = "Patient";
$values = "NumPat INT(10), Nom VARCHAR(20), Prenom VARCHAR(20), Mutuelle VARCHAR(10), 
PRIMARY KEY(NumPat)";

$result = queryRequest("CREATE TABLE IF NOT EXISTS $name($values) CHARSET utf8");
try{
    $results .= $result."&"; 
} finally {}

$name = "Service";
$values = "NumService INT(10), Nom VARCHAR(20), Batiment VARCHAR(10), NumMed INT(10), 
PRIMARY KEY(NumService), 
FOREIGN KEY(NumMed) REFERENCES Medecin(NumMed) ON DELETE Cascade ON UPDATE Cascade";

$result = queryRequest("CREATE TABLE IF NOT EXISTS $name($values) CHARSET utf8");
try{
    $results .= $result."&"; 
} finally {}

$name = "Salle";
$values = "NumSalle INT(10), NumServ INT(10), Nblits INT(10), NumInf INT(10), 
PRIMARY KEY(NumSalle, NumServ), 
FOREIGN KEY(NumServ) REFERENCES Service(NumService) ON DELETE Cascade ON UPDATE Cascade, 
FOREIGN KEY(NumInf) REFERENCES Infirmier(NumInf) ON DELETE Cascade ON UPDATE Cascade";

$result = queryRequest("CREATE TABLE IF NOT EXISTS $name($values) CHARSET utf8");
try{
    $results .= $result."&"; 
} finally {}

$name = "Hospitalisation";
$values = "NumPat INT(10), DateEntree DATE, NumSalle INT(10), NumService INT(10), DateSortie DATE, 
PRIMARY KEY(NumPat, DateEntree, NumSalle),
FOREIGN KEY(NumService) REFERENCES Service(NumService) ON DELETE Cascade ON UPDATE Cascade, 
FOREIGN KEY(NumPat) REFERENCES Patient(NumPat) ON DELETE Cascade ON UPDATE Cascade, 
FOREIGN KEY(NumSalle) REFERENCES Salle(NumSalle) ON DELETE Cascade ON UPDATE Cascade";

$result = queryRequest("CREATE TABLE IF NOT EXISTS $name($values) CHARSET utf8");
try{
    $results .= $result."&"; 
} finally {}

$name = "Acte";
$values = "NumMed INT(10), NumPat INT(10), DateActe DATE, NumService INT(10), Description VARCHAR(10), 
PRIMARY KEY(NumMed, NumPat, DateActe),
FOREIGN KEY(NumMed) REFERENCES Medecin(NumMed) ON DELETE Cascade ON UPDATE Cascade, 
FOREIGN KEY(NumPat) REFERENCES Patient(NumPat) ON DELETE Cascade ON UPDATE Cascade, 
FOREIGN KEY(NumService) REFERENCES Service(NumService) ON DELETE Cascade ON UPDATE Cascade";

$result = queryRequest("CREATE TABLE IF NOT EXISTS $name($values) CHARSET utf8");
try{
    $results .= $result; 
} finally {}

$res = ['msg' => $msg, 'err' => $err, 'results' => $results];
echo json_encode($res);

?>