<?php
    include('header.php');
    include('navbar.php');
?>

<section>
    <h1>Ask for Assistance</h1>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <h4>Name</h4>
            <div class="row">
                <div class="form-group">
                    <input id="repair-firstname" name="firstname" type="text" placeholder="First Name"/>
                    <input id="repair-lastname" name="lastname" type="text" placeholder="Last Name"/>
                </div>
            </div>

            <h4>Email</h4>
            <div class="form-group">
                <input id="repair-email" name="email" type="text" placeholder="Contact Email"/>
                <input id="repair-confEmail" name="confEmail" type="text" placeholder="Confirm Email"/>
            </div>

            <h4>Employee ID</h4>
            <div class="form-group">
                <input id="repair-empID" name="empID" type="text" placeholder="Employee ID"/>
            </div>

            <h4>Department</h4>
            <div class="form-group">
                <input id="repair-dept" name="department" type="text" placeholder="Employee ID"/>
            </div>
            
            <hr/>
            
            <h5>Issue</h5>

            <h4>Subject</h4>
            <div class="form-group">
                <input id="issue-subject" name="issueSubject" type="text"/>
            </div>

            <h4>Description</h4>
            <div class="form-group">
                <textarea id="issue-description" name="issueSubject" type="text" rows="15"></textarea>
            </div>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-2 my-2">
            <a href="home.php" class="btn btn-outline custom-cancel">Cancel</a>
        </div>
        <div class="col-md-2">
            <input name="register_button" type="submit" value="Submit" class="btn custom-signup">
        </div>
    </div>
</section>

<?php include('footer.php'); ?>