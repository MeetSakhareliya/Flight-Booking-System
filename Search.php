<?php
	session_start();
	if($_SERVER['REQUEST_METHOD']=="GET"){
		$origin="DELHI";
		$destination="MUMBAI";
		$depart="2022-04-25";
		// $origin=$_GET['origin']??"DELHI";
		// $destination=$_GET['destination']??"MUMBAI";
		// $depart=$_GET['depart']??"2022-04-25";

		$originError;$destinationError;$departError;
		$flag=false;

		if (empty($origin) || strlen($origin)==0 ){       
            $originError = "City name is required in FROM field";
			$flag=true;
        }
        else{
            $origin = test_input($origin);
          
            if (!preg_match("/^[a-zA-Z]*$/",$origin)){
                $originError = "Give Valid City Name In FROM Field";
				$flag=true;
            }
        }

		if (empty($destination) || strlen($destination)==0 ){       
            $destinationError = "City name is required in TO field";
			$flag=true;
        }
        else{
            $destination = test_input($destination);
          
            if (!preg_match("/^[a-zA-Z]*$/",$destination)){
                $destinationError = "Give Valid City Name In TO Field";
				$flag=true;
            }
        }

		if (empty($depart)){       
            $departError = "Choose Travel Date";
			$flag=true;
        }
        else{
            $depart = test_input($depart);

			$d = explode("-", $depart);
			// print_r($d);
			if (!checkdate($d[1], $d[2], $d[0])) {
				$departError = "Enter Valid Date";
				$flag=true;
			} 
        }

		if(!isset($originError) && !isset($destinationError) && !isset($departError)){
			$_SESSION['origin']=$origin;
			$_SESSION['destination']=$destination;
			$_SESSION['depart']=$depart;
			// echo $depart;
			header("Location: Flight.php");
			// exit();
		}
	}


	function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Flights</title>
		<link rel="stylesheet" type="text/css" href="header.css">
		<link rel="stylesheet" type="text/css" href="flights.css">

		<style type="text/css">
			.head{
				background-image:url(https://www.itsgettinghotinhere.org/wp-content/uploads/2018/03/150324_flights-hero-image_1330x742.jpg);
			}
		</style>
	</head>

	<body>
	  <div class="main_container">
		<div class="head">
			<?php include 'Header.php'; ?>

			<div class="flight-details-box">
				<div class="flight-form">
					<?php if(isset($flag) && $flag) echo $originError??$destinationError??$departError ?>
					
					<div class="labels">
						<span style="margin-right: 175px">From</span>
						<span style="margin-right: 195px">To</span>
						<span style="margin-right: 70px">Departure Date</span>
						
					</div>
					
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">

						<div class="flight-detail">
							
							<div class="origin"><input type="text" value="<?php if(isset($origin)) echo $origin ?>" name="origin" id="flight-origin" placeholder="City"></div>
							<div class="destination"><input type="text" value="<?php if(isset($destination)) echo $destination ?>" name="destination" id="flight-destination" placeholder="City"></div>
							<div class="depart"><input type="date" value="<?php if(isset($depart)) echo $depart ?>" name="depart" id ="depdate" name="Departure"></div>
						</div>
						<div class="search-flight">
							<button type="submit" class="search-flight-btn" >Search flights<span style="line-height:1.5rem;display:inline-block;margin-top:0.1875rem;vertical-align:top"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="width:1.5rem;height:1.5rem" fill="white"><path d="M14.4 19.5l5.7-5.3c.4-.4.7-.9.8-1.5.1-.3.1-.5.1-.7s0-.4-.1-.6c-.1-.6-.4-1.1-.8-1.5l-5.7-5.3c-.8-.8-2.1-.7-2.8.1-.8.8-.7 2.1.1 2.8l2.7 2.5H5c-1.1 0-2 .9-2 2s.9 2 2 2h9.4l-2.7 2.5c-.5.4-.7 1-.7 1.5s.2 1 .5 1.4c.8.8 2.1.8 2.9.1z"></path></svg></span></button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<?php  require('Footer.html'); ?>
	</body>
</html>

