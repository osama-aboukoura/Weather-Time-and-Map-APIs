<?php
	function kelvin_to_celsius ($kelvin) {
		return $kelvin - 273.15 ;
	}

	function show_results_for_city ($city_name, $weather_api_key, $timezone_api_key) {
	
		$weather_api = "http://api.openweathermap.org/data/2.5/weather?q=". $city_name ."&appid=" . $weather_api_key;
		
		// if the link contains valid weather data 
		if (@file_get_contents($weather_api) ) {

			$weather_content = file_get_contents($weather_api);
			$result  = json_decode($weather_content);
		
			$weather_main = $result->weather[0]->main;
			$weather_description = $result->weather[0]->description;
			$temperature = kelvin_to_celsius ($result->main->temp );
			$pressure = $result->main->pressure;
			$humidity = $result->main->humidity;
			$wind_speed = $result->wind->speed;
			$temp_min = kelvin_to_celsius ( $result->main->temp_min );
			$temp_max = kelvin_to_celsius ( $result->main->temp_max );
			$city = $result->name;
			$country = $result->sys->country;
			$latitude = $result->coord->lat;
			$longitude = $result->coord->lon;
			
			echo "<div class = 'weatherResults'>";
			echo "City Found: " . $city . ", " . $country . "<br/>";
			echo "Coordinates: lat: " . $latitude . ", lon: " . $longitude . "<br/>";
			echo "Weather: " . $weather_main . " / " . $weather_description . "<br/>";
			echo "Temperature: " . $temperature . " / Min: " . $temp_min . " / Max: " . $temp_max . "<br/>";
			echo "Pressure: " . $pressure . " / Humidity: " . $humidity . " / Wind Speed: " . $wind_speed . "<br/>";
			echo "</div>";
			
			find_time_for_position ($latitude, $longitude, $timezone_api_key);
			
			draw_google_map_for_position ($latitude, $longitude);
			
		} else {
		
			// the link doesn't contain valid weather data
			echo "City not found. Please try again.";
			
		}
	}
	
	function find_time_for_position ($latitude, $longitude, $timezone_api_key) {
		
		$city_time_api = "http://api.timezonedb.com/v2/get-time-zone?key=" . $timezone_api_key . "&format=json&by=position&lat=" . $latitude . "&lng=" . $longitude;
		$time_content = file_get_contents($city_time_api);
		$time_result  = json_decode($time_content);
		$time = $time_result->formatted;  
		
		echo "<div class = 'timeResults'>" ;
		echo "Current Local Time: " . $time . "<br/>" ;
		echo "</div>" ;
		
	}
	
	function draw_google_map_for_position ($latitude, $longitude) {
		
		// closing php tags to write javascript code 
		?>
		
		<div id="map"></div>
    	<script>
      		function initMap() {
        		var uluru = {lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?>};
        		var map = new google.maps.Map(document.getElementById('map'), {
         		 	zoom: 5,
         		 	center: uluru
        		});
        		var marker = new google.maps.Marker({
          			position: uluru,
          			map: map
        		});
      		}
    	</script>
    	<script
    		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrkbmgN_VrmXSEnB1SYSVgjlb36Pj2WaY&callback=initMap">
    	</script>
    	
    	<?php // opening php tags again to end the draw_google_map_for_position function 
	}
?>