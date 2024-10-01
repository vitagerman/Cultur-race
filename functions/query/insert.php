<?php
function sql_insert($table, $attributs, $values){
    global $DB;

    // Connect to database
    if(!$DB){
        sql_connect();
    }

    try{
        $DB->beginTransaction();

        // Prepare query for PDO
        $query = "INSERT INTO $table ($attributs) VALUES ($values);";
        $request = $DB->prepare($query);
        $request->execute();

        // Get the last inserted ID
        $lastId = $DB->lastInsertId();

        $DB->commit();
        $request->closeCursor();

        // Return the last inserted ID 
        return $lastId;
    }
    catch(PDOException $e){
        $DB->rollBack();
        $request->closeCursor();
        die('Error: ' . $e->getMessage());
    }

    $error = $DB->errorInfo();
    if($error[0] != 0){
        echo "Error: " . $error[2];
    }
}