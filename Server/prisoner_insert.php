<?php
    include 'connect.php';
    // print_r($_POST);
    $pno = $_POST['pno'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $bdate = $_POST['bdate'];
    $sex = $_POST['sex'];                   
    $ssn = $_POST['ssn'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $cellno = $_POST['cellno'];
    $offenses = $_POST['offenses'];
    $count = $_POST['count'];
    $offs = array_combine($offenses,$count);
    // print_r($offs);
    try{
        //updating prisoner table
        $ins_query = "UPDATE prisoners SET fname='".$fname."', lname='".$lname."' ,bdate='".$bdate."', sex='".$sex."', ssn='".$ssn.
        "',start='".$start."'";
        if($end!=""){
            $ins_query = $ins_query.", end='".$end."'";
        }
        $ins_query = $ins_query.", cellno=".$cellno." WHERE ssn=".$ssn;
        if($conn->query($ins_query)==true){

            //deleting values from offenses to avoid redundancy
            $charge_del_query = "DELETE from offenses where pno=".$pno;
            if($conn->query($charge_del_query)==true){

                //inserting into offenses
                $charge_query = "Insert into offenses(pno,cno,counts) values ";
                foreach ($offs as $charge => $cnt){
                    $charge_query = $charge_query."(".$pno.",".$charge.",".$cnt."),";
                }
                $charge_query = rtrim($charge_query,",");
                $charge_query = $charge_query.";";
                if($conn->query($charge_query)==true){
                    echo "1";
                }
                else{
                    echo "Error Occured:".$conn->error;
                }

            }
            else{
                echo "Error Occured:".$conn->error;
            }
            
        }
        else{
            echo "Error Occured:".$conn->error;
        }
    }
    catch(Exception $e){
        echo "Error Occured : ".$e->getMessage();
    }
?>
