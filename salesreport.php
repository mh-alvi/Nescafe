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
    <title>Employee</title>

    <!---------------------------------- CDN HERE ------------------------------------------->
    <script src="https://kit.fontawesome.com/e0836293cf.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- STYLESHEET Saidur -->
    <link rel="stylesheet" href="topmenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- -------------------------------STYLESHEET ------------------------------------->
    <link rel="stylesheet" href="./salesreport.css">
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
            <li><a href=""><i class="fa fa-file"></i>Reports</a>
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
    <div class="container2">
        <!---------------------------------- START OF Topmenu Bar ------------------------------------->



        <!---------------------------------- START OF SIDEBAR ------------------------------------->


        <!-- -------------------------------START OF EMPLOYEE------------------------------ -->
        <section class="attendance">
            <div class="attendance-list">
                <h1>Daily Sales Report</h1>
                <h3>Choose Booth:</h3>

                <form id="form1" method="GET" target="_blank">
                    <div class="drop">

                        <select name="booth_id" id="sale">
                            <option value="" disabled="" selected="">-- Select Booth --</option>
                            <?php
                            $sql = "SELECT * FROM tbl_booth";
                            $data =   $conn->query($sql);
                            $booth_id = $row['booth_id'];

                            foreach ($data as $row) {
                            ?>

                                <option value="<?= $row['id'] ?>"><?= $row["booth_name"] ?></option>

                            <?php

                            }
                            ?>
                        </select>
                    </div>
                    <h3>Date:</h3>
                    <div class="date">
                        <!-- <input type="date" name=""> -->
                        <input type="date" name="date">
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="Search">

                    </div>
                    <?php
                    if (isset($_SESSION['add'])) {
                        echo $_SESSION['add']; // display session message
                        unset($_SESSION['add']); // removing session message
                    }
                    ?>

                    <div class="export">

                        <button class="btn00"><i class="fa-sharp fa-solid fa-file-excel"></i> Excel File</button>

                        <button type="submit" name="pdf_generator" onclick="submitForm('generatePdf.php')" class="btn00"><i class="fa-sharp fa-solid fa-file-pdf"></i> Pdf File</button>
                    </div>
                </form>
                <div class="table-wrapper">

                    <table class="table" id="recordListing">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Product Name</th>
                                <th>Opening</th>
                                <th>Closing</th>
                                <th>Wastage</th>
                                <th>Sales</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php

                            if (isset($_GET['submit'])) {
                                $booth_id = $_GET['booth_id'];
                                $date = date("d-m-Y", strtotime($_GET['date']));

                                //2. Create sql query to get the details
                                $sql2 = "SELECT * FROM tbl_sales AS ts RIGHT JOIN tbl_sales_cal AS tsc ON ts.sales_cal_id = tsc.id WHERE tsc.booth_id='$booth_id' AND sales_date='$date'";

                                //Execute the query
                                $res2 = mysqli_query($conn, $sql2);

                                $sl = 1;
                                //check whether the query is executed or not
                                if ($res2 == true) {
                                    //check the data is available or not
                                    $count = mysqli_num_rows($res2);
                                    // $rows = mysqli_fetch_assoc($res2);
                                    if ($count > 0) { //print message already exist
                                        //get the details
                                        while ($rows = mysqli_fetch_assoc($res2)) {
                                            $booth_id = $rows['booth_id'];
                                            $product_id = $rows['product_id'];
                                            $product_name = $rows['product_name'];
                                            $opening = $rows['opening'];
                                            $closing = $rows['closing'];
                                            $wastage = $rows['wastage'];
                                            $sales = $rows['sales'];
                                            $total = $rows['total'];
                            ?>
                                            <tr>
                                                <td><?php echo $sl++; ?></td>
                                                <td><?php echo $product_name; ?></td>
                                                <td><?php echo $opening; ?></td>
                                                <td><?php echo $closing; ?></td>
                                                <td><?php echo $wastage; ?></td>
                                                <td><?php echo $sales; ?></td>
                                                <td><?php echo $total; ?></td>
                                            </tr>

                            <?php
                                        }
                                    } else {
                                        echo
                                        '<tr>
                                            <td colspan="7"><center>Record Not Found</center></td>
                                        </tr>';
                                    }
                                }

                                //sql query
                                $sql4 = "SELECT SUM(total) AS Total FROM tbl_sales AS ts RIGHT JOIN tbl_sales_cal AS tsc ON ts.sales_cal_id = tsc.id WHERE tsc.booth_id='$booth_id' AND sales_date='$date'";

                                //execute query
                                $res4 = mysqli_query($conn, $sql4);
                                $row = mysqli_fetch_assoc($res4);

                                $total_sales = $row['Total'];
                            } else {
                                $total_sales = 0.00;
                            }

                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total = </b> </td>
                                <td><?php echo $total_sales; ?></td>
                            </tr>
                        </tbody>

                    </table>
                    <table class="table" id="recordListing">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Due</th>
                                <th>Other</th>
                                <th>Expense</th>
                                <th>Expense Item</th>
                                <th>Total Expense</th>
                                <th>Collection</th>
                                <th>Total Cash</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['submit'])) {
                                $booth_id = $_GET['booth_id'];
                                $date = date("d-m-Y", strtotime($_GET['date']));

                                //2. Create sql query to get the details
                                $sql3 = "SELECT * FROM tbl_sales_cal WHERE booth_id='$booth_id' AND sales_date_cal='$date'";

                                //Execute the query
                                $res3 = mysqli_query($conn, $sql3);

                                $sl1 = 1;
                                //check whether the query is executed or not
                                if ($res3 == true) {
                                    //check the data is available or not
                                    $count1 = mysqli_num_rows($res3);
                                    // $rows = mysqli_fetch_assoc($res2);
                                    if ($count1 > 0) { //print message already exist
                                        //get the details
                                        while ($rows1 = mysqli_fetch_assoc($res3)) {
                                            $due = $rows1['due'];
                                            $other = $rows1['other'];
                                            $expense = $rows1['expense'];
                                            $expense_item = $rows1['expense_item'];
                                            $total_expense = $rows1['total_expense'];
                                            $collection = $rows1['collection'];
                                            $total_cash = $rows1['total_cash'];
                            ?>
                                            <tr>
                                                <td><?php echo $sl1++; ?></td>
                                                <td><?php echo $due; ?></td>
                                                <td><?php echo $other; ?></td>
                                                <td><?php echo $expense; ?></td>
                                                <td><?php echo $expense_item; ?></td>
                                                <td><?php echo $total_expense; ?></td>
                                                <td><?php echo $collection; ?></td>
                                                <td><?php echo $total_cash; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo
                                        '<tr>
                                            <td colspan="8"><center>Record Not Found</center></td>
                                        </tr>';
                                        $_SESSION['add'] = "<div class='error'>Searching Failed!!</div>";
                                    ?>
                                    <script>
                                        window.location.href = '<?php echo SITEURL ?>salesreport.php';
                                    </script>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
        </section>
    </div>
    <!-- ------------------------------------END OF EMPLOYEE ------------------------------------------------->

    <script type="text/javascript">
        function submitForm(action) {
            var form = document.getElementById('form1');
            form.action = action;
            form.submit();
        }
    </script>

</body>

</html>