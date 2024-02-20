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
//check if the person has clicked on the submit button
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name=$_POST['cname'];
    $phone=$_POST['cphone'];
    $items=$_POST['items'];
    $cost=$_POST['cost'];
    $date=$_POST['date'];

    //make a variable for the folder
    $uploadsdir='uploads/'; 
    $uploadedfile=$_FILES['uploads']['name']; //this is what we use in the insert statement
    $uploadspath=$uploadsdir.$uploadedfile;   //(uploads/mypicture.png)
    if(move_uploaded_file($_FILES['uploads']['tmp_name'], $uploadspath)){
        echo '<script>';
        echo 'alert("File uploaded successfully)';
        echo 'window.location.href="index.php"';
        echo '</script>';
    }
    else{
        echo "Error.";
    }

    //read todays date
    // $today=date('Y-m-d'); 
    //insert query
    //insert into table_name (list the columns in the table) values(list the variable for each column)
    $sql="insert into user(name, phone, items, amount, date,profile) values ('$name', '$phone', '$items', '$cost', '$date','$uploadedfile')";
    //run the query
    //to querry you must give the connection variable, query variable
    $run=mysqli_query($conn, $sql);
    if($run){
        echo "<script>alert('Item added to the database'); window.location.href='index.php';</script>";
    }
}

?>



<!doctype html>
<html>
    <head>
        <title>Winner program</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <center>
            <h1>Winner Program</h1>
        </center>
       
        <form action="" method="POST" style="width:500px;" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Customer Name</label>
                <input type="text" name="cname" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Customer Phone Number</label>
                <input type="text" name="cphone" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Total Items</label>
                <input type="text" name="items" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Total cost</label>
                <input type="text" name="cost" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Choose a file</label>
                <input type="file" name="uploads" class="form-control">
            </div>
            <div class="form-group">
               
                <input type="submit" value="submit information"  class="form-control btn btn-primary">
            </div>
        </form>
        <a href="checkwinner.php" class="btn btn-warning">Check Winner</a>
    </body>
</html>