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
    <link rel="stylesheet" href="../CSS/style2.css">
    <title>Select Account| Sparks Bank</title>
  </head>
  <body>
    <!-- INSERT INTO `customers` (`S.No.`, `Name`, `Email_ID`, `Gender`, `Balance`, `DOR`) VALUES ('1', 'Anuj Singh', 'anujsingh10@gmail.com', 'Male', '6000', current_timestamp()); -->
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
    <h1>Select your account</h1>
    
    <div class="container">
    <table class="table" style="width:77%; margin-left:10%;">
      <thead>
        <tr>
          <th style="width:150px;">SNO.</th>
          <th style="width:250px;">Name</th>
          <th style="width:150px;">Gender</th>
          <th style="width:250px;">Email_ID</th>
          <th style="width:150px;">Balance</th>

        </tr>
      </thead>
      <tbody>
        <?php
        
        $server="localhost";
        $username="root";
        $password="";
        $database="sparks_bank";

        $con=new mysqli($server,$username,$password,$database);

        if($con->connect_error){
          die("Connection failed".$con->connect_error);
        }
        $sql="SELECT * FROM customer";
        $res=$con->query($sql);
        if(!$res){
          die("Invalid query".$con->error);
        }
        while($row=$res->fetch_assoc()){
          echo '<tr>';
           echo '<form method ="post" action = "transfer2.php">';
            echo '<td>'.$row["S.No."].'</td>';
            echo "<td> <a href='transfer2.php?user={$row["Name"]}&message=no' id='name'>".$row["Name"].'</a></td>
            <td>'.$row["Gender"].'</td>
            <td>'.$row["Email_ID"].'</td>
            <td>'.$row["Balance"].'</td>
          </tr>';
        }
        
        ?>
      </tbody>
    </table>
    </div>
    <footer class="third">
      <h5 style="font-size: 1.3rem">Sparks Bank</h5>
      <p style="font-size: 0.9rem">Copyright © 2022 , SparksBank.com</p>
    </footer>
    <!-- <script>
        function handle() {
            const name=document.getElementById('name');
            console.log(name)
            localStorage.setItem("NAME",name);
            return;
        }
    </script> -->
  </body>
</html>
