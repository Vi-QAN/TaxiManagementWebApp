<!-- Allow user to add more company to registered list -->

<?php 
    require("database.php");
    session_start();
    if (isset($_SESSION['name']) && isset($_SESSION['password']) ){
        $name = $_SESSION['name'];
        $password = $_SESSION['password'];
    }
    else {
        header("Location: login.php" );
    }
    $db = new Database();
    $table = $_GET['t'];
    $cols = array();
    foreach($_POST as $key => $val){
        $cols[$key] = $val;
    }
    $result = $db->validate($cols['name'],$table);
    $rows = $result->fetch_all();
    print_r($rows);
    if (count($rows) >= 1){
        header("Location: dashboard.php?added=false");
    }
    else {
        $db->addData($cols,$table);
        header("Location: dashboard.php?");
    }

?>