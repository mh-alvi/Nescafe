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
    <title>Create</title>
    <!-- MATERIAL CDN -->
    <!-- STYLESHEET Saidur -->
    <link rel="stylesheet" href="topmenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./authentication.css">
</head>

<body>
    <!---------------------------------- START OF Topmenu Bar ------------------------------------->
    <div class="menu-bar">
        <ul>
            <div class="logo">
                <img src="./images/Logo.png" alt="">
            </div>
            <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>

            <li><a href=""><i class="fa fa-user-circle"></i>User</a>
                <!--user sub menu-->
                <div class="submenu-user">
                    <ul>
                        <li><a href="createemployee.php">Add Employee</a></li>
                        <li><a href="employee.php">Employee List</a></li>
                        <li><a href="authentication.php">Authentication</a></li>
                    </ul>
                </div>
            </li>

            <li><a href=""><i class="fa fa-tools"></i>Materials</a>
                <!--Materials sub menu-->
                <div class="submenu-user">
                    <ul>
                        <li class="open-prosubmenu"><a href="">Product</a><i class="fa fa-angle-right"></i>
                            <div class="pro-submenu">
                                <ul>
                                    <li><a href="createproduct.php">Add Product</a></li>
                                    <li><a href="product.php">Product List</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="open-prosubmenu"><a href="addproductstock.php">Stock</a>
                            <!-- <div class="pro-submenu">
                <ul>
                  <li><a href="addproductstock.php">Add Product Stock</a></li>
                  <li><a href="">Add Cup Stock</a></li>
                  <li><a href="">Product Stock List</a></li>
                  <li><a href="">Cup Stock List</a></li>
                </ul>
              </div> -->
                        </li>

                        <li class="open-prosubmenu"><a href="">Booth</a><i class="fa fa-angle-right"></i>
                            <div class="pro-submenu">
                                <ul>
                                    <li><a href="createbooth.php">Add Booth</a></li>
                                    <li><a href="booth.php">Booth List</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

            </li>

            <li><a href=""><i class="fa fa-toggle-on"></i>Tagging</a>
                <!--Tagging sub menu-->
                <div class="submenu-user">
                    <ul>
                        <li class="open-prosubmenu"><a href="">Booth Tag</a><i class="fa fa-angle-right"></i>
                            <div class="pro-submenu">
                                <ul>
                                    <li><a href="boothtag.php">Employee Tag</a></li>
                                    <li><a href="product_tag.php">Product Tag</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="open-prosubmenu"><a href="">Stock Tag</a><i class="fa fa-angle-right"></i>
                            <div class="pro-submenu">
                                <ul>
                                    <li><a href="productandcup.php">Product &amp; Cup</a></li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            <li><a href="report.php"><i class="fa fa-file"></i>Reports</a>
                <div class="submenu-user">
                    <ul>
                        <li><a href="salesreport.php">Sales</a></li>
                        <li><a href="stockreport.php">Stock</a></li>
                        <li><a href="attendence.php">Attendance</a></li>
                        <li><a href="">Profit &amp; Loss</a></li>
                    </ul>
                </div>
            </li>
            <li><a href=""><i class="fa fa-key"></i>Account</a>
                <div class="submenu-user">
                    <ul>
                        <li><a href="">Admin</a></li>
                        <li><a href="logout.php">Logout</a></li>

                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!---------------------------------- START OF Topmenu Bar ------------------------------------->

    <div class="container">

        <div class="containerR">

            <div class="title">Product Tagging</div>
            <div class="header">
                <h3>Select Booth:</h3>
            </div>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; // display session message
                unset($_SESSION['add']); // removing session message
            }
            ?>


            <div class="drop">
                <form method="POST">
                    <select name="booth_id">
                        <option value="" disabled="" selected>-- Select Booth --</option>
                        <?php
                        $sql = "SELECT * FROM tbl_booth WHERE bt_status=1";
                        $data =   $conn->query($sql);
                        foreach ($data as $row) {
                        ?>
                            <option value="<?= $row["id"] ?>"><?= $row["booth_name"] ?></option>
                        <?php } ?>
                    </select>
            </div>
            <div class="header">
                <h3>Select Product:</h3>
            </div>

            <select name="product_id[]" id="subject" multiple>
                <option value="" disabled="" selected="selected">-- Select Product --</option>
                <?php
                $sql2 = "SELECT * FROM tbl_product";
                $data2 =   $conn->query($sql2);
                foreach ($data2 as $row2) {
                ?>

                    <option value="<?= $row2["id"] ?>"><?= $row2["product_name"] ?></option>

                <?php } ?>
            </select>

            <div class="content">

                <div class="submit">

                    <button class="button" type="submit" name="submit">Add</button>
                </div>
                </form>
                <?php

                if (isset($_POST['submit'])) {
                    //1. Get the id of selected admin
                    $booth_id = $_POST['booth_id'];
                    $id = $_POST['product_id'];
                    foreach ($id as $ids) {
                        echo $ids;
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['submit'])) {
        //1. Get the id of selected admin
        $product_id = $_POST['product_id'];
        $stk_id = $_POST['stock_id'];
        $cup_qty = $_POST['cup_qty'];
        $ingredient_qty = $_POST['ingredient_qty'];

        foreach ($stk_id as $stock_id) {
            echo $stock_id;
            exit();
        }
    }
    ?>




    <!-- ------------------------------------------multiple---------------------------------------- -->

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('subject')
    </script>




</body>

</html>