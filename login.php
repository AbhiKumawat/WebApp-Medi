<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$db_host =      'rdsinstance.cm1qivy6ib7b.us-east-2.rds.amazonaws.com';     //RDS Endpoint...
$db_username =  'awsuser';
$db_pass =      'rdspassword';
$db_name =      'calendar'; 
$con = mysqli_connect($db_host, $db_username, $db_pass, $db_name);

if(isset($_POST['login']))
{
    session_start();
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    
    // echo $username;
    // echo $password;
    
    if($username!="" && $password!="")
    {
        $sql = "SELECT id FROM login WHERE username='$username' and password='$password'";
        $result = mysqli_query($con, $sql) or die("FAIL: $sql BECAUSE: " . mysql_error());
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id = ($row['id']);
    
        $count = mysqli_num_rows($result);
        if($count == 1)
        {
            $_SESSION["is_login"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["userid"] = $id;
            header("location:cal/index.php");
        }
        else{
            echo "Unsuccessful Login";
            header("location:errorSigningIn/");
        }
    }
    else{
        echo "Sign up Page";
    }
}
?>