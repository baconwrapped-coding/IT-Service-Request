<?php 

require '../source/db_connect.php';

if(isset($_POST['register_button'])){
    $name = $_POST['client_name'];
    $email = $_POST['email'];
    $empid = $_POST['empID'];
    $department = $_POST['department'];
    $subject = $_POST['issueSubject'];
    $description = $_POST['desc'];
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d h:i:sa");
    $status = "In Queue";

    $conn = mysqli_connect('localhost', 'root', '');
    $db = mysqli_select_db($conn, 'request');
    $mysqli->query("INSERT INTO ticket (name, email, employee_id, department, subject, issue, date_issued, status_update) VALUES('$name', '$email', '$empid', '$department', '$subject', '$description', '$date', '$status') ")
          or die($mysqli->error);
          echo "<script> alert('Request Made Successfully!'); window.location = '../index.php' </script>";

}

?>