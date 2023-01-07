<?php
include('../config/constants.php');


$tagId = $_GET['id'];
$status = $_GET['action'];


$sql6 = "UPDATE tbl_tagging SET tag_status= $status WHERE id='$tagId'";
$res6 = mysqli_query($conn, $sql6);
if ($res6 == true) {

?>
    <script>
        window.location.href = '<?php echo SITEURL ?>boothtag.php';
    </script>

    <script>
        <?php
    }

        ?>