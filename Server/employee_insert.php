<?php
    include 'connect.php';
    // print_r($_POST);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];                   
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];
    $super_ssn = $_POST['super_ssn'];
    $block = $_POST['block'];
    $ssn = $_POST['ssn'];
    try{
        $ins_query = "UPDATE employee SET fname='".$fname."', lname='".$lname."' ,bdate='".$dob."', sex='".$sex."', designation='".$designation.
        "',salary=".$salary;
        if($super_ssn!=""){
            $ins_query = $ins_query.", super_ssn=".$super_ssn;
        }
        $ins_query = $ins_query.", bno=".$block." WHERE ssn=".$ssn;
        if($conn->query($ins_query)==true){
            echo "1";
        }
        else{
            echo "Error Occured:".$conn->error;
        }
    }
    catch(Exception $e){
        echo "Error Occured : ".$e->getMessage();
    }
?>