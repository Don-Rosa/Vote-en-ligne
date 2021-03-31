<?php

$email = $_GET['AUTH_USER'];
$pwd = $_GET['AUTH_PW'];


$jsonString = file_get_contents('login.json');
$myObj = json_decode($jsonString, true);

$valid = 1;

foreach($myObj as $a){
    if( $a["email"] == $email || $pwd == '' || $email == ''){
        $valid=0;
        break;
    }else{
        $valid=1;
    }
}

if($valid ==1){
       $logins =  array("email"=>$email, "pwd"=>$pwd);
       $myObj[] = $logins;
       $logs = json_encode($myObj);
       file_put_contents('login.json', $logs);
}else{
    echo "False" ;
}



?>