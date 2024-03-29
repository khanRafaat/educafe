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
           
             
         

            $sql = "DELETE FROM `teachers` WHERE id = :id";
            /**
             * prepare statement
             */
            $stmt = $dbh->prepare($sql);
            /**
             * Bind Param
             */
            $stmt->bindParam(':id', $_GET['id']);
            /**03.
             * Execute Query
             */
            if($stmt->execute()){
                 
              $_SESSION['teacher_ok'] = " teacher has been deleted succesfully";  // getting alert session 
               $_SESSION['teacher_code'] = "danger";          // getting alert session 
               $_SESSION['teacher_title'] = "Your requested";  
               header('Location:teacher-show.php');
            }
            else{
                echo "<script>alert('Oops! something wrong, please try again');</script>";
            }
        }
    }
}
?>