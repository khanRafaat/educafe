<?php
session_start();
/**
 * Connect to DB
 */

require_once("config/db_config.php");
if(strlen($_SESSION['email']) == 0){
  header("Location:index.php");
}else{
    /**
     * Query for Database
     */
    $sql = 'SELECT * FROM `slider`';
    /**
     * Prepare statement
     */
    $stmt = $dbh->prepare($sql);
    /**
     * Execute Query
     */
    $stmt->execute();
    /**
     * Fetch All row
     */
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deshboard | Show Slider</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php  include_once('include/header.php') ?>
    <!-- Sidebar -->
    <?php include_once('include/sidebar.php') ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Slider List</h1>
                <p>Educafe Slide image list</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"> <a href="deshboard.php"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item">Slider</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                  $i = 1;
                  foreach($row as $val){
                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $val['h_title']; ?></td>
                                        <td><img src="<?php echo $val['image']; ?>" alt="!" height="50"></td>
                                        <td><?php if($val['status'] == 0) {echo "Deactive";}else{echo "Active";} ?></td>
                                        <td>
                                            <a href="slider-edit.php?id=<?php echo $val['id']; ?>"
                                                class="btn btn-success">Edit</a>
                                            <a href="slider-view.php?id=<?php echo $val['id']; ?>"
                                                class="btn btn-info">View</a>
                                            <a href="slider-delete.php?id=<?php echo $val['id']; ?>"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                    $i++;
                     }
                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include_once('include/footer.php') ?>
    <!-- Data table plugin-->
    <script type="text/javascript" src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#sampleTable').DataTable();
    </script>
     
     
     <!--  alert -->

 <script type="text/javascript" src="assets/js/plugins/bootstrap-notify.min.js"></script>

<?php 
if (isset($_SESSION['slider_ok']) &&  $_SESSION['slider_ok'] != '')
{
  ?>

<script type="text/javascript">
$.notify({
    title: "<?php echo $_SESSION['slider_title']; ?>",
    message: "<?php echo $_SESSION['slider_ok']; ?>",
    icon: 'fa fa-check-circle'
}, {
    type: "<?php echo  $_SESSION['slider_code']; ?>"
});
</script>

<?php
  unset($_SESSION['slider_ok']);
  unset($_SESSION['slider_code']);
  usset($_SESSION['slider_title']);
}
?>


</body>

</html>
<?php
}
?>