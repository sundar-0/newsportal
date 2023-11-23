<?php
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirm=$_POST['confirm'];
    $name=$_POST['name'];
    
    $msg = new stdClass();
    $msg->nameError="";
    $msg->emailError="";
    $msg->passwordError="";
    $msg->cPasswordError="";
    $msg->success="";
    $msg->error="";


    $userNamePattern = "/[a-zA-Z]+/";
    if($name==""){
        $msg->nameError="name is empty";
    }

    else if(!preg_match($userNamePattern, $name)){
        $msg->nameError="name can't be numeric";
    }
    

 
    if($email==""){
        $msg->emailError="email address is empty";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg->emailError="Email address is not valid";
    }
    if($password==""){
        $msg->passwordError="password is empty";
    }
    if($confirm==""){
        $msg->cPasswordError="confirm password is empty";
    }
    if($password!=$confirm){
        $msg->cPasswordError="password does not match";
    }
    $conn=mysqli_connect('localhost','root','','project');
    if($conn->connect_errno!=0){
    die("connection failed");
    }

    

    if($msg->nameError=="" &&$msg->emailError=="" &&$msg->passwordError=="" &&$msg->cPasswordError==""){
        $sql= "INSERT INTO user(name,emails,password,confirm) VALUES('".$name."','".$email."','".$password."','".$confirm."')" ;
       

    

        if($conn->query($sql)){
            $msg->success="Register Successfully!!!";
        }
        else{
            $msg->error="Internal Error";
           
        }
      
        
    }
    $myJSON = json_encode($msg);
    echo $myJSON;
       
?>

