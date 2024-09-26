<?php
include('./config/constants.php');
include('./partials/login-check.php');
//1. get the id of an admin to delete the data
$id = $_GET['id'];

// 2. create the sql to delete the data
$sql = "DELETE FROM tbl_authentication WHERE id=$id";
//Execute the query
$res = mysqli_query($conn, $sql);

//check the query executed successfully or not
if ($res == true) {
    //Query executed successfully
    $_SESSION['add'] = "<div class='success'>Authentication Delete Successfully!!</div>";
?>
    <script>
        window.location.href = '<?php echo SITEURL ?>authentication.php';
    </script>
<?php
} else {
    //failed to execute the query
    $_SESSION['add'] = "<div class='error'>Failed to Delete Authentication!!</div>";
?>
    <script>
        window.location.href = '<?php echo SITEURL ?>authentication.php';
    </script>

<?php
}

?>