<?php 

$mysqli = new mysqli('localhost', 'root', '','dbtest') or die(mysqli_error($mysqli));
$conn = mysqli_connect('localhost', 'root', '');
if(isset($_POST['update-item']))
{
    $target = "images/" .basename($_FILES['image']['name']);

   
    $db = mysqli_select_db($conn,'dbtest');

    $id = $_POST['update_id'];
    $category = $_POST['item-category'];
    $product = $_POST['item-product'];
    $image = $_FILES['image']['name'];
    $info = $_POST['item-info'];
    $price = $_POST['item-price'];
    $date = $_POST['item-date'];

    $query = "UPDATE products SET category='$category', product='$product', image='$image', prod_info='$info', price='$price', mod_date='$date' WHERE id ='$id' ";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run){
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $msg ="Item uploaded successfuly";

            $_SESSION['message'] = "Record has been updated!";
            $_SESSION['msg_type'] = "warning";

         header("Location: adminProduct.php");
        }
        else{
            $msg = "Item not uploaded";
        }
    }
}

?>