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
        $query="select source,destination,departure_date,departure_time,duration,price,name from (flight INNER JOIN company ON flight.company_id=company.company_id) where flight_id='".$_POST['flightId']."';";
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
    
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['save'])){
        $name=$_POST['name'];
        $aadhar=$_POST['aadhar'];
        $age=$_POST['age'];

        $new=array($name,$aadhar,$age,$count);
        $count=$count+1;
        array_push($pas,$new);
        
        $_SESSION['pas']=$pas;
        $_SESSION['count']=$count;
    }
    // $pas=array();


?>

<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php require('Header.php'); ?>
        <div class="main-container">
            <div class="passanger-list">
                <div class="show-passanger">
                    <?php
                        for($x=0;$x<count($pas);$x++){
                            echo '
                                <div class="individual-pass">
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
                                </div>
                            ';
                            
                        }

                        echo "<br><br>".$count."<br><Br>";
                    ?>           
                </div>

                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Passange</button>
            </div>

            <div class="bill-con">
                <div>
                    <table>
                        <tr>
                            <td>Total Passanger</td>
                            <td><?php echo $count; ?></td>
                        </tr>
                        <tr>
                            <td>Ticket Price</td>
                            <td><?php echo $result['price']; ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><?php echo $count*$result['price']; ?></td>
                        </tr>
                    </table>
                </div>
                <button type="submit" name="confirm" >Confirm Ticket</button>
            </div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
            
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Passanger Details</h4>
                </div>
                <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                    <div class="modal-body">
                        
                            <label>Name:</label><input type="text" name="name"><br>
                        
                            <label>Aadhar No:</label><input type="text" name="aadhar"><br>
                            <label>Age:</label><input type="Number" name="age"><br>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" name="save">ADD</button>
                    </div>
                </form>
                </div>
                
            </div>
        </div>
    </body>

</html>