<!DOCTYPE html>
<html>
    <?php 
        include 'includes/header.php';
        include "server/connect.php";
        $eno = $_GET["eno"];
		$emp_query = "SELECT * FROM employee where ssn=".$eno;
        $emp_result = $conn->query($emp_query);
        $emp_data = $emp_result->fetch_assoc();

        $sup_query = "SELECT ssn,fname,lname from employee";
        $sup_results = $conn->query($sup_query);
    ?>   
    <body>
        <div class="container-fluid text-center top-container">
            <img src="images/noimage.jpg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Employee No. <?php echo $emp_data['ssn']; ?></h1>
                    <form name="login" action="employees.php" method="post">
                        First Name : <input class="form-control" type = "text" name = "fname" value = "<?php echo $emp_data['fname']; ?>" /><br />
                        Last Name  : <input class="form-control" type = "text" name = "lname" value = "<?php echo $emp_data['lname']; ?>" /><br />
                        DOB        : <input class="form-control" type = "date" name = "dob" value = "<?php echo $emp_data['bdate']; ?>" style="background-color: #f1f1f1;"/><br />
                        Address    : <input class="form-control" type = "text" name = "address" value = "<?php echo $emp_data['address']; ?>" /><br />
                        Sex        : <select class="form-control" name = "sex" style="background-color: #f1f1f1;">
                                        <option value = "M" <?php echo ($emp_data['sex']=='M')?"selected":""; ?> >Male</option>
                                        <option value = "F" <?php echo ($emp_data['sex']=='F')?"selected":""; ?> >Female</option>
                                        <option value = "O" <?php echo ($emp_data['sex']=='O')?"selected":""; ?> >Other</option>
                                    </select><br />
                        Designation :<input class="form-control" type = "text" name = "designation" value = "<?php echo $emp_data['designation']; ?>" style="background-color: #f1f1f1;"/><br />
                        Salary      :<input class="form-control" type = "number" name = "salary" value = "<?php echo $emp_data['salary']; ?>" style="background-color: #f1f1f1;"/><br />
                        Supervisor  :
                        <select class="form-control" name = "super_ssn" style="background-color: #f1f1f1;">
                            <option value = "">--</option>
                        <?php while ($sup_data = $sup_results->fetch_assoc()){ ?>
                            <option value = "<?php echo $sup_data['ssn']; ?>" <?php echo ($emp_data['super_ssn']==$sup_data['ssn'])?"selected":""; ?>><?php echo $sup_data['fname']." ".$sup_data['lname']; ?></option>
                        <?php } ?>
                        </select>
                        <br/>
                        Block       : <input class="form-control" type = "text" name = "block" value = "<?php echo $emp_data['bno']; ?>" style="background-color: #f1f1f1;"/><br />
                        <input type = "hidden" name = "pno" value = "<?php echo $emp_data['ssn']; ?>" />
                        <input class="btn-submit" type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
        
    });
</script>
