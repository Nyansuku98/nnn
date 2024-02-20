<?php
//connection to the database-- servername, username, password, database\
$servername="localhost";
$username="root";
$password="";
$database="checkwinner";
//crud operate
$conn=new mysqli($servername, $username, $password, $database);

//display an error message
if($conn  -> connect_error){
    die("connection failed:".$conn->connect_error); //when the connection string is not correct
}


//fetch from the table where the amount is max(highest) and the date=today
$today=date('Y-m-d');
//$date='2024-01-10'; //convert this into a date using the php date function

//SELECT
$sql="select * from user where date='$today' and amount=(select max(amount) from user where date='$today')";
$run=mysqli_query($conn, $sql);
//if not 
if(!$run){
echo "Error" .$conn->error;

}
elseif($run->num_rows>0){
    //fetchone
    while($row=$run->fetch_assoc()){
        $name=$row['name'];
        $phone=$row['phone'];
        $amount=$row['amount'];
        $profile=$row['profile'];
    }
}
?>


<!doctype html>
<html>
    <head>
        <title>Check winner</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="jumbotron">
            <center>
                <h1>Highest Amount of purchase: <?php echo $amount;?> <h1>
                <h3>Today's Winner is :  <?php echo $name;?> <br>
            Winner contact information is <?php echo $phone;?> <br>
          <?php   echo "<td><img src='uploads/".base64_encode($row["profile"]). "' alt='User Image' style='width: 100px; height: auto;'></td>";?>
        <br> </h3>
                
            </center>
        </div>
    
    </body>
</html>

