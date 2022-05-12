<?php 
    $page = "";
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }
?>



<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Register</title>
        <link rel='stylesheet' href='./css/styles.css' >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <script src='./Component/NavBar.js ' ></script>
    </head>
    <body>
        <nav-bar></nav-bar>
        <div class="register">
            
            <div class="container">
                <div class="option">
                    <button class="opt-btn active" id="user-btn" onclick="optionClick(this.id)">User</button>
                    <button class="opt-btn" id="driver-btn" onclick="optionClick(this.id)">Driver</button>
                </div>
                <div class="form" id="driver-form">
                    <form method="POST" action="registValid.php?t=driver">
                        <label for="name">Full Name: </label>
                        <input type="text" id ="name" name="name" placeholder="Enter full name" required>

                        <label for="license">License Number: </label>
                        <input type="text" id ="license" name="license" placeholder="Enter license number" required>
                        
                        <label for="Email">Email: </label>
                        <input type="email" id ="email" name="email" placeholder="Enter email" required>
                        <?php
                            if (isset($_GET['valid'])){
                                if ($_GET['valid'] === 'false') {
                                    echo "<p class='error'> Email is used </p> ";
                                }  
                            }
                            
                        ?>
                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                        
                        <label for="status">Apply Status: </label>
                        <input type="text" id="status" name="EmploymentStatus" list = "statusList" placeholder="Choose status" required>
                        <datalist id="statusList">
                            <option value = "Part time">
                            <option value = "Full time">
                        </datalist>
                        <input type="submit" value="Register" id="register-btn" >
                        <p class="login-link">Already have an account? <a href="./login.php">Login</a>
                    </form>
                    <div class="greeting">
                        <h1> Drive with us </h1>
                        <p> Generate profit on your schedule </p>
                    </div>
                </div>
                <div class="form active" id="user-form">
                    <form method="POST"  action="registValid.php?t=customer">
                        <label for="Name">Full Name: </label>
                        <input type="text" id ="name" name="name" placeholder="Enter your full name" required>

                        <label for="Email">Email: </label>
                        <input type="email" id ="email" name="email" placeholder="Enter email" required>

                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                        
                        <label for="company">Company: </label>
                        <input type="text" id="company" name="company" list="compList" placeholder="Enter company name" required>
                        <datalist id="compList">
                            <?php
                                require_once("database.php");

                                $db = new Database();
                                $result = $db->getData(array('name'),'registered_company');
                                $names = array();
                                while ($row = $result->fetch_assoc()){
                                    array_push($names,$row['name']);
                                }
                                foreach($names as $name){
                                    echo '<option value="'.htmlentities($name).'">';
                                }
                            ?>
                        </datalist>
                        <input type="submit" value="Register" id="register-btn">
                        <p class="login-link">Already have an account? <a href="./login.php">Login</a>
                    </form>
                    <div class="greeting">
                        <h1> Go on a journey </h1>
                        <p> Arrive on time </p>
                    </div>
                   
                </div>

                
            </div>
        </div>
        <script type="text/javascript">
            var page = '<?=$page?>';
            if (page !== null){
                if (page === "driver"){
                    optionClick("driver-btn");
                }
                else {
                    optionClick("user-btn");
                }
                
            }
            
            function optionClick(id) {
                const optBtns = document.getElementsByClassName("opt-btn");
                for (let i=0; i < optBtns.length;i++){
                    let btn = optBtns[i];
                    if (btn.classList.contains("active")){
                        btn.classList.remove("active");
                    }
                }
                const activeBtn = document.getElementById(id);
                activeBtn.classList.add("active");
                const forms = document.getElementsByClassName("form");
               
                for (let i=0; i < forms.length;i++){
                    let form = forms[i];
                    if (form.classList.contains("active")){
                        form.classList.remove("active");
                    }
                }
                if (id === "user-btn"){
                    document.getElementById("user-form").classList.add("active");
                }
                else {
                    document.getElementById("driver-form").classList.add("active");
                }
            }
        </script>
    </body>
</html>