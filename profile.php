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
    <title>Profile</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e0836293cf.js" crossorigin="anonymous"></script>
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./profile.css">
    <link rel="stylesheet" href="./index.css">
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



    <!-- ------------------------------------END OF Topmenu Bar ------------------------------------->
    <?php $id = $_GET["id"];
    $sql = "SELECT * FROM tbl_employee_details where id = $id";

    //esecute the query
    $res = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($res);
    //count rows
    $count = mysqli_num_rows($res); ?>
    <div class='memberDetail'>
        <div class="member-content">
            <div class="member-image">

                <img src="images/employee-image/<?php echo $result["image_name"] ?>" alt="" />
                <div class="icon">
                    <span><a href="/#"><i class="fa-brands fa-facebook fa-2xl"></i></a></span>
                    <span><a href="/#"><i class="fa-brands fa-twitter fa-2xl"></i></a></span>
                    <span><a href="/#"><i class="fa-brands fa-instagram fa-2xl"></i></a></span>
                    <span><a href="/#"><i class="fa-brands fa-telegram fa-2xl"></i></a></span>
                </div>


            </div>
            <div class="member-card">

                <div class="member-text">
                    <h1>EMPLOYEE INFO</h1>
                    <div class="member-info">
                        <?php
                        //create sql query to get all the data from database


                        //check whether we have data in our database or not
                        if ($count > 0) {

                        ?>
                            <div class="info-text">
                                <span>Name:</span>
                                <span><?php echo $result["em_name"] ?></span>
                            </div>
                            <div class="info-text">
                                <span>Designation:</span>
                                <span><?php echo $result["em_designation"] ?></span>
                            </div>
                            <div class="info-text">
                                <span>Job-ID:</span>
                                <span><?php echo $result["em_job_id"] ?></span>
                            </div>
                            <div class="info-text">
                                <span>Phone no:</span>
                                <span><?php echo $result["em_phone"] ?></span>
                            </div>
                            <div class="info-text a">
                                <span>Email:</span>
                                <span><?php echo $result["em_email"] ?></span>
                            </div>
                            <div class="info-text a">
                                <span>Address:</span>
                                <span><?php echo $result["em_address"] ?></span>
                            </div>
                            <div class="info-text">
                                <span>NID:</span>
                                <span><?php echo $result["em_nid"] ?></span>
                            </div>
                            <div class="info-text">
                                <span>Education:</span>
                                <span><?php echo $result["em_education"] ?></span>
                            </div>
                            <div class="info-text">
                                <span>Joining Date:</span>
                                <span><?php echo $result["em_joining_date"] ?></span>
                            </div>
                            <div class="info-text">
                                <span>Gender:</span>
                                <span><?php echo $result["em_gender"] ?></span>
                            </div>
                        <?php

                        } else {
                            //we don't have any data
                            //we'll display the message inside the table
                        ?>
                            <div class="info-text">
                                <span>No Employee Added</span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>




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


    </div>

</body>

</html>