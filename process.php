<?php 
    
    $mysqli = new mysqli('localhost', 'root', '','dbtest') or die(mysqli_error($mysqli));
    $id = 0;
    $update = false;
    $modified_time = '';
    if (isset($_POST['signup-btn'])) {
        $username = $_POST['user-name'];
        $password = $_POST['user-pass'];
        $email = $_POST['user-email'];
        $contact = $_POST['user-contact'];


        $conn = mysqli_connect('localhost', 'root', '');
        $db = mysqli_select_db($conn,'dbtest');
        $query = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");
        $querye = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
        $rows = mysqli_num_rows($query);
        $rows2 = mysqli_num_rows($querye);


        if($rows > 0){
            echo "<script> alert('Username already exists!'); window.location = 'adminUser.php' </script>";
          }

          elseif($rows2 > 0)
          {
            echo "<script> alert('Email already exists!'); window.location = 'adminUser.php' </script>";
          }

          else{
        $mysqli->query("INSERT INTO users (username, password, email, contact) VALUES('$username', '$password', '$email', '$contact')")
        or die($mysqli->error);
    
        $_SESSION['message'] = "Record Created!";
        $_SESSION['msgtype'] = "success";
    
        header("Location: adminUser.php");
    }
}
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM users WHERE id = '$id'") or die(mysqli_error($mysqli));

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msgtype'] = "danger";

        header("Location: adminUser.php");
    }

    if(isset($_GET['Edit'])){
        $id = $_GET['Edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM users WHERE id = '$id'") or die($mysqli->error);
        $rows = mysqli_num_rows($result);

        if($rows > 0){
            $row = $result->fetch_array();
            $username = $row['username'];
            $password = $row['password'];
            $email    = $row['email'];
            $contact  = $row['contact'];
        }
    }

   
?>