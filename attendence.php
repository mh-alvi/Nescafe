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
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet">
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
                              <!-- <div class="pro-submenu">
                                <ul>
                                    <li><a href="addproductstock.php">Add Product Stock</a></li>
                                    <li><a href="">Add Cup Stock</a></li>
                                    <li><a href="">Product Stock List</a></li>
                                    <li><a href="">Cup Stock List</a></li>
                                </ul>
                              </div>  -->
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
        <div class="container2">
            
                <!-- -------------------------------START OF EMPLOYEE------------------------------ -->
                <section class="attendance">
                    
                    <div class="attendance-list">
                        <h1>Attendance</h1>
                        <div class="date">
                            <input type="date" name="" id="">
                        </div>
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
                    <tr>
                        <td>01</td>
                        <td>Faysal Ibnea Hasan</td>
                        <td>201-15-0001</td>
                        <td>12-25-22</td>
                        <td>02</td>
                        <td>9:00 am</td>
                        <td>9:00 pm</td>
                        <td><button>View</button></td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>Majbaul Haque Alvi</td>
                        <td>201-15-0002</td>
                        <td>12-25-22</td>
                        <td>05</td>
                        <td>11:45 am</td>
                        <td>6:30 pm</td>
                        <td><button>View</button></td>
                    </tr>
                    <tr>
                        <td>03</td>
                        <td>Saidur Rahman</td>
                        <td>201-15-0003</td>
                        <td>12-25-22</td>
                        <td>02</td>
                        <td>1:00 pm</td>
                        <td>10:00 pm</td>
                        <td><button>View</button></td>
                    </tr>
                    <tr>
                        <td>04</td>
                        <td>MD.Istiaqe</td>
                        <td>201-15-0004</td>
                        <td>12-25-22</td>
                        <td>03</td>
                        <td>2:25 pm</td>
                        <td>10:35 pm</td>
                        <td><button>View</button></td>
                    </tr>
                <tr >
                    <td>05</td>
                    <td>Abu Tayeb</td>
                    <td>201-15-0005</td>
                    <td>12-25-22</td>
                    <td>04</td>
                    <td>9:25 am</td>
                    <td>2:20 pm</td>
                    <td><button>View</button></td>
                </tr>
                <tr >
                    <td>06</td>
                    <td>Fahim Shahriar Apurbo</td>
                    <td>201-15-0006</td>
                    <td>12-25-22</td>
                    <td>06</td>
                    <td>11:50 am</td>
                    <td>1:30 pm</td>
                    <td><button>View</button></td>
                </tr>
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