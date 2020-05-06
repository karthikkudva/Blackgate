<!DOCTYPE html>
<html>
    <?php 
        include 'includes/header.php';
        include "server/connect.php";
        $eno = $_GET["eno"];
		$emp_query = "SELECT * FROM visitors where ssn=".$eno;
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
                    <form name="login" action="employees.php" method="post" onsubmit="return validate();">
                        First Name : <input class="form-control" type = "text" id = "fname" name = "fname" value = "<?php echo $emp_data['fname']; ?>" /><br />
                        Last Name  : <input class="form-control" type = "text" id = "lname" name = "lname" value = "<?php echo $emp_data['lname']; ?>" /><br />
                        DOB        : <input class="form-control" type = "date" id = "dob" name = "dob" value = "<?php echo $emp_data['bdate']; ?>" style="background-color: #f1f1f1;"/><br />
                        Address    : <input class="form-control" type = "text" id = "address" name = "address" value = "<?php echo $emp_data['address']; ?>" /><br />
                        Sex        : <select class="form-control" id = "sex" name = "sex" style="background-color: #f1f1f1;">
                                        <option value = "M" <?php echo ($emp_data['sex']=='M')?"selected":""; ?> >Male</option>
                                        <option value = "F" <?php echo ($emp_data['sex']=='F')?"selected":""; ?> >Female</option>
                                        <option value = "O" <?php echo ($emp_data['sex']=='O')?"selected":""; ?> >Other</option>
                                    </select><br />
                        Designation :<input class="form-control" type = "text" id="designation" name = "designation" value = "<?php echo $emp_data['designation']; ?>" style="background-color: #f1f1f1;"/><br />
                        Salary      :<input class="form-control" type = "number" id="salary" name = "salary" value = "<?php echo $emp_data['salary']; ?>" style="background-color: #f1f1f1;"/><br />
                        Supervisor  :
                        <select class="form-control" id="super_ssn" name = "super_ssn" style="background-color: #f1f1f1;">
                            <option value = "">--</option>
                        <?php while ($sup_data = $sup_results->fetch_assoc()){ ?>
                            <option value = "<?php echo $sup_data['ssn']; ?>" <?php echo ($emp_data['super_ssn']==$sup_data['ssn'])?"selected":""; ?>><?php echo $sup_data['fname']." ".$sup_data['lname']; ?></option>
                        <?php } ?>
                        </select>
                        <br/>
                        Block       : <input class="form-control" type = "text" id="block" name = "block" value = "<?php echo $emp_data['bno']; ?>" style="background-color: #f1f1f1;"/><br />
                        <input type = "hidden" id="ssn" name = "ssn" value = "<?php echo $emp_data['ssn']; ?>" />
                        <input class="btn-submit" id="submit" type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function validate(){
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var dob = $('#dob').val();
        var sex = $('#sex').val();
        var designation = $('#designation').val();
        var salary = $('#salary').val();
        var super_ssn = $('#super_ssn').val();
        var block = $('#block').val();
        var ssn = $('#ssn').val();
        var flag = 1;
        $.ajax({
            url : "server/employee_insert.php",
            type: "POST",
            data : {
                    fname:fname,
                    lname:lname,
                    dob:dob,
                    sex:sex,
                    designation:designation,
                    salary:salary,
                    super_ssn:super_ssn,
                    block:block,
                    ssn:ssn
                },
            async : false,
            success: function(response, textStatus, jqXHR)
            {
                if(response==1){
                    alert("Updated Successfully!");
                    flag = 1;
                }
                else{
                    alert("Update unsuceessful!");
                    flag = 0;
                }
            }
        });
        if(flag == 0)
            return false;
    }
</script>
