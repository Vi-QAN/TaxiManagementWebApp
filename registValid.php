<?php 
    require_once('database.php');
    $table = $_GET['t'];
    $cols = array();
    foreach($_POST as $key => $val){
        $cols[$key] = $val;
    }


    foreach($cols as $key => $val){
        echo $key." ".$val."<br>";
    }
    $db = new Database();
    $result = $db->validate($cols['email'],$table);
    $rows = $result->fetch_all();
    if (count($rows) >= 1){
        header("Location: register.php?valid=false&page=$table");
    }
    else {
        $db->addData($cols,$table);
        header("Location: login.php?registered=true");
    }


?>