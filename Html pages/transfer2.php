<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../CSS/style2.css">

    <title>Transfer | Sparks Foundation</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #fce79c">
      <!--for dark theme-->
      <div class="container-fluid">
        <a
          class="navbar-brand"
          href="../index.html"
          style="margin-left: 0.8rem; font-size: 2rem"
          ><img src="../images/logo.jpg" style="width:55px;"><b> SPARKS BANK</b></img></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="../index.html"
                style="margin: 2px"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="transfer1.php" style="margin: 2px">Transfer Money</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="history.php" style="margin: 2px"
                >Transaction History</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
            session_start();
            $server="localhost";
            $username="root";
            $password="";
            $database="sparks_bank";
            
            $con = new mysqli($server,$username,$password,$database);

            if($con->connect_error){
              die("connection failed".$con->connect_error);
            }

            $_SESSION['user'] = $_GET['user'];
            $_SESSION['sender'] = $_SESSION['user'];

            // echo $_SESSION['sender'];

            echo "<h4 style='margin: 2% 0 0 10%; ' >Welcome, ". $_SESSION['user']."</h4> <br>"; 
            echo "<h5 style='margin:0 0 3% 12%;'>Your Bank Details: <br></h5>"
    ?>

    <div class="container" style="width:67%; margin-top:-1%; margin-left:17%;" >
        <table class="table" style="width:82%; margin-left:7%;">
          <thead>
              <tr>
                  <th style="width:150px;">
                      S.NO.
                  </th>
                  <th style="width:250px;">Name</th>
                  <th style="width:150px;">Gender</th>
                  <th style="width:250px;">Email ID</th>
                  <th  style="width:150px;">Balance</th>
              </tr>
          </thead>
          <tbody>  
            <?php
            if(isset($_SESSION['user'])){
              $user=$_SESSION['user'];

              $sql= "SELECT * FROM customer WHERE Name='$user'";
              $res=$con->query($sql);

              if(!$res){
                die("Invalid query ".$con->error);
              }

              while($row=$res->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $row["S.No."] . "</td>
                <td>".$row["Name"]. "</td>
                <td>".$row["Gender"]."</td>
                <td>".$row["Email_ID"]."</td>
                <td>".$row["Balance"]. "</td>";
              }
            }
            ?>
          </tbody>
        </table>
        
    </div>
    <div class="container" style=" margin-left:17%; width:67%;">
          <h4 style="text-align:center;">Make Transactions</h4>
          <hr style="width:30%; margin: 0 auto; color:black; background-color:black;" size="7">
          <?php
            if ($_GET['message'] == 'success') {
              echo "<h5 style='color:green; margin-left:30%; margin-top:2%;'>Transaction was completed successfully</h5>";
            }
            if ($_GET['message'] == 'transactionDenied') {
              echo "<h5 style='color:red;  margin-left:40%; margin-top:2%;'>Transaction Failed</h5>";
              echo "<p style='color:red;  margin-left:45%; margin-top:1%; margin-bottom:0;'>Try again</p>";
            }
          ?>
        <form action="transfer3.php" method="POST">
          <table >
            <tr>
              <td>
          <table class="tr2" style="margin-top:3%;" >
            <tr>
              <td>
                <label for="">To :</label>
              </td>
              <td>
                <select name="reciever" id="dropdown" class="textbox" required>
                  <option value="">--Select recipient--</option>
                  <?php
                    $sql1="SELECT * FROM customer WHERE Name!='$user'";
                    $res1=$con->query($sql1);

                    while($row1=$res1->fetch_assoc()){
                      echo "<option>".$row1["Name"]."</option>";
                    }
                  ?>
                </select> <br> 
              </td> 
            </tr>
            <tr>
              <td>
                <label for="">From :</label>
              </td>
              <td>
                <input type="text" name="sender" disabled type="text" value="<?php echo $user; ?>"> <br>
              </td>
            </tr>
            <tr>
              <td>
                <label for="">Amount</label>
              </td>
              <td>
                <input type="text" name="amount" min="100" placeholder="Enter the amount">
              </td>
            </tr>
          </table>
          </td>
          <td>
          <img src="../images/transfer_page.jpg" alt="" style="width:20rem; margin-left: 6rem; margin-top:2rem; border-radius:30px; border:1px solid black;">
          </td>
          </tr>
          </table>
          <a href="transfer3.php"><button class="btn btn-primary transfer" name="transfer" >Transfer</button></a>
          
        </form>
        <a href="transfer1.php"><button style="margin-left:16%;" class="btn btn-success transfer" >Go Back</button></a>
      </div>
    <footer class="third">
      <h5 style="font-size: 1.3rem">Sparks Bank</h5>
      <p style="font-size: 0.9rem">Copyright © 2022 , SparksBank.com</p>
    </footer>
</body>
</html>