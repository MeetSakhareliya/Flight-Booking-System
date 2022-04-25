<?php
    include_once('Connection.php');
    include_once('Header.php');
    if(!isset($_SESSION)) session_start();
    $allowed=false;
    // $result="";
    $result;

    // if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['book'])){
    //     if($_SESSION['user']){

    //     }
    //     else{
            
    //     }
    // }

    if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['modify'])){
        $allowed=true;
    }
    
    // if($_SERVER['REQUEST_METHOD']=="GET" && !isset($_GET['modify'])){

        $origin=!empty($_GET['origin'])?$_GET['origin']:$_SESSION['origin'];
        $destination=!empty($_GET['destination'])?$_GET['destination']:$_SESSION['destination'];
        $depart=!empty($_GET['depart'])?$_GET['depart']:$_SESSION['depart'];


        $_SESSION['origin']=$origin;
        $_SESSION['destination']=$destination;
        $_SESSION['depart']=$depart;
       
        $query="select flight_id,departure_date,departure_time,duration,price,capacity,name,ADDTIME(departure_time,duration) as arrival_time from (flight INNER JOIN company ON flight.company_id=company.company_id) where source='".$origin."' and destination='".$destination."';";
    
        $result=mysqli_query($con,$query);

    // }
    
?>


<html>
    <head>
        <script type="text/javascript">
            
        </script>
    </head>
    <body>
        <div class="main-container">
            <div class="search-details-container">
                <div class="field-container">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
                        <div class="source-field">
                            <div>From</div>
                            <div>
                                <input type="text" value="<?php echo $_SESSION['origin'] ?>" name="origin" id="origin" <?php if(isset($allowed) && !$allowed) echo "readonly";?>>
                            </div>
                        </div>
                        <div class="destination-field">
                            <div>To</div>
                                <div>
                                    <input type="text" value="<?php echo $_SESSION['destination'] ?>" name="destination" id="destination" <?php if(isset($allowed) && !$allowed) echo "readonly"; ?>
                                </div>
                            </div>
                        <div class="date-container">
                            <div>Date</div>
                            <div>
                                <input type="date" value="<?php echo $_SESSION['depart'] ?>" name="depart" id="depart" <?php if(isset($allowed) && !$allowed) echo "readonly"; ?>>
                            </div>
                        </div>
                        <div class="modify-container">
                            <?php 
                                if(isset($allowed) && !$allowed) 
                                    echo '<button type="submit" name="modify">Modify</button>';
                                else
                                    echo '<button type="submit" name="search">Search</button>'
                            ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="search-display-container">
                <?php
                    if (isset($result) && mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            
                
                        echo '<div class="flight-details">
                                <div>'.$row['name'].'</div>
                                <div class="departure_detail">
                                    <div>'.$row['departure_time'].'</div>               
                                    <div>'.$origin.'</div>
                                </div>
                                <div>'.$row['duration'].'</div>
                                <div class="departure_detail">
                                    <div>'.$row['arrival_time'].'</div>
                                    <div>'.$destination.'</div>
                                </div>
                            </div>';

                        echo '<div class="flight-booking-details">
                                <div>'.$row['capacity'].'</div>
                                <div>'.$row['price'].'</div>
                                <form action="Booking.php" method="GET">
                                    <input type="text" name="flightId" hidden value="'.$row['flight_id'].'">
                                    <button type="submit" name="book">BOOK</button>
                                </form>
                            </div>';
                
                        }
                    } 
                    else {
                        echo "0 results";
                    }
                ?>
            </div>
        </div>
    </body>

</html>



<!-- <?php
    
    $query="select * from flight where destination='".$_SESSION['destination']."'";
    
    $result=mysqli_query($con,$query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo $row['capacity'];
            echo $row['price'];
        }
    } else {
        echo "0 results";
    }
   
?> -->