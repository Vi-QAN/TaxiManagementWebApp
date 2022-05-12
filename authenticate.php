<!-- PERFORM AUTHENTICATION FOR LOGIN PAGE -->
<?php
    require_once("database.php");
    session_start();
    
    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $table = $_GET['table'];
    }
    else {
        // if not set return to login page
        header("Location: login.php?authenticated=false" ); 
    }  
    $db = new Database();
    $result = $db->getConditionalData(array('password'),'email',"'".$email."'",$table);
    $row = $result->fetch_assoc();
    $saved_passwd = $row['password'];
    if ($saved_passwd === $password ){
        $_SESSION['name'] = $email; 
        $_SESSION['password'] = $password;
        $_SESSION['table'] = $table;
        if ($email === 'admin@gmail.com'){
            $_SESSION['type'] = 'admin'; 
            header("Location: dashboard.php?page=$table&email=$email");
        }
        else {
            $_SESSION['type'] = 'normal';
            header("Location: dashboardUser.php?page=$table&email=$email");
        }
        
    }
    else {
        header("Location: login.php?authenticated=false");
    }
    
?>