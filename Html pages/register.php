<?php
$register=false;
if(isset($_POST['uname'])){
    $server="localhost";
    $username="root";
    $password="";

    $connect = mysqli_connect($server, $username,$password);

    if(!$connect){
        die("Connection to database failed due to".mysqli_connect_error());
    }
    // echo "connection successful";

    $name=$_POST['uname'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $bal=$_POST['bal'];

    $sql="INSERT INTO `sparks_bank`.`customer` ( `Name`, `Email_ID`, `Gender`, `Balance`, `DOR`) VALUES ( '$name', '$email', '$gender', '$bal', current_timestamp());"; 

    if($connect->query($sql)==true) {
        $register=true;
    }
    else{
        echo "ERROR : $sql <br> $connect->error";
    }

    $connect->close();
}
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../CSS/style1.css">
    <title>Register | Sparks Bank</title>
  </head>
  <body>
    <?php
    if($register == true){
    echo '<div class="alert alert-success" role="alert">
      User Successfully added!
      <a href="../index.html" class="alert-link">Click Here</a> to go back to home page 
    </div>';
    }
    ?>
    <div class="main">
      <div style="display: inline-block" class="one">
        <img src="../images/register.jpg" alt="" />
      </div>
      <div style="display: inline-block" class="two">
        <h2 style="text-align: center">Create New User</h2>

        <div class="two-1">
          <form action="register.php" method="post">
            <input
              type="text"
              placeholder="Full name"
              name="uname"
              id="uname"
            />
            <br />
            <br />
            <input
              type="email"
              placeholder="Email Id"
              name="email"
              id="email"
            />
            <br />
            <br />
            <input type="password" placeholder="Password">
            <br>
            <br>
            <select name="gender" id="gender">
              <option style="color: grey" value="--Select--">--Select--</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
            <br />
            <br />
            <input type="text" name="bal" id="bal" placeholder="Balance" /> <br>
            <button class="btn btn-warning">Register</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
