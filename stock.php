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
    <!-- STYLESHEET Saidur -->
    <link rel="stylesheet" href="topmenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- -------------------------------STYLESHEET ------------------------------------->
    <link rel="stylesheet" href="./stockreport.css">
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
    <!---------------------------------- START OF Topmenu Bar ------------------------------------->

    <div class="container2">

        <!-- -------------------------------START OF EMPLOYEE------------------------------ -->
        <section class="attendance">
            <div class="attendance-list">
                <h1>Stock</h1>

                <form id="form1" method="GET" target="_blank">

                    <h3>From:</h3>
                    <div class="date">
                        <!-- <input type="date" name=""> -->
                        <input type="date" name="date">
                    </div>
                    <h3>To:</h3>
                    <div class="date">
                        <!-- <input type="date" name=""> -->
                        <input type="date" name="date">
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" value="Search">

                    </div>

                    <div class="export">

                        <button class="btn00"><i class="fa-sharp fa-solid fa-file-excel"></i> Excel File</button>

                        <button type="submit" name="pdf_generator" onclick="submitForm('generatePdf.php')" class="btn00"><i class="fa-sharp fa-solid fa-file-pdf"></i> Pdf File</button>
                    </div>
                </form>

                <div class="table-wrapper">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Opening Stock</th>
                                <th>Recieved</th>
                                <th>Total Stock</th>
                                <th>Total Wastage</th>
                                <th>Total Damage</th>
                                <th>Total Used</th>
                                <th>Extra Sale</th>
                                <th>Closing Stock</th>
                                <th>Amount</th>
                                <th>Products Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // if (isset($_GET['submit'])) {
                            //         $booth_id = $_GET['booth_id'];
                            //         $date = date("d-m-Y", strtotime($_GET['date']));

                            //2. Create sql query to get the details
                            $sql3 = "SELECT * FROM tbl_product_stock";
                            $res3 = mysqli_query($conn, $sql3);
                            $sl = 1;
                            if ($res3 == true) {
                                while ($data = mysqli_fetch_assoc($res3)) {
                                    $product_stock_id = $data['id'];
                                    $stock_rec = $data['stock_quantity'];
                                    $opening_stock = $data['opening_stock'];
                                    $stock_damage = $data['stock_damage'];
                            ?>
                                    <tr>
                                        <td><?php echo $sl++; ?></td>
                                        <td>
                                            <?php
                                            $sql4 = "SELECT * FROM tbl_product_stock WHERE id='$product_stock_id'";
                                            $res4 = mysqli_query($conn, $sql4);
                                            if ($res4 == true) {
                                                $count = mysqli_num_rows($res4);
                                                if ($count > 0) {
                                                    while ($rows2 = mysqli_fetch_assoc($res4)) {
                                                        $stock_name = $rows2['stock_name'];
                                                    }
                                                }
                                            }
                                            echo $stock_name;
                                            ?>
                                        </td>
                                        <td>-</td>
                                        <td><?php echo $stock_rec; ?></td>
                                        <td><?php echo $opening_stock; ?></td>
                                        <td><?php echo $opening_stock + $stock_rec; ?></td>
                                        <td>-</td>
                                        <td><?php echo $stock_damage; ?></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo
                                '<tr>
                                        <td colspan="13"><center>Record Not Found</center></td>
                                        </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Auto width -->

        </section>
        </section>
    </div>
    <!-- ------------------------------------END OF EMPLOYEE ------------------------------------------------->
    <script>
        /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    <script>
        //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("popo");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

</body>

</html>