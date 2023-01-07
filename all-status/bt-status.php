<?php
include('../config/constants.php');


$btId = $_GET['id'];
$status = $_GET['action'];


$sql3 = "UPDATE tbl_booth SET bt_status= $status WHERE id='$btId'";
$res3 = mysqli_query($conn, $sql3);
if ($res3 == true) {

?>
    <script>
        window.location.href = '<?php echo SITEURL ?>booth.php';
    </script>

    <script>
        <?php
    }

        ?>