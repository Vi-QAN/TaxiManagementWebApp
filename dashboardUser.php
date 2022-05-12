<?php
    session_start();
    if (isset($_SESSION['name']) && isset($_SESSION['password']) ){
        $name = $_SESSION['name'];
        $password = $_SESSION['password'];
        $table = $_SESSION['table'];
    }
    else {
        header("Location: login.php" );
    }
    $displayConfirmed = "false";
    if (isset($_GET['confirmed'])){
        $displayConfirmed = 'true';
    }
    // $table = "";
    // if (isset($_GET['page'])){
    //     $table = $_GET['page'];
    // }
    $displayEdit = "false";
    if (isset($_GET['edit'])){
        $displayEdit = "true";
    }
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Dashboard</title>
        <link rel='stylesheet' href='./css/dashboardStyles.css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    </head>
    <body>
        <nav>
            <div class="logo">
                <a href="index.php">.TAXI</a>
            </div>
            <div class="navigation-links">
                <a href="./dashboard.php"> Dashboard </a> 
                <a href="./about.php">About Us</a>
                <a href="./services.php">Services</a>
                
            </div>
            <div class="user-tag">
                <button class="dropdown-btn" onclick="logout()"><i class="fa fa-user" aria-hidden="true"></i> <?php echo($name) ?> <i class="fa fa-caret-down"></i> </button>
                <div class="dropdown-content" id="dropdown-content">
                    <a href="./logout.php">Logout</a>
                </div>
            </div>
        </nav>
        <div class="dashboard">
            <div class="inner-nav">
                <?php 
                    if (isset($_GET['page'])){
                        $table = $_GET['page'];
                        echo '
                            <button class="opt" id="'.$table.'" onclick="render(this.id)">Profile</button>
                            <button class="opt" id="journey" onclick="render(this.id)">Journey</button>
                        ';
                    }
                     
                ?>
            </div>
            <div class="container">
                
                <div class="confirm" id="confirm">
                    <?php 
                        $table = $_GET['table'];
                        $col = $_GET['col'];
                        $val = $_GET['val'];
                        echo '<p> Confirm deletion to '.htmlentities($table)." ".htmlentities($col)." = ".htmlentities($val).'</p>';
                        echo '<a href="./deleteData.php?confirmed=true&table='.htmlentities($table).'&col='.htmlentities($col).'&val='.htmlentities($val).'"'.' class="fa fa-check" id="accept" aria-hidden="true"></a>';
                    ?>
                    <a href="./dashboard.php" class="fa fa-times" id="reject" aria-hidden="true"></a>        
                </div>
                <div class="content" id="content">
                    
                </div>

                <div class="pop-up" id="edit-form">
                    <h3>Edit record </h3>
                    
                    <form method="POST"  action="updateData.php?t=registered_company">
                        <label for="Name">Company: </label>
                        <input type="text" id ="name" name="name" placeholder="Enter company name" required>

                        <label for="Address">Address: </label>
                        <input type="text" id ="address" name="address" placeholder="Enter address" required>

                        <input type="submit" value="Submit" id="submit-btn">
                    </form>
                    
                </div>
            </div>
        </div>
        <script>
            let page = '<?=$_SESSION['table']?>';
            document.getElementById(page).click();

            // confirmation box controller
            let displayConfirm = '<?=$displayConfirmed?>';
            const confirmBox = document.getElementById('confirm');
            if (displayConfirm === 'true'){
                confirmBox.classList.add('active');                  
            }
            else {
                confirmBox.classList.remove('active');
            }


            /* When the user clicks on the button, 
            toggle between hiding and showing the dropdown content */
            function logout() {
                document.getElementById("dropdown-content").classList.toggle("active");
            }

            // Close the dropdown if the user clicks outside of it
            window.onclick = function(e) {
                if (!e.target.matches('.dropdown-btn')) {
                var myDropdown = document.getElementById("dropdown-content");
                    if (myDropdown.classList.contains('active')) {
                        myDropdown.classList.remove('active');
                    }
                }
            }
            
            // render data from tables onto the screen
            function render(option){
                
                const xhttp = new XMLHttpRequest();
                
                xhttp.onload = function() {
                    document.getElementById("content").innerHTML = this.responseText;
                }
                xhttp.open("GET", "databaseLoader.php?t="+option);
                xhttp.send();
                
                // const addBtn = document.getElementById('add');
                // const addForm = document.getElementById('add-form');
                // const updateForm = document.getElementById('edit-form');
                // const confirmBox = document.getElementById('confirm');
                // if (option === 'registered_company'){
                //     addBtn.classList.add('active');
                //     document.getElementById('add-btn').classList.add('active');
                //     document.getElementById('close-btn').classList.remove('active');
                // }
                // else {
                //     confirmBox.classList.remove('active');
                //     addBtn.classList.remove('active');
                //     addForm.classList.remove('active');
                //     updateForm.classList.remove('active');
                // }
            }

        </script>
    </body>
</html>