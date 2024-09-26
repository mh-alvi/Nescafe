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
    <title>Attendance</title>
    <!---------------------------------- CDN HERE ------------------------------------------->
    <!-- STYLESHEET Saidur -->
    <link rel="stylesheet" href="topmenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- -------------------------------STYLESHEET ------------------------------------->
    <link rel="stylesheet" href="./attendence.css">

</head>

<body>

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

            <!-- -------------------------------START OF EMPLOYEE------------------------------ -->
            <section class="attendance">

                <div class="attendance-list">
                    <h1>Attendance</h1>
                    <form method="GET">
                        <div class="date">
                            <input type="date" name="date">
                        </div>
                        <div class="button">
                            <input type="submit" name="submit" value="Search">

                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Job-ID</th>
                                <th>Date</th>
                                <th>Booth</th>
                                <th>Punch-In</th>
                                <th>Punch-Out</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            //check whether the submit button is clicked or not
                            if (isset($_GET['submit'])) {
                                //1. Get the id of selected admin
                                $date = date("d-m-Y", strtotime($_GET['date']));

                                //2. Create sql query to get the details
                                $sql = "SELECT * FROM tbl_attendance AS ta RIGHT JOIN tbl_employee AS te ON ta.employee_id = te.id RIGHT JOIN tbl_booth AS tb ON ta.booth_id = tb.id WHERE ta.ad_date='$date'";

                                //Execute the query
                                $res = mysqli_query($conn, $sql);
                                $sl = 1;

                                //check whether the query is executed or not
                                if ($res == true) {
                                    //check the data is available or not
                                    $count = mysqli_num_rows($res);
                                    // $rows = mysqli_fetch_assoc($res2);
                                    if ($count > 0) { //print message already exist
                                        //get the details
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $emp_name = $rows['employee_name'];
                                            $emp_job_id = $rows['job_id'];
                                            $ad_date = $rows['ad_date'];
                                            $booth_name = $rows['booth_name'];
                                            $punch_in = $rows['punch_in'];
                                            $punch_out = $rows['punch_out'];
                            ?>
                                            <tr>
                                                <td><?php echo $sl++; ?></td>
                                                <td><?php echo $emp_name; ?></td>
                                                <td><?php echo $emp_job_id; ?></td>
                                                <td><?php echo $ad_date; ?></td>
                                                <td><?php echo $booth_name; ?></td>
                                                <td><?php echo $punch_in; ?></td>
                                                <td><?php echo $punch_out; ?></td>
                                                <td><button>View</button></td>
                                            </tr>

                            <?php
                                        }
                                    } else {
                                        echo
                                        '<tr>
                                            <td colspan="8"><center>Record Not Found</center></td>
                                        </tr>';
                                    }
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            </section>
        </div>
        <!-- ------------------------------------END OF EMPLOYEE ------------------------------------------------->
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