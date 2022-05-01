<?php
    if(!isset($_SERVER)) session_start();
    require('Connection.php');
?>


<?php
    $count=$_SESSION['count']??0;           //
    $pas=$_SESSION['pas']??array();       //

    if(isset($_SESSION['flight_details'])){
        $result=$_SESSION['flight_details'];

    }else{
        $query="select source,destination,departure_date,departure_time,duration,price,name from (flight INNER JOIN company ON flight.company_id=company.company_id) where flight_id='".$_GET['flightId']."';";
        $temp=mysqli_query($con,$query);

        if (isset($temp) && mysqli_num_rows($temp) > 0) {
            while($row = mysqli_fetch_assoc($temp)) {
                $result=array(
                    "source"=>$row['source'],
                    "destination"=>$row['destination'],
                    "date"=>$row['departure_date'],
                    "time"=>$row['departure_time'],
                    "duration"=>$row['duration'],
                    "price"=>$row['price'],
                    "name"=>$row['name'],
                
                );
            }

            $_SESSION['flight_details']=$result;
        }

    }
    
    if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['remove'])){
        $rid=$_GET['removeId'];
        $pas=$_SESSION['pas'];
        for($x=0;$x<count($pas);$x++){
            if($pas[$x][3]==$rid){
                array_splice($pas,$x,1);
            }
        }
        $count=$count-1;
    }

    if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['save'])){
        $name=$_GET['name'];
        $aadhar=$_GET['aadhar'];
        $age=$_GET['age'];
     
        if(strlen($name) && strlen($aadhar) && strlen($age)){
            $new=array($name,$aadhar,$age,$count);
            $count=$count+1;
            array_push($pas,$new);
        }
        
    }
    // $pas=array();
    $_SESSION['pas']=$pas;
    $_SESSION['count']=$count; 
?>

<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="booking.css" />    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <style>
            header{
                background-color:#02122c;
                /* box-shadow: 2px 2px #02122c; */
                top:0;
                left:0;
            }
        </style>
    
    </head>

    <body>
        <?php require('Header.php'); ?>
        <div class="main-container">
            <div class="passanger-list">
                <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">Add Passange</button>

                <div class="show-passanger">
                    <?php
                        for($x=0;$x<count($pas);$x++){
                            echo '
                                <div class="individual-pass">
                                    <p>'.$pas[$x][0].'</p>
                                    <p>'.$pas[$x][1].'</p>
                                    <p>'.$pas[$x][2].'</p>
                                    <div class="room-detail">
                                        <form>
                                            <input type="hidden" name="removeId" value="'.$pas[$x][3].'">
                                            <button type="submit" class="remove" name="remove">Remove</button>
                                        </form>  
                                    </div>
                                </div>
                            ';
                            
                        }
                    ?>           
                </div>

            </div>

            <div class="bill-con">
                <div class="bill">
                    <table>
                        <tr>
                            <td>Total Passanger</td>
                            <td style="padding-left:70px;"><?php echo $count; ?></td>
                        </tr>
                        <tr>
                            <td>Ticket Price</td>
                            <td style="padding-left:70px;"><?php echo $result['price']; ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td style="padding-left:70px; font-weight:bold; font-size:20px;"><?php echo $count*$result['price']; ?></td>
                        </tr>
                    </table>
                </div>
                <button type="submit" name="confirm" class="confirm" >Confirm Ticket</button>
            </div>
        </div>
        <?php require("footer.php"); ?>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
            
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Passanger Details</h4>
                </div>
                <form action="<?php $_SERVER['PHP_SELF']?>" method="GET">
                    <div class="modal-body">
                        
                            <label>Name:</label><input type="text" class="name" name="name" pattern="[A-Za-z]{2,50}" title="Only alphabets"><br>
                        
                            <label>Aadhar No:</label><input type="text" name="aadhar" class="aadhar" pattern="[0-9]{12}" title="12 Digit Number"><br>
                            <label>Age:</label><input type="Number" name="age" class="age" min="0" max="110"><br>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" name="save">ADD</button>
                    </div>
                </form>
                </div>
                
            </div>
            
        </div>
    </body>

</html>

<!-- <div class="individual-pass">
                                    <div class="pass-details">'
                                        .$pas[$x][0].' '
                                        .$pas[$x][1].' '
                                        .$pas[$x][2].'
                                    </div>
                                    <div class="room-detail">
                                        <form>
                                            <input type="hidden" name="removeId" value="'.$pas[$x][3].'">
                                            <button type="submit" name="remove">Remove</button>
                                        </form>  
                                    </div>
                                </div> -->