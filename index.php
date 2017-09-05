<?php
	require_once('functions.php');
	require_once('api_keys.php');
	
	if (isset($_POST['submit']) && trim($_POST["cityField"]) != null){
		$city_name = htmlspecialchars ($_POST["cityField"]) ;
	} else {
		$city_name = "";
	}
	
?>
<html>
<head>
  <title>Hackking's Weather</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="mystyles.css">
  <link href="https://fonts.googleapis.com/css?family=Michroma" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="">Hackking's Weather App</a>
    </div>
  </div>
</nav>
  
<div class="container">

<center>
  	<h1>Hackkings Weather</h1>
  	<h4>Enter the name of a city to find out its weather, time and location.</h4>
  
		<form action="index.php" method="post">
			<label>City Name: </label>
  			<input name="cityField"  placeholder="e.g. London, Paris, Dubai" value="<?php echo $city_name; ?>"  >
  			<br/><br/>
  			<input type="submit" name = "submit"/>
		</form>
	
		<?php
			
			// if any text is passed in the textbox, find out the results
			if ($city_name != null){
			
				show_results_for_city ($city_name, $my_weather_api_key, $my_timezone_api_key); 
				
			} 
			
		?>
  
</center> 
</div>

</body>
</html>
