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
    <title>NesCafe</title>
    <!-- MATERIAL CDN -->
    <!-- STYLESHEET Saidur -->
    <link rel="stylesheet" href="topmenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- STYLESHEET -->
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
    <div class="container">



        <!-------------------------------------- START OF MAIN SECTION------------------------------->

        <main>
            <div class="header">

                <h1>Dashboard</h1>
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login']; //display session message
                    unset($_SESSION['login']); //removing session message
                }
                ?>
            </div>
            <!-----------------------------------FOR CALENDER --------------------------------------->

            <div class="date">
                <input type="date" name="" id="">
            </div>
            <!-- --------------------------------FOR INSIGHTS --------------------------------------->

            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">trending_up</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Sales</h3>
                            <h1>25,000</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>

                <!-- ------------------------------END OF SLAES --------------------------------->
                <div class="expenses">
                    <span class="material-icons-sharp">insert_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <h1>14,000</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>62%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>

                <!------------------------------ END OF EXPENSES---------------------------------- -->
                <div class="profit">
                    <span class="material-icons-sharp">data_exploration</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Profit</h3>
                            <h1>10,000</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>44%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>

                <!-- ----------------------------END OF PROFIT --------------------------------------->

                <div class="loss">
                    <span class="material-icons-sharp">trending_down</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Loss</h3>
                            <h1>2,000</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>5%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>

                <!------------------------------END OF LOSS ------------------------------------------>



            </div>
        </main>
        <!-- <div class="right">
                    <div class="top">
                        <div class="profile">
                            <div class="info">
                                <p>Hi, <b>Faysal</b></p>
                                <small class="text-muted">Admin</small>
                            </div>
                            <div class="profile-photo">
                                <img src="./images/profile.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div> -->
        <!-- ------------------------------END OF PROFILE ----------------------------------------->
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