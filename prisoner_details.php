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
        $i=0;
        while($pcharges[$i] = $charge_results->fetch_assoc()){
            $i++;
        }
        unset($pcharges[$i]);
    ?>   
    <body>
        <div class="container-fluid text-center top-container">
            <img src="images/noimage.jpg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 style="text-center">Prisoner No. <?php echo $pno; ?></h1>
                    <form name="login" action="" method="post" onsubmit="return validate();">
                        <label><b>First Name:</b></label>
                        <input class="form-control" type = "text" id = "fname" name = "fname" value = "<?php echo $pdata['fname']; ?>" /><br />
                        <label><b>Last Name:</b></label>
                        <input class="form-control" type = "text" id = "lname" name = "lname" value = "<?php echo $pdata['lname']; ?>" /><br />
                        <label><b>Ssn:</b></label>
                        <input class="form-control" type = "text" id = "ssn" name = "ssn" value = "<?php echo $pdata['ssn']; ?>" /><br />
                        <label><b>DOB:</b></label>
                        <input class="form-control" type = "date" id = "bdate" name = "bdate" value = "<?php echo $pdata['bdate']; ?>" style="background-color: #f1f1f1;"/><br />
                        <label><b>Sex:</b></label> 
                        <select class="form-control" id = "sex" name = "sex" style="background-color: #f1f1f1;">
                            <option value = "M" <?php echo ($pdata['sex'] == 'M')?"selected":""; ?>>Male</option>
                            <option value = "F" <?php echo ($pdata['sex'] == 'F')?"selected":""; ?>>Female</option>
                            <option value = "O" <?php echo ($pdata['sex'] == 'O')?"selected":""; ?>>Other</option>
                        </select><br />
                        <label><b>Start:</b></label>
                        <input class="form-control" type = "date" id = "start" name = "start" value = "<?php echo $pdata['start']; ?>" style="background-color: #f1f1f1;"/><br />
                        <label><b>End:</b></label>
                        <input class="form-control" type = "date" id = "end" name = "end"   value = "<?php echo $pdata['end']; ?>" style="background-color: #f1f1f1;"/><br />
                        <label><b>Cell:</b></label>
                        <input class="form-control" type = "text" id = "cellno" name = "cellno"   value = "<?php echo $pdata['cellno']; ?>" style="background-color: #f1f1f1;"/><br />
                        <label><b>Charges:</b></label>

                        <!-- charges -->
                        <div id = "chargeDiv">
                        <?php while($poffense = $off_results->fetch_assoc()){ ?>
                            <div class="input-group mb-3"> 
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Charge</span>
                                </div>
                                <select class="form-control" name = "offenses[]" style="background-color: #f1f1f1;">
                                    <option value = "None">None</option>

                                <?php foreach ($pcharges as $pcharge){ ?>
                                    <option value = "<?php echo $pcharge['chno']; ?>" <?php echo ($pcharge['charge']==$poffense['charge'])?"selected":""; ?>> <?php echo $pcharge['charge'] ?> </option>
                                <?php } ?>

                                </select>
                                <input class="form-control" type = "number" name = "count[]" value = "<?php echo $poffense['counts']; ?>" style="background-color: #f1f1f1;"/>
                                <button type="button" class="btn btn-secondary btn-rmv"> - </button>
                            </div>
                        <?php } //$i++; ?>
                        </div>

                        <div class="col">
                            <button type="button" id = "AddBtn" class="btn add"> + </button>
                        </div>
                        <input type = "hidden" id = "pno" name = "pno" value = "<?php echo $pdata['pno']; ?>" />
                        <input class="btn-submit" type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            // var i = <?php //echo $i; ?>;
            $("#AddBtn").click(function(){
                // alert("Added Clicked");
                var a = `<div class="input-group mb-3"> 
                            <div class="input-group-prepend">
                                <span class="input-group-text">Charge</span>
                            </div>
                            <select class="form-control" name = "offenses[]" style="background-color: #f1f1f1;">
                                <option value = "None">None</option>
                            <?php foreach ($pcharges as $pcharge){ ?>
                                <option value = "<?php echo $pcharge['chno']; ?>"> <?php echo $pcharge['charge'] ?> </option>
                            <?php } ?>
                            </select>
                            <input class="form-control" type = "number" name = "count[]" style="background-color: #f1f1f1;"/>
                            <button type="button" class="btn btn-secondary btn-rmv"> - </button>
                        </div>`;
                // i = i + 1;
                $("#chargeDiv").append(a);  
            });

            $(".btn-rmv").click(function(){
                // alert("Added Clicked");
                // i = i - 1;
                $(this).closest('div').remove();
            });
        });

        function validate(){
                var fname   = $('#fname').val();
                var lname   = $('#lname').val();
                var ssn     = $('#ssn').val();
                var bdate   = $('#bdate').val();
                var sex     = $('#sex').val();
                var start   = $('#start').val();
                var end     = $('#end').val();
                var cellno  = $('#cellno').val();
                var pno     = $('#pno').val();
                var offenses = $('select[name="offenses[]"]').map(function(){
                                    return this.value
                                }).get();
                var count   = $('input[name="count[]"]').map(function(){
                                    return this.value
                                }).get();
                var flag = 1;
                $.ajax({
                    url : "server/prisoner_insert.php",
                    type: "POST",
                    data : {
                            fname:fname,
                            lname:lname,
                            bdate:bdate,
                            sex:sex,
                            ssn:ssn,
                            start:start,
                            end:end,
                            cellno:cellno,
                            offenses:offenses,
                            count:count,
                            pno:pno
                        },
                    async : false,
                    success: function(response, textStatus, jqXHR)
                    {
                        // alert(response);
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
</html>
