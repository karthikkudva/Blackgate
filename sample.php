<!-- <script>
        function validate(){
            $.ajax({
                url: "server/login.php",
                type: "POST",
                data: {
                    username: $("#username").val(), 
                    password: $("#password").val()
                    },
                success: function(result){
                    // alert(result);
                    if(result==1){
                        alert("Connected Succesfully!");
                        return true;
                    }
                    else{
                        alert("Invalid Credentials!");
                        $("#username").val("");
                        $("#password").val("");
                        return false;
                    }
                }
            });
        }
</script> -->

<a href="http://localhost/blackgate/employee_details.php?eno=0"><button>Details</button></a>