<!DOCTYPE html>
<html>
<head>
<title>Assign Specialist</title>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], input[type=email], input[type=number], select{

  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin: auto;
  margin-top: 6px;
  margin-bottom: 16px;
}


input[type=submit] {
  background-color: #1943DD;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

input[type=submit]:hover {
  background-color: #0A1B5D;
  color:#E0BF1B;
  
}

.main {
  margin-left: auto;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  display: inline-block;
  border: black 1px solid;
  text-align: left;
  justify-content:center;
  
}

.resultsHeader{
  text-align: center;
}


#writtenResults {
  border: 2px solid black;
  outline: none;
  margin: none;  
  padding: 20px;
  text-align: center;
}

#cyclistResults {
  border: 2px solid black;
  outline: none;
  margin: auto;  
  padding: 20px;
  text-align: center;
}
.chart{
  width: 50vw; 
  margin:auto
}


</style>
<!--Get chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
<script src="chart.js"></script>

</head>


<body style = "background-color: Lightgrey;">

<h1 class ="resultsHeader"> ASSIGN SPECIALIST </h1>


<!-- Create form for user inputs and validation for user inputs here: -->

<div class = "main">
<form action="" onsubmit="" method="post"> <!-- form action="" links to itself-->
  <label for="ProblemType">Problem Type:</label>
  <select id="ProblemType" name="ProblemType" required>
    <option value="Default" selected>Select</option>
    <option value="Printer">Printer</option>
    <option value="Laptop">Laptop</option>
    <option value="Software">Software</option>
    <option value="Server">Server</option>
  </select>

  <input type="submit" name="submit" value="submit">
</form>
</div>
<br>


<?php

// Collect inputs from form and then create connection to the database. 

if(isset($_REQUEST['submit'])) {



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


//find appropriate specialists
echo '<p>NAME      Queued Tasks</p> <br>';
$specialistNames = array_keys($specialists);
$currentMin = INF;
$recommended = " ";
foreach( $specialistNames as $name){
	if ($specialists[$name] == $problemType) {
		$selectedSpecialistTaskCounts[$name]= $queuedTasks[$name];
		echo $name ." -     -  ". $queuedTasks[$name] . "<br>";

		//find recommended specialist
		if ($queuedTasks[$name] < $currentMin) {
			$currentMin = $queuedTasks[$name];
			$recommended = $name;
		}
	}
}
echo "<br> Recommended Specialist: ". $recommended;
}
 
?> 
<!-- Use jquery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>


    $(document).ready(function(){                           //Run jquery code when document loads up.
	    $.post("", function(responseData){

		var xLabelNames = [<?php echo '"'.implode('","', array_keys($selectedSpecialistsTaskCounts)).'"' ?>];
		$("#SpecialistResults").append("hello");	
		var yTaskCounts = [<?php echo '"'.implode('","', array_values($selectedSpecialistsTaskCounts)).'"' ?>];	
		var barChart = document.getElementById('resultBar').getContext('2d');
		var backgroundColorSet= [      					
				'rgba(255, 99, 132, 0.2)',
      				'rgba(255, 159, 64, 0.2)',
      				'rgba(255, 205, 86, 0.2)',
      				'rgba(75, 192, 192, 0.2)',
      				'rgba(54, 162, 235, 0.2)',
      				'rgba(153, 102, 255, 0.2)',
      				'rgba(201, 203, 207, 0.2)'];
		var borderColorSet= [      					
				'rgba(255, 99, 132, 1)',
      				'rgba(255, 159, 64, 1)',
      				'rgba(255, 205, 86, 1)',
      				'rgba(75, 192, 192, 1)',
      				'rgba(54, 162, 235, 1)',
      				'rgba(153, 102, 255, 1)',
      				'rgba(201, 203, 207, 1)'];

		var backgroundColors = new Array();
		var borderColors = new Array();
		for (let i = 0; i < yTaskCounts.length; i++){ // remove not needed colours
			backgroundColors[i] = backgroundColorSet[i];
			borderColors[i] = borderColorSet[i];
		}

		var resultsChart = new Chart(barChart, {
    			type: 'bar',
    			data: {
        			labels: xLabelNames, 
        			datasets: [{
            				label: 'Queued Tasks Count per Specialist',
            				data: yTaskCounts,
            				backgroundColor:backgroundColors,            			
					borderColor: borderColors,
            				borderWidth: 1
        			}]
    		},
    		options: {scales: {y: {beginAtZero: true}}}
		});

	}); //End of http request


    });
</script>



<p id="SpecialistResults"></p> 

<br>
<h4 class="resultsHeader"> BAR CHART RESULT: </h4>
<div class ="chart">

<canvas id ="resultBar" width="400" height="400"></canvas>
<br><br><br> 

</div>


</body>
</html>
