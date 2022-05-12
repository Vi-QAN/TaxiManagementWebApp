<?php 
    require_once("database.php");
    session_start();
    if (isset($_SESSION['name']) && isset($_SESSION['password']) ){
        $name = $_SESSION['name'];
        $password = $_SESSION['password'];
    }
    else {
        header("Location: login.php" );
    }
    $confirmed = $_GET['confirmed'];
    if ($confirmed === 'false'){
        $col = $_GET['col'];
        $val = $_GET['val'];
        $table = $_GET['table'];
        header("Location: dashboard.php?confirmed=false&col=$col&val=$val&table=$table");
    }
    else {
        $col = $_GET['col'];
        $val = $_GET['val'];
        $table = $_GET['table'];
        $db = new Database();
        $result = $db->deleteData($col,"'".$val."'",$table);
        if ($result){
            header("Location: dashboard.php?deleted=true&table=$table" );
        }
        else {
            header("Location: dashboard.php?deleted=false&table=$table" );
        }
    }
    


?> 