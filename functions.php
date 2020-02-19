<?php 

	//Connection à la base de données

	require_once 'login.php';
	
	$conn = new mysqli($hostnetwork,$username,$password,$database);
	if ($conn->connect_error) die($conn->connect_error);
	
	$query = "SET NAMES utf8";
	$result = $conn->query($query);
	if (!$result) die($conn->error);
	

	function queryRequest($query)
  	{
    	global $conn;
    	$result = $conn->query($query);
		if (!$result){
			return "Error : " . $conn->error;
		}	
    	return $result;
	}

	function isDate($string){
		if(strlen($string) == 10)
		{
			if(strcmp($string[2],"/")==0 && strcmp($string[5],"/")==0){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function isHeader($string){
		$isN = false;
		$compt = 0;
		for($i=0;$i<strlen($string);$i++){
			if(strcmp($string[$i],"n")==0 || strcmp($string[$i],"N")==0){
				$isN = true;
				$compt++;
			} else if($isN){
				if($compt == 1 && strcmp($string[$i],"u") == 0){
					$compt++;
				} else if($compt == 2 && strcmp($string[$i],"m")==0){
					return true;
				} else {
					$isN = false;
					$compt = 0;
				}
			}
		}
		return false;
	}

	function fix_string($string)
	{
		global $conn;
		//$string = strip_tags($string);
		//s$string = htmlentities($string);
		//$string = stripcslashes($string);
		//$string = $conn->real_escape_string($string);

		if(isDate($string)){
			$tmp_str = $string[6].$string[7].$string[8].$string[9]."-".$string[3].$string[4]."-".$string[0].$string[1];
			$string = $tmp_str;
		}

		return $string;
	}

	function printQuery($sql, $field){
		$result = queryRequest($sql);
		$nbRows = $result->num_rows;
	
		if($nbRows==0){
			$text = "Aucun résultats";
		} else {
			$text = "<B>".$field."</B> <br>";
			for($i=0; $i<$nbRows;$i++){
				$result->data_seek($i);
				$row = $result->fetch_array(MYSQLI_NUM);
				$text .= implode(', ', $row). "<br>";
			}
		}

		echo $text;
	}

	function printQueryTable($sql, $field){
		$result = queryRequest($sql);
		$nbRows = $result->num_rows;
	
		if($nbRows==0){
			$text = "Aucun résultat";
		} else {
			$head = explode(", ", $field);
			$text = "<table><tr>";
			for($i=0; $i<count($head);$i++){
				$text .= "<td><B>".$head[$i]."</B></td>";
			}
			$text .= "</tr>";
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

		echo $text;
	}

?>