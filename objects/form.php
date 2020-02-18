<?php
class Form {
    // Pass database connection and define table name
    private $conn;
    private $table_name = "form"; // TABLE NAME HERE

    public function __construct($db){
        $this->conn = $db;
    }
    
    function retrieve() {
        // Define query
        $query = "SELECT * FROM " . $this->table_name;
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute statement
        $stmt->execute();
        // Return statement
        return $stmt;
    }

    function update(){
        // Define query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    text = :text
                WHERE id = '1'";
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(":text", $this->text);
        // Execute statement
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
}
?>