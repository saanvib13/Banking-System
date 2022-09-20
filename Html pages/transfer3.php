<?php
$flag=false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetBanking Services</title>
</head>
<body>
    <?php
        session_start();
        $server="localhost";
        $username="root";
        $password="";
        $database="sparks_bank";

        $con=new mysqli($server,$username,$password,$database);
        if($con->connect_error){
            die("connection failed".$con->connect_error);
        }


        
    ?>
    <?php
    if(isset($_POST["transfer"])){
            $sender=$_SESSION['sender'];
            $reciever=$_POST['reciever'];
            $amount=$_POST['amount'];   
        }
    else{
        echo "galti h bhai";
    }
    $sql="SELECT * FROM customer WHERE Name='$sender'";
    $res=$con->query($sql);

    if(!$res){
        die("invalid query");
    }
    if($res->num_rows >0 ){
        while($row = $res->fetch_assoc()) {
            if($amount>$row["Balance"] or $row["Balance"]-$amount<100){
                $location='transfer2.php?user='.$sender;
                header("Location: $location&message=transactionDenied");
            }
            else{
                $sql1 = "UPDATE `customer` SET Balance=(Balance-$amount) WHERE Name='$sender'";
                if ($con->query($sql1) === TRUE) {
                    $flag=true;
                } else {
                    echo "Error in updating record: " . $conn->error;
                }
            }
        }
    } else {
        echo "0 results";
    } 
    if($flag==true){
        $sql = "UPDATE `customer` SET Balance=(Balance+$amount) WHERE name='$reciever'";
        if ($con->query($sql) === TRUE) {
        $flag=true;  
  
        } else {
            echo "Error in updating record: " . $con->error;
        }
    }
    if($flag==true){
        $sql = "SELECT * from customer where name='$sender'";
        $result = $con-> query($sql);
        while($row = $result->fetch_assoc())
        {
            $s_id=$row['S.No.'];
        }
        $sql = "SELECT * from customer where name='$reciever'";
        $result = $con-> query($sql);
        while($row = $result->fetch_assoc())
        {
            $r_id=$row['S.No.'];
        }
        $sql = "INSERT INTO `transfer`(s_id,s_name,r_id,r_name,amount) VALUES ('$s_id','$sender','$r_id','$reciever','$amount')";
        if ($con->query($sql) === TRUE) {
        } else 
        {
            echo "Error updating record: " . $con->error;
        }
    }

    if($flag==true){
        $location='transfer2.php?user='.$sender;
        header("Location: $location&message=success");//for redirecting it to detail page with message
    }
    ?>
</body>
</html>
