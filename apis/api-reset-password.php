<?php

require_once(__DIR__.'/../globals.php');
session_start();

// validate the password
if( ! isset($_POST['password'])){ _res(400, ['info' => 'password required']); };
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN ){ _res(400, ['info' => 'password must be at least '._PASSWORD_MIN_LEN.' characters']); };
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN ){ _res(400, ['info' => 'password cannot be more than '._PASSWORD_MAX_LEN.' characters']); };

// check that passwords match 
if( ! isset($_POST['repeat_password'])){ _res(400, ['info' => 'Both password fields required']); };
if( strlen($_POST['repeat_password']) < _PASSWORD_MIN_LEN ){ _res(400, ['info' => 'password must be at least '._PASSWORD_MIN_LEN.' characters']); };
if( strlen($_POST['repeat_password']) > _PASSWORD_MAX_LEN ){ _res(400, ['info' => 'password cannot be more than '._PASSWORD_MAX_LEN.' characters']); };
if($_POST['repeat_password'] !== $_POST['password']){ _res(400, ['info' => 'Passwords do not match']); };

// Connect to DB
try{
    $db = _db();
  
  }catch(Exception $ex){
    _res(500, ['info' => 'System under maintenence', 'error' => __LINE__]);
  }

  try{
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  

    // Update data 
    $q = $db->prepare('UPDATE users SET user_password = :user_password WHERE user_id = :user_id');
    $q->bindValue(":user_id", $_SESSION['user_id']);
    $q->bindValue(":user_password", $password);
    $q->execute();

    // SUCCESS
    header('Content-Type: application/json');
  
    $response = ["info" => "Password changed"];
    echo json_encode($response);

    $_SESSION['user_id'] = $user_id;
    
  }catch(Exception $ex){
    http_response_code(500);
    echo 'System under maintainance';
    exit();
  }
