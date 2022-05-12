<? 
    if (isset($_GET['registered'])){
        $registered = $_GET['registered'];
    }

?>

<!-- LOGIN PAGE -->
<!DOCTYPE html>
<html lang = en>
    <head>
        <meta charset='UTF-8'/>
        <title>Login</title>
        <link rel='stylesheet' href='./css/styles.css' >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <script src='./Component/NavBar.js ' ></script>
    </head>
    <body>
        <nav-bar></nav-bar>
        <div class="login">
            
            <div class="container">
                <div class="option">
                    <button class="opt-btn active" id="user-btn" onclick="optionClick(this.id)">User</button>
                    <button class="opt-btn" id="driver-btn" onclick="optionClick(this.id)">Driver</button>
                </div>
                <div class="login-form" id="driver-form">
                    <form method="POST" action="authenticate.php?table=driver">
                        <label for="Email">Email: </label>
                        <input type="email" id ="email" name="email" placeholder="Enter email" required>

                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>


                        <input type="submit" value="Login" id="login-btn">
                        <p class="reg-link">Don't have an account? <a href="./register.php">Register</a></p>
                    </form>
                    <div class="greeting">
                        <h1> Drive with us </h1>
                        <p> Generate profit on your schedule </p>
                    </div>

                </div>
                <div class="login-form active" id="user-form">
                    <form method="POST" action="authenticate.php?table=customer">
                        <label for="Email">Email: </label>
                        <input type="email" id ="email" name="email" placeholder="Enter email" required>

                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required>


                        <input type="submit" value="Login" id="login-btn">
                        <p class="reg-link">Don't have an account? <a href="./register.php">Register</a></p>
                    </form>
                    <div class="greeting">
                        <h1> Go on a journey </h1>
                        <p> Arrive on time </p>
                    </div>

                </div>

                
            </div>
        </div>
        <script type="text/javascript">
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
                const forms = document.getElementsByClassName("login-form");
               
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