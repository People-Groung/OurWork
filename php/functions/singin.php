<?php
    session_start();

    require_once('./connect.php');

    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $check_user = $connect->prepare("SELECT * FROM `registration` WHERE `login` = '$login' AND `password` = '$password'");
    $check_user->execute();

    $user = $check_user->fetch(PDO::FETCH_ASSOC);

    if($user>0){
       $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "full_name" => $user['full_name'],
            "avatar" => $user['avatar'],
            "email" => $user['email']
        ];
        
        header('Location: ../profile.php'); 
    }
    else{
        $_SESSION['message'] = 'Неверный логин или пароль!!!';
        header('Location: ../singin.php');  
    }     