<?php
    include('header.php');
    include('navbar.php');
?>

<section class="repair-holder m-auto" style="width:55%">
    <h1>Ask for Assistance</h1>
    <hr/>
    <form action="request.php" method="post">
        <div class="row repair-form">
            <div class="col-md-12">
                <h4>Client Name</h4>
                <div class="row">
                    <div class="form-group pb-4">
                        <input id="repair-firstname" name="client_name" type="text" placeholder="Client Name" required/>
                    </div>
                </div>

                <h4>Email</h4>
                <div class="form-group pb-4">
                    <input id="repair-email" name="email" type="text" placeholder="Contact Email" required/>
                </div>

                <h4>Employee ID</h4>
                <div class="form-group pb-4">
                    <input id="repair-empID" name="empID" type="text" placeholder="Employee ID" required/>
                </div>

                <h4>Department</h4>
                <div class="form-group pb-4">
                    <input id="repair-dept" name="department" type="text" placeholder="Employee ID" required/>
                </div>
                
                <hr/>
                
                <h5>Issue</h5>

                <h4>Subject</h4>
                <div class="form-group pb-4">
                    <input id="issue-subject" name="issueSubject" type="text" required/>
                </div>

                <h4>Description</h4>
                <div class="form-group pb-4">
                    <textarea id="issue-description" name="desc" type="text" rows="8" required></textarea>
                </div>
            </div>
        </div>

        <div class="row repair-form d-flex justify-content-end px-4">
                <a href="home.php" class="btn btn-lg custom-cancel mx-4">Cancel</a>
                <input name="submit_button" type="submit" value="Submit" class="btn btn-lg custom-submit">
        </div>

        <hr/>
    </form>
</section>

<?php include('footer.php'); ?>