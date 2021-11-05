<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css"> 
</head>
<?php

// Collect inputs from form and then create connection to the database. 

$problemType = $_REQUEST['ProblemType'];


$specialists = [
	'specialist1'=> 'Printer',
	'specialist2'=> 'Printer',
	'specialist3'=> 'Printer',
	'specialist4'=> 'Laptop',
	'specialist5'=> 'Laptop',
	'specialist6'=> 'Laptop',
	'specialist7'=> 'Software',
	'specialist8'=> 'Software',
	'specialist9'=> 'Software',
	'specialist10'=> 'Server',
	'specialist11'=> 'Server',
	'specialist12'=> 'Server',
 

];
$queuedTasks = [
	'specialist1'=> 4,
	'specialist2'=> 6,
	'specialist3'=> 8,
	'specialist4'=> 0,
	'specialist5'=> 7,
	'specialist6'=> 5,
	'specialist7'=> 3,
	'specialist8'=> 9,
	'specialist9'=> 2,
	'specialist10'=> 6,
	'specialist11'=> 5,
	'specialist12'=> 8,
 
];

$extraSpecialisms = [
	'specialist1'=> 'Server',
	'specialist2'=> 'Laptop',
	'specialist3'=> 'N/A',
	'specialist4'=> 'N/A',
	'specialist5'=> 'N/A',
	'specialist6'=> 'N/A',
	'specialist7'=> 'N/A',
	'specialist8'=> 'N/A',
	'specialist9'=> 'Printer',
	'specialist10'=> 'Printer',
	'specialist11'=> 'Software',
	'specialist12'=> 'Laptop', 
];

//find appropriate specialists

$specialistNames = array_keys($specialists);
$currentMin = INF;
$recommended = " ";
foreach( $specialistNames as $name){
	if ($specialists[$name] == $problemType || $extraSpecialisms[$name] == $problemType) {
		$selectedSpecialistTaskCounts[$name]= $queuedTasks[$name];
		//echo $name ." -     -  ". $queuedTasks[$name] . "<br>";

		//find recommended specialist
		if ($queuedTasks[$name] < $currentMin) {
			$currentMin = $queuedTasks[$name];
			$recommended = $name;
		}
	}
}
echo "Recommended Specialist: ". $recommended;
?> 



</html>
