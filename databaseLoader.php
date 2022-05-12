<?php 
    require_once("database.php");
    session_start();
    if (isset($_SESSION['name']) && isset($_SESSION['password']) ){
        $name = $_SESSION['name'];
        $password = $_SESSION['password'];
        $user = $_SESSION['type'];
    }
    else {
        header("Location: login.php" );
    }
    $table = $_GET['t'];
    
    $db = new Database();

    if ($user === 'admin'){
        $columns = array("*");
        $colNames = $db->getColName($table); 
        $result = $db->getData($columns,$table);
    }
    else {
        $columns = array("*");
        $colNames = $db->getColName($table);
        
        if ($table === 'journey'){
            $row = $db->getConditionalData($columns,'email','"'.$name.'"',$_SESSION['table']);
            $row = $row->fetch_assoc();
            if ($_SESSION['table'] ==='customer'){ 
                $id = $row['CustomerID'];
                $result = $db->getConditionalData($columns,'customerid','"'.$id.'"',$table);
            }
            else {
                $id = $row['License'];
                $result = $db->getConditionalData($columns,'licenseno','"'.$id.'"',$table);
            }
        }
        else {
            $result = $db->getConditionalData($columns,'email','"'.$name.'"',$table);
        }
        
    }
    render($result,$colNames,$table);
    

    function render($result,$colNames,$table){
        if ($result->num_rows > 0) {
            echo "<table ";
            echo "<tr>";
            $arr = array();
            // display column headers
            while($names = $colNames->fetch_assoc()) {
                foreach ($names as $name){
                    echo "<th class='field'>".$name."</th>" ;
                    array_push($arr,$name);
                }
            }
            echo "</tr>";

            // display columns data
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                $key = "";
                foreach ($row as $name => $val){
                    if ($key === ""){
                        $key = $val;
                    }
                    echo "<td class='field'>".$val."</td>" ;
                    
                }
                if ($table === 'registered_company' && $_SESSION['type'] === 'admin'){
                    echo '<td><a href="updateData.php?edited=false&col='.htmlentities($arr[0])."&val=".htmlentities($key)."&table=".htmlentities($table) .'" class="btn" id="edit" onclick="displayForm()"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                    echo "<td><a href='deleteData.php?confirmed=false&col=".htmlentities($arr[0])."&val=".htmlentities($key)."&table=".htmlentities($table). "' class='btn' id='delete' onclick='displayConfirm()'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>";
                }
                if (($table === 'customer' || $table === 'driver') && $_SESSION['type'] === 'normal'){
                    echo '<td><a href="updateData.php?edited=false&col='.htmlentities($arr[0])."&val=".htmlentities($key)."&table=".htmlentities($table) .'" class="btn" id="edit" onclick="displayForm()"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                    echo "<td><a href='deleteData.php?confirmed=false&col=".htmlentities($arr[0])."&val=".htmlentities($key)."&table=".htmlentities($table). "' class='btn' id='delete' onclick='displayConfirm()'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>";
                }
                echo "</tr>";
            }
        }
    }

?>

