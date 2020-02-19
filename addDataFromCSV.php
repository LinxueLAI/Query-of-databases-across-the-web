<html>
<head>
  <meta charset="utf8"> 
  <title>Info Importation</title>
  <script src="functions.js"></script>
</head>
<body>
<h1> Rapport de l'importation</h1>

<?php
  // Connect to database
  require_once "functions.php";
  require_once "functionsCSV.php";

  if (isset($_POST['import'])) {
    
    $file = $_FILES['file']['tmp_name'];
    $table = $_POST['table'];
    $length = tableLength($table);

    $sep = whichSep($file, $length);

    if(strcmp($sep, ";") == 0){
      sep_pv($file, $table, $length);
    } else if(strcmp($sep, "\r") == 0){
      $count = sep_r($file, $table, $length);
      if($count == 0){
        echo "<B> an error occured </B>";
      }
    } else {
      echo "<B> an error occured </B>";
    }
  }  

?>
<br>
<button onclick=returnToIndex()>Retour au menu principal</button>
</body>
</html>