<?php
include('../config/constants.php');


$userId = $_GET['id'];
$status = $_GET['action'];


$sql3 = "UPDATE tbl_employee SET em_status= $status WHERE id='$userId'";
$res3 = mysqli_query($conn, $sql3);
if ($res3 == true) {

?>
    <script>
        window.location.href = '<?php echo SITEURL ?>employee.php';
    </script>

    <script>
        <?php
    }

        ?>