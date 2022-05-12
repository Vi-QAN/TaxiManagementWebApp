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
    if ($_GET['edited'] === 'false'){
        $col = $_GET['col'];
        $val = $_GET['val'];
        $table = $_GET['table'];
        header('Location: dashboard.php?edited=false&col='.$col.'&val='.$val.'&table='.$table);
    }
    else {
        $db = new Database();
        $table = $_GET['t'];
        $col = $_GET['col'];
        echo $table;
        $newVals = array();
        $condition = "";
        
        foreach($_POST as $key => $val){
            $newVal = $key.' = "'.$val.'"';
            if (strtolower($col) !== strtolower($key)){
                array_push($newVals,$newVal);
            }
            else {
                $condition = $newVal;
            }
            
        }
        $result = $db->updateData($newVals,$condition,$table);
        header('Location: dashboard.php');
    }

?>