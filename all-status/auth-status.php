<?php
include('../config/constants.php');


$authId = $_GET['id'];
$status = $_GET['action'];


$sql6 = "UPDATE tbl_authentication SET auth_status= $status WHERE id='$authId'";
$res6 = mysqli_query($conn, $sql6);
if ($res6 == true) {

?>
    <script>
        window.location.href = '<?php echo SITEURL ?>authentication.php';
    </script>

    <script>
        <?php
    }

        ?>