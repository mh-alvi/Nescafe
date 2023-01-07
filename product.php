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
    <!-- STYLESHEET Saidur -->
    <link rel="stylesheet" href="topmenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- -------------------------------STYLESHEET ------------------------------------->
    <link rel="stylesheet" href="./employee.css">
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
                        <li><a href="boothtag.php">Booth Tag</a></li>
                        <li class="open-prosubmenu"><a href="">Stock Tag</a><i class="fa fa-angle-right"></i>
                            <div class="pro-submenu">
                                <ul>
                                    <li><a href="">Product &amp; Cup</a></li>
                                    <li><a href="">Cup &amp; Qty</a></li>
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
                <h1>Products</h1>
                <h3>Choose Booth:</h3>
                <?php
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add']; // display session message
                    unset($_SESSION['add']); // removing session message
                }
                ?>
                <div class="drop">

                    <form method="POST">
                        <select name="booth_id" id="subject">
                            <?php
                            $sql = "SELECT * FROM tbl_booth WHERE bt_status=1";
                            $data =   $conn->query($sql);
                            $booth_id = $row["id"];
                            foreach ($data as $row) {
                            ?>
                                <option value="<?php $booth_id ?>"><?= $row["booth_name"] ?></option>

                            <?php } 
                            
                            ?>
                            <option value="" selected="selected">-- Select Booth --</option>
                        </select>
                </div>
                <div class="btn"><a href="./createproduct.php"><span class="material-icons-sharp">person_add</span>
                        <h3>Add Products</h3>
                    </a></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Booth</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM tbl_product ";
                        $data =   $conn->query($sql);
                        $sl = 1;
                        foreach ($data as $row) {
                            $booth_id = $row["booth_id"];
                            $booth = '';
                            if ($booth_id == null) {
                                $booth = 'Unassigned';
                            } else {
                                $sql2 = "SELECT booth_name FROM tbl_booth WHERE id = $booth_id";
                                $res = mysqli_query($conn, $sql2);
                                $rows = mysqli_fetch_assoc($res);
                                $booth_name = $rows['booth_name'];
                                $booth = $booth_name;
                            }
                        ?>
                            <tr>
                                <td><?= $sl++ ?></td>
                                <td> <?= $row["product_name"] ?></td>
                                <td><?= $row["product_price"] ?></td>
                                <td><?php echo $booth ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
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