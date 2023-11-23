<?php
if(isset($_POST['login']))
{
    $email=$_POST['emails'];
    $password=$_POST['password'];
    // databases connection
    $conn=mysqli_connect('localhost','root','','project');
    if($conn->connect_errno!=0){
        die("connection failed");
    }
        $sql= "SELECT * FROM user WHERE emails='".$email."' 
        AND password= '".$password."'";
        $result= $conn->query($sql);
        $row=mysqli_fetch_array($result);
        echo $row;
        if($result->num_rows>0)
        {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['users']=$row['uid'];
        
   
        header('Location:index.php');
    }
    else{
        echo "<script> alert('user not found');
               
                </script>";
                
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="ccs/style.css">
</head>
<body>
<div class="container mt-5 ">
    <div class="d-flex justify-content-center mb-3">
    <form method="post" action="#" class="form">
      <h1 class="hotelbtn ">Newsportal Login</h1>
  <div class="mb-3 mt-5">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input name="emails" type="email" autocomplete class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
  </div>

  <button type="submit" name="login" class="btns btn-primary">Login</button><br><br>
  <button class="register" type="button"> or Sign up now!!</button>
</form>
</div>
  
</div>



<div class="modal fade"  id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="regForm" method="post">
            <div class="modal-header">
                <h5 class="modal-title">New Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="nameError" style="color: red;"></span>
                        
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email"  name="email">
                        <span class="emailError" style="color: red;"></span>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirm" name="password">
                        <span class="passwordError" style="color: red;"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">confirm</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirm" name="confirm">
                        <span class="confirmPasswordError" style="color: red;"></span>
                    </div>
                </div>

                <div class="row mb-3">
          
                    <div class="col-sm-9">
                    <span class="text-center success" style="color: green;"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-9">
                    <span class="text-center failure" style="color: red;"></span>
                    </div>
                </div>
                
              
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="register" name="register"  class="btn btn-primary" >Register</button>
                <input type="hidden" id="hidden_id" name="hidden_id" />
            </div>
        </form>
    </div>
  </div>
</div>



<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script>

let nameError=$(".nameError"),
emailError=$(".emailError"),
passwordError=$(".passwordError"),
confirmPasswordError=$(".confirmPasswordError"),
success=$(".success"),
failure=$(".failure");
$(document).ready(function(){
        $('.register').click(function(){   
          $('#myModal').modal('show');
         });

    $('#register').click(function(e){
            var regForm=document.getElementById("regForm");
            $.ajax({
                        url:"phpFile/create.php",
                        method:"POST",
                        data: new FormData(regForm),
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function(data){
                           let x=JSON.parse(data)
                  

                           nameError.text(x.nameError)
                           emailError.text(x.emailError)
                           passwordError.text(x.passwordError)
                           confirmPasswordError.text(x.cPasswordError)

       

                           success.text(x.success);
                           failure.text(x.error);


                
                         
                          
                        }
                    
                  });
             
              
                }
                )
            });
</script>

</body>
</html>
