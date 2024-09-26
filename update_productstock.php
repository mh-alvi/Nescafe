<?php

include('./config/constants.php');
include('./partials/login-check.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./authentication.css">

    <title>Update Stock</title>
</head>

<body>

    <div class="containerR">
        <div class="title">
            <h1>Update Stock</h1>
        </div>

        <?php
        //1. Get the id of selected admin
        $id = $_GET['id'];
        //2. Create sql query to get the details
        $sql = "SELECT * FROM tbl_product_stock WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        if ($res == true) {
            //check the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if ($count == 1) {
                //get the details
                // echo "Admin available";
                $rows = mysqli_fetch_assoc($res);
                $stock_name = $rows['stock_name'];
                $stock_qty = $rows['stock_quantity'];
            } else {
                //redirect to manage admin page
        ?>
                <script>
                    window.location.href = '<?php echo SITEURL ?>addproductstock.php';
                </script>
        <?php
            }
        }
        ?>

        <form action="" method="POST">
            <div class="content">


        <div class="user-details">
          <div class="input-box">
            <span class="details"> </span>
            <input type="text" name="stock_name" value="<?php echo $stock_name; ?>" placeholder="Enter Ingrediant Name" required>
          </div>

          <div class="input-box">
            <span class="details"> </span>
            <input type="number" minlength="0" value="<?php echo $stock_qty; ?>" maxlength="12" name="stock_quantity" placeholder="Enter Quantity" required>
          </div>
        </div>

        <div class="submit">

          <button type="submit" value="<?php echo $id; ?>" class="button" name="submit">Update</button>
        </div>
        <!-- <input type="submit" name="submit" value="Submit"> -->
        </form>
    </div>
    </div>

    <?php

    //check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
        // echo "button clicked";
        //Get all the from the form
        $stock_name = $_POST['stock_name'];
        $stock_quantity = $_POST['stock_quantity'];

        //Create a sql query to update admin
        $sql = "UPDATE tbl_product_stock SET
    stock_name = '$stock_name',
    stock_quantity = '$stock_quantity'
    WHERE id = $id";

        //executing the query
        $res = mysqli_query($conn, $sql);

        //check the query executed successfully or not
        if ($res == true) {
            //Query executed successfully
            $_SESSION['add'] = "<div class='success'>Stock Update Successfully!!</div>";
    ?>
            <script>
                window.location.href = '<?php echo SITEURL ?>addproductstock.php';
            </script> //redirect to manage-admin page
        <?php
        } else {
            //failed to execute the query
            $_SESSION['add'] = "<div class='error'>Failed to Update Stock!!</div>";
        ?>
            <script>
                window.location.href = '<?php echo SITEURL ?>addproductstock.php';
            </script>

    <?php
        }
    }

    ?>
</body>

</html>