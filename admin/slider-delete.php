<?php
session_start();
/**
 * Connect to DB
 */
require_once("config/db_config.php");
if(strlen($_SESSION['email']) == 0){
  header("Location:index.php"); 
}
else{
    /**
     * Test Db Config
     */
    if($dbh){
        /**
         * Get id form url
         */
        if(isset($_GET['id'])){
           /**
            * Select Query
            */
            $sql = "DELETE FROM `slider` WHERE id = :id";
            
            $sql_delete = "SELECT * FROM `slider` WHERE id = :id";
           
            /**
             * prepare statement
             */
            $stmt = $dbh->prepare($sql);

            $stmt1 =$dbh->prepare($sql_delete);



            $stmt1->execute();
            /**
             * Fetch All row
             */
            while ($row = $stmt1->fetchAll(PDO::FETCH_ASSOC))
            {
              $img= $row["image"];

            }
             unlink(img);


            
           
            /**
             * Bind Param
             */
            $stmt->bindParam(':id', $_GET['id']);
            /**
             * Execute Query
             */
            if($stmt->execute()){
               
                header('Location:slider-show.php');
            }
            else{
                echo "<script>alert('Oops! something wrong, please try again');</script>";
            }
           
        }
    }
   
}
?>