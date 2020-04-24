<!DOCTYPE html>
<html>
    <?php 
        include 'includes/header.php';
        include "server/connect.php";
        $pno = $_GET["pno"];
		$pquery = "SELECT fname,lname,pno,bdate,sex,start,end,ssn,cellno FROM prisoners where pno = ".$pno;
        $presult = $conn->query($pquery);
        $pdata = $presult->fetch_assoc();

        $offenses = "SELECT pno, charge, counts FROM offenses, charges where cno=chno and pno=".$pno;
        $off_results = $conn->query($offenses);

        $charges = "SELECT * FROM charges";
        $charge_results = $conn->query($charges);
    ?>   
    <body>
        <div class="container-fluid text-center top-container">
            <img src="images/noimage.jpg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Prisoner No. <?php echo $pno; ?></h1>
                    <form name="login" action="" method="post">
                        First Name : <input class="form-control" type = "text" name = "fname" value = "<?php echo $pdata['fname']; ?>" /><br />
                        Last Name  : <input class="form-control" type = "text" name = "lname" value = "<?php echo $pdata['lname']; ?>" /><br />
                        Ssn        : <input class="form-control" type = "text" name = "ssn" value = "<?php echo $pdata['ssn']; ?>" /><br />
                        DOB        : <input class="form-control" type = "date" name = "bdate" value = "<?php echo $pdata['bdate']; ?>" style="background-color: #f1f1f1;"/><br />
                        Sex        : <select class="form-control" name = "sex" style="background-color: #f1f1f1;">
                                        <option value = "M" <?php echo ($pdata['sex'] == 'M')?"selected":""; ?>>Male</option>
                                        <option value = "F" <?php echo ($pdata['sex'] == 'F')?"selected":""; ?>>Female</option>
                                        <option value = "O" <?php echo ($pdata['sex'] == 'O')?"selected":""; ?>>Other</option>
                                    </select><br />
                        Start      : <input class="form-control" type = "date" name = "start" value = "<?php echo $pdata['start']; ?>" style="background-color: #f1f1f1;"/><br />
                        End        : <input class="form-control" type = "date" name = "end"   value = "<?php echo $pdata['end']; ?>" style="background-color: #f1f1f1;"/><br />
                        Cell       : <input class="form-control" type = "text" name = "cellno"   value = "<?php echo $pdata['cellno']; ?>" style="background-color: #f1f1f1;"/><br />
                        Charges    :
                        <div id = "chargeDiv">
                        <?php while($poffense = $off_results->fetch_assoc()){ ?>
                            <div class="input-group mb-3"> 
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Charge</span>
                                </div>
                                <select class="form-control" name = "offenses" style="background-color: #f1f1f1;">
                                    <option value = "None">None</option>

                                <?php while($pcharge = $charge_results->fetch_assoc()){ ?>
                                    <option value = "$pcharge['chno']" <?php echo ($pcharge['charge']==$poffense['charge'])?"selected":""; ?>> <?php echo $pcharge['charge'] ?> </option>
                                <?php } ?>

                                </select>
                                <input class="form-control" type = "number" name = "count" value = "<?php echo $poffense['counts']; ?>" style="background-color: #f1f1f1;"/>
                                <button class="btn btn-secondary"> - </button>
                            </div>
                        <?php } ?>
                        </div>
                        <div class="col">
                            <button id = "AddBtn" class="btn add" onclick="myFunction()"> + </button>
                        </div>
                        <input type = "hidden" name = "pno" value = "<?php echo $pdata['pno']; ?>" />
                        <input class="btn-submit" type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("AddBtn").click(function(){
                var a = ` <div class="input-group mb-3"> 
                            <div class="input-group-prepend">
                                <span class="input-group-text">Charge</span>
                            </div>
                            <select class="form-control" name = "offenses" style="background-color: #f1f1f1;">
                                <option value = "None">None</option>
                            <?php while($pcharge = $charge_results->fetch_assoc()){ ?>
                                <option value = "$pcharge['chno']" <?php echo ($pcharge['charge']==$poffense['charge'])?"selected":""; ?>> <?php echo $pcharge['charge'] ?> </option>
                            <?php } ?>
                            </select>
                            <input class="form-control" type = "number" name = "count" style="background-color: #f1f1f1;"/>
                            <button class="btn btn-secondary"> - </button>
                        </div> `;
                var b = "<button> new </button>"
                $("#chargeDiv").append(b);
            });
        });
    </script>
</html>
