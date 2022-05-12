<?php 
    class Database {
        public static $SERVER_NAME = "localhost";
        public static $USER_NAME = "root";
        public static $PASSWORD = "";
        public static $NAME = "assignment";

        function connect(){
            $connection = new mysqli(Database::$SERVER_NAME,Database::$USER_NAME,Database::$PASSWORD,Database::$NAME);
            if ($connection->connect_error){
                echo "Cannot connect to database";
            }
            return $connection;
        }

        function getData($columns, $table){
            
            $connection = $this->connect();
            $query = "SELECT ".$this->formatQuery($columns,false)."from " . $table . ";";
          
            $result = $connection->query($query);
            $connection->close();
            return $result;
        }

        function updateData($columns,$condition, $table){
            $connection = $this->connect();
            $query = "UPDATE ".$table." SET ".$this->formatQuery($columns,false)." WHERE ".$condition.";"; 
           
            $result = $connection->query($query);
            $connection->close();
            return $result;
        }

        function formatQuery($columns,$isValue){
            $query = "";
            $no_of_cols = count($columns); 
            if ($isValue){
                for ($i = 0; $i < $no_of_cols;$i++){
                    $column = $columns[$i];
                    if ($i + 1 === $no_of_cols){
                        $query .= "'".$column . "' ";
                    }
                    else {
                        $query .= "'".$column . "', ";
                    }
                    
                }
            }
            else {
                for ($i = 0; $i < $no_of_cols;$i++){
                    $column = $columns[$i];
                    if ($i + 1 === $no_of_cols){
                        $query .= $column . " ";
                    }
                    else {
                        $query .= $column . ", ";
                    }
                    
                }
            }
            return $query;
        }
        
        function deleteData($col,$val,$table){
            $connection = $this->connect();
            $query = "DELETE FROM ".$table." WHERE ".$col." = ".$val.";";
            $result = $connection->query($query);
            $connection->close();
            return $result;
        }

        function addData($cols, $table){
            $connection = $this->connect();
            $colNames = array();
            $values = array();
            foreach($cols as $key => $val){
                array_push($colNames,$key);
                array_push($values,$val);
            }
            
            $query = "INSERT INTO ".$table."(".$this->formatQuery($colNames,false).") values (".$this->formatQuery($values,true).");";
          
            $result = $connection->query($query);
            $connection->close();
            return $result;
        }

        function getColName($table){
            $query = "SELECT COLUMN_NAME 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_NAME='$table'";
            $connection = $this->connect();
            
            $result = $connection->query($query);
            
            
            $connection->close();
            return $result;
        }

        function validate($col, $table){
            $connection = $this->connect();
            $query = "";
            if ($table === 'customer'){
                $query = "SELECT CustomerID from customer where email = '".$col."';" ;
            }
            else if($table === 'driver') {
                $query = "SELECT License from driver where email = '".$col."';";
            }
            else {
                $query = "SELECT * from registered_company where name = '".$col."';";
            }
            
            $result = $connection->query($query);
            
            $connection->close();
            return $result;
        }
        
        function getConditionalData($cols, $conditionalCol,$val,$table){
            $connection = $this->connect();
            $query = "SELECT ".$this->formatQuery($cols,false)." FROM ".$table." WHERE ".$conditionalCol." = ".$val.";";
            $result = $connection->query($query);
            $connection->close();
            return $result;
        }

        function displayData($columns, $result){
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    foreach ($row as $name => $val){
                        echo $name . ": " . $val;
                    }
                    // for ($i = 0; $i < $no_of_cols;$i++){
                    //     $column = $columns[$i];
                    //     echo $column . ": " . $row[$column]; 
                    // }
                    echo "<br>";
                }
                
            } else {
                echo "No result found";
            }
        }
    }

?>