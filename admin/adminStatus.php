<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/adminStatus.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>
<body>
<?php require 'queuestatus.php'?>
<?php 
      $mysqli = new mysqli('localhost', 'root', '','request') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM ticket") or die($mysqli->error);
?>

  <header>
    <div class="container-fluid p-0">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Administrator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item">
              <a class="nav-link disabled" href="adminUser.php">Accounts<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="adminProduct.php">Product</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="adminStatus.php">Services</a>
            </li>
            <li>
              <button class="btn btn-dark" data-toggle="modal" data-target=".bs-example-modal-sm">Logout</button>
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
            <h2>Services Status</h2>
          </div>
        </div>
      </div>

      <table class="table table-hover table-striped table-responsive mx-auto mt-0 px-auto">
        <thead>
          <tr>
            <th>ID</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Employee ID</th>
            <th>Department</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Date Issued</th>
            <th>Actions</th>
            <th>Status</th>
            <th>Date Resolved</th>
          </tr>
        </thead>
        <tbody>
        <?php
          while($row = $result->fetch_assoc()): ?>
          <tr>        
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['employee_id']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['issue']; ?></td>
            <td><?php echo $row['date_issued']; ?></td>
            <td>
                <!-- <button type="submit" class="btn btn-success resolvebtn" value="Edit" name="Resolve" id="resolve_id">Resolve</button> -->
                <button type="submit" class="btn btn-success queuebtn" value="Delete" name="Queue">Resolve</button> 
            </td>
            <td>
            <?php echo $row['status_update']; ?>
            </td>
            <td><?php echo $row['date_resolved']; ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Resolve Modal HTML 
  <div id="resolve_ticket" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="resolvestatus.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Resolve Task</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <input type="hidden" name="resolve_id" id="resolve_id">

            <p>Is the Task Resolved?</p>
            <p class="text-warning"><small>Make sure the task is completed before proceeding</small></p>
          </div>
          <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="Resolve">Proceed</button>
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            
          </div>
        </form>
      </div>
    </div>
  </div>
-->
    <!-- Queue Modal HTML -->
    <div id="queue_ticket" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="queuestatus.php" method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Queue Task</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
          <input type="hidden" name="queue_id" id="queue_id">

            <p>Is the Task Resolved?</p>
            <p class="text-warning"><small>Make sure the task is complete before proceeding</small></p>
          </div>
          <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="Queue">Proceed</button>
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            
          </div>
        </form>
      </div>
    </div>
  </div>


  <!--Log out modal-->
  <div class="modal bs-example-modal-sm fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header"><h4>Logout Administrator<i class="fa fa-lock"></i></h4></div>
        <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
        <div class="modal-footer"><a href="index.php" class="btn btn-primary btn-block">Logout</a></div>
      </div>
    </div>
  </div>
  <script src="js/script.js"></script>

  <script>
    $(document).ready(function() {
      $('.resolvebtn').on('click', function() {
        $('#resolve_ticket').modal('show');


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#resolve_id').val(data[0]);
      
      });
    });
  </script>

<script>
    $(document).ready(function() {
      $('.queuebtn').on('click', function() {
        $('#queue_ticket').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#queue_id').val(data[0]);
      
      });
    });
  </script> 

</body>
</html>
