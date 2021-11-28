<?php

define('_PASSWORD_MIN_LEN', 6);
define('_PASSWORD_MAX_LEN', 20);
define('_NAME_MIN_LEN', 1);
define('_NAME_MAX_LEN', 40);
define('_PHONENUMBER_MIN_LEN', 8);
define('_PHONENUMBER_MAX_LEN', 8);




##############################
function _res( $status=200, $message=[] ){
  http_response_code($status); 
  header('Content-Type: application/json'); 
  echo json_encode($message); 
  exit();
}


##############################
function _db(){
  $database_user_name = 'root';
  $database_pasword = 'root';
  $database_connection = 'mysql:host=localhost; dbname=company; charset=utf8mb4';

  $database_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  return new PDO( $database_connection, $database_user_name, $database_pasword, $database_options ); 
}




















