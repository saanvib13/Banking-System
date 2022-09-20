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
    <title>Transaction History | Sparks Foundation</title>
    <link rel="stylesheet" href="../CSS/style2.css">
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
    <h1>Transaction History</h1>

    
    <div class="container" style="width:76%; margin-left:13%;">
        <table class="table" style="width:95%; margin-left:3%;">
            <thead>
                <tr style="text-align:center;">
                    <th>Sender's ID</th>
                    <th>Sender's Name</th>
                    <th>Receiver's ID</th>
                    <th>Receiver's Name</th>
                    <th>Amount transferred</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $server="localhost";
                    $username="root";
                    $password="";
                    $database="sparks_bank";

                    $con = new mysqli($server,$username,$password,$database);

                    if($con->connect_error){
                        die("connection failed".$con->connect_error);
                    }

                    $sql="SELECT * FROM transfer";
                    $res=$con->query($sql);
                    if(!$res){
                        die("invalid query".$con->error);
                    }
                    while($row=$res->fetch_assoc()){
                        echo "<tr style='text-align:center;'>
                        <td>".$row["s_id"]."</td>
                        <td>".$row["s_name"]."</td>
                        <td>".$row["r_id"]."</td>
                        <td>".$row["r_name"]."</td>
                        <td>".$row["amount"]."</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <img src="../images/history_page.jpg" alt=""  style="width:25%; margin-left:11%;">
    <img src="../images/logo.jpg" style="width:20%; margin-left:17%;">
    <footer class="third">
      <h5 style="font-size: 1.3rem">Sparks Bank</h5>
      <p style="font-size: 0.9rem">Copyright © 2022 , SparksBank.com</p>
    </footer>    
</body>
</html>

 