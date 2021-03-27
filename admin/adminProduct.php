<?php
    if(isset($_POST['item-insert']))
    {
        $target = "images/" .basename($_FILES['image']['name']);

        $mysqli = new mysqli('localhost', 'root', '','dbtest') or die(mysqli_error($mysqli));
        $conn = mysqli_connect('localhost', 'root', '');
        $db = mysqli_select_db($conn,'dbtest');

        $category = $_POST['item-category'];
        $product = $_POST['item-name'];
        $image = $_FILES['image']['name'];
        $info = $_POST['item-info'];
        $price = $_POST['item-price'];
        $date = $_POST['item-date'];

        $mysqli->query("INSERT into products (category, product, image, prod_info, price, start_date, mod_date) VALUES ('$category', '$product', '$image', '$info', '$price', 'now()', '$date')")
        or die($mysqli->error);

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $msg ="Item uploaded successfuly";
        }
        else{
            $msg = "Item not uploaded";
        }

    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administrator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/adminUser.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

<?php
        $mysqli = new mysqli('localhost', 'root', '','dbtest') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM products") or die($mysqli->error);

  ?>

    <header>
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">ADMINISTRATOR</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="adminUser.php">Accounts<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="adminProduct.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adminStatus.php">Status</a>
                        </li>
                        <li>
                            <button class="btn btn-dark" data-toggle="modal"
                                data-target=".bs-example-modal-sm">Logout</button>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Products</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Details</th>
                        <th>Highest Bidder</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php             
                    while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?> </td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['product']; ?></td>


                        <td>
                        <div class="img-container">
                        <img src="images/<?= $row['image']?>" style="width: 300px; height:300px">
                        </div>
                        </td>


                        <td><?php echo $row['prod_info']; ?> </td>
                        <td><?php echo $row['buyer']; ?> </td>
                        <td>
                             <button type="button" class="btn btn-success editbtn" value="Edit">Edit</button>
                             <button type="button" class="btn btn-danger deletebtn" value="Delete">Delete</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
               
                <form method="POST" action="adminProduct.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name = "item-category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Product</label>
                            <input type="text" name="item-name" class="form-control" required>
                        </div>
                        <div>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <input type="text" name="item-info" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Starting Price</label>
                            <input type="number" name="item-price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>End date/time:</label>
                            <input type="date" name="item-date" class="form-control" required>
                        </div>
                     



                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" name="item-insert" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="updateitem.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" id="item-category" name="item-category" required>
                        </div>
                        <div class="form-group">
                            <label>Product</label>
                            <input type="text" class="form-control" id="item-product" name="item-product" required>
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <input type="text" class="form-control" id="item-info" name="item-info" required>
                        </div>
                        <div class="form-group">
                            <label>Starting Price</label>
                            <input type="number" class="form-control" id="item-price" name="item-price" required>
                        </div>
                        <div class="form-group">
                            <label>End date/time:</label>
                            <input type="date" class="form-control" id="item-date" name="item-date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save" name="update-item">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="removeitem.php" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Product?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-danger" name="delete-item">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Log out modal-->
    <div class="modal bs-example-modal-sm fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Logout Administrator<i class="fa fa-lock"></i></h4>
                </div>
                <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
                <div class="modal-footer"><a href="index.php" class="btn btn-primary btn-block">Logout</a></div>
            </div>
        </div>
    </div>
    <!--View Items modal-->
    <div id="btnView" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title">Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>DITO NAKALAGAY YUNG INFO</p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>

    <script>
    $(document).ready(function() {
      $('.deletebtn').on('click', function() {
        $('#deleteEmployeeModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#delete_id').val(data[0]);
      
      });
    });
  </script>


<script>
    $(document).ready(function() {
      $('.editbtn').on('click', function() {
        $('#editEmployeeModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#update_id').val(data[0]);
        $('#item-category').val(data[1]);
        $('#item-product').val(data[2]);
        $('#image').val(data[3]);
        $('#item-info').val(data[4]);
        $('#item-price').val(data[5]);
        $('#item-date').val(data[6]);

      });
    });
  </script>

</body>

</html>