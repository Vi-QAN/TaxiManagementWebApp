<?php
    session_start();
    if (isset($_SESSION['name']) && isset($_SESSION['password']) ){
        $name = $_SESSION['name'];
        $password = $_SESSION['password'];
    }
    else {
        header("Location: login.php" );
    }
    $displayConfirmed = "false";
    if (isset($_GET['confirmed'])){
        $displayConfirmed = 'true';
    }
    if ($name !== 'admin@gmail.com'){
        header("Location: dashboardUser.php");
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
                <button class="opt" id="driver" onclick="render(this.id)">Drivers</button>
                <button class="opt" id="customer" onclick="render(this.id)">Users</button>
                <button class="opt" id="registered_company" onclick="render(this.id)">Registered Organizations</button>
            </div>
            <div class="container">
                <div class="status">
                    <?php 
                        if (isset($_GET['added'])){
                            $val = $_GET['added'];
                            if ($val === 'false'){
                                echo '<p class="error"> Company is already added </p>';
                            }
                            else {
                                echo '<p> Company is added successfully </p>';
                            }
                        }
                    ?>
                </div>
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
                <div class="add" id="add">
                    <button class="fa fa-plus active" aria-hidden="true" id="add-btn" onclick="displayForm(this.id)"></button>
                    <button class="fa fa-times" aria-hidden="true" id="close-btn" onclick="displayForm(this.id)"></button>
                </div>
                <div class="pop-up" id="add-form">
                    <h3>Add a new record </h3>
                    
                    <form method="POST"  action="addData.php?t=registered_company">
                        <label for="Name">Company: </label>
                        <input type="text" id ="name" name="name" placeholder="Enter company name" required>

                        <label for="Address">Address: </label>
                        <input type="text" id ="address" name="address" placeholder="Enter address" required>

                        <input type="submit" value="Submit" id="submit-btn">
                    </form>
                    
                </div>
                <div class="pop-up active" id="edit-form">
                    <?php 
                        if (isset($_GET['edited'])){
                            if ($_GET['edited'] === 'false'){
                                $col = $_GET['col'];
                                $val = $_GET['val'];
                                $table = $_GET['table'];
                                echo '
                                    <h3>Edit record for '.$val.'</h3>
                                    <form method="POST"  action="updateData.php?edited=true&t='.$table.'&col='.$col.'&val='.$val.'">
                                        <label for="Name">Company: </label>
                                        <input type="text" id ="name" name="name" value="'.$val.'" required>
    
                                        <label for="Address">Address: </label>
                                        <input type="text" id ="address" name="address" placeholder="Enter new address" required>
    
                                        <input type="submit" value="Submit" id="submit-btn">
                                    </form>
                                ';
                            
            
                                
                            }
                        }
                        
                
                    ?>
                </div>
            </div>
        </div>
        <script>
            document.getElementById("registered_company").click();
            // confirmation box controller
            let displayConfirm = '<?=$displayConfirmed?>';
            const confirmBox = document.getElementById('confirm');
            if (displayConfirm === 'true'){
                confirmBox.classList.add('active');                  
            }
            else {
                confirmBox.classList.remove('active');
            }

            // reload the page after information is added
            if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
                window.location.replace('./dashboard.php');
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
                
                const addBtn = document.getElementById('add');
                const addForm = document.getElementById('add-form');
                const updateForm = document.getElementById('edit-form');
                const confirmBox = document.getElementById('confirm');
                if (option === 'registered_company'){
                    addBtn.classList.add('active');
                    document.getElementById('add-btn').classList.add('active');
                    document.getElementById('close-btn').classList.remove('active');
                }
                else {
                    confirmBox.classList.remove('active');
                    addBtn.classList.remove('active');
                    addForm.classList.remove('active');
                    updateForm.classList.remove('active');
                }
            }

            // open and close add form
            function displayForm(id) {
                const open = document.getElementById("add-btn");
                const close = document.getElementById('close-btn');
                const form = document.getElementById('add-form');
                
                if (id === 'add-btn'){
                    open.classList.remove('active');
                    close.classList.add('active');
                    form.classList.add('active');
                }
                else {
                    open.classList.add('active');
                    close.classList.remove('active');
                    form.classList.remove('active');
                }
            }
        </script>
    </body>
</html>