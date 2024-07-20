<?php

session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => _DOMAIN_,
    'secure' => false,
    'httponly' => true,
   
]);

session_start();

function isConnect (){
     if (empty($_SESSION["user"])){
         return false;
     }else return true;
 }
function isAdmin (){
     if (!isset($_SESSION["user"]["role"])||$_SESSION["user"]["role"]
     !="admin"){
         return false; 
     }else return true;
 }
function isEmploye  (){
     if (!isset($_SESSION["user"]["role"])||($_SESSION["user"]["role"]
     !="employe"&&$_SESSION["user"]["role"]!="admin")){
        return false; 
     }else return true;
 }
 function isVeterinaire  (){
    if (!isset($_SESSION["user"]["role"])||($_SESSION["user"]["role"]
    !="employe"&&$_SESSION["user"]["role"]!="admin")){
        return false;  
    }else return true;
}

function requireConnect (){
    if (!isConnect()){
        die(json_encode(array(
            "status" => false,
            "message" => "vous devez vous connecter"
         )));  
    }
}
function requireAdmin (){
    if (!isAdmin()){
        die(json_encode(array(
            "status" => false,
            "message" => "accès reservé a l'admin"
         )));  
    }
}
function requireEmploye  (){
    if (!isEmploye()){
        die(json_encode(array(
            "status" => false,
            "message" => "accès reservé a l'employe"
         )));  
    }
}
function requireVeterinaire  (){
   if (!isVeterinaire()){
       die(json_encode(array(
           "status" => false,
           "message" => "accès reservé au vétérinaire"
        )));  
   }
}