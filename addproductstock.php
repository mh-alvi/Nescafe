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
  <!-- STYLESHEET -->
  <link rel="stylesheet" href="./addproductstock.css">
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

            <li class="open-prosubmenu"><a href="addproductstock.php">Stock</a></li>

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




    <!-- ------------------------------------END OF SIDEBAR ------------------------------------->
    <div class="containerR">

      <div class="title">Add Product Stock</div>
      <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add']; // display session message
        unset($_SESSION['add']); // removing session message
      }
      ?>

      <form method="POST">
        <div class="header">
          <h3>Product:</h3>
        </div>
        <div class="drop">
          <input type="text" name="product-name" id="text" placeholder="Enter your product name" required>
        </div>
        <div class="header">
          <h3>Quantity:</h3>
        </div>
        <div class="drop">
          <input type="number" name="product-quantity" id="quantity" placeholder="Enter product quantity" min="1" max="1000" required>
        </div>


        <div class="gender-details">
          <input type="radio" name="unit" value="Kilogram(KG)" id="dot-1">
          <input type="radio" name="unit" value="Gram(G)" id="dot-2">
          <input type="radio" name="unit" value="Others" id="dot-3">
          <span class="gender-title">Unit</span>
          <div class="category">
            <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Kilogram(KG)</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Gram(G)</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Pcs</span>
            </label>
          </div>
        </div>

        <div class="content">
          <div class="submit">
            <button class="button" type="submit" name="submit">Add</button>
          </div>
        </div>
      </form>
      <?php //check whether the submit button is clicked or not
      if (isset($_POST['submit'])) {
        //1. Get the value from category form
        $stock_name = $_POST['product-name'];
        $stock_quantity = $_POST['product-quantity'];

        if ($_POST['unit'] == 'Kilogram(KG)') {
          //Get the value from form
          $unit = $_POST['unit'];
        } elseif ($_POST['unit'] == 'Gram(G)') {
          $unit = $_POST['unit'];
        } else {
          $unit = $_POST['unit'];
        }

        //2. Create sql query to insert category into database
        $sql = "INSERT INTO tbl_product_stock SET
                stock_name = '$stock_name',
                stock_quantity = '$stock_quantity',
                stock_unit = '$unit'
                ";

        //execute the query and save it in database
        $res = mysqli_query($conn, $sql);

        //4. check whether the qeury execute or not and data added or not
        if ($res == true) {
          //query executed and category added
          $_SESSION['add'] = "<div class='success'>Stock Added Successfully!!</div>";
      ?>
          <script>
            window.location.href = '<?php echo SITEURL ?>addproductstock.php';
          </script>
        <?php  } else {
          //failed to add category
          $_SESSION['add'] = "<div class='error'>Failed to Add Stock!!</div>";
        ?>
          <script>
            window.location.href = '<?php echo SITEURL ?>addproductstock.php';
          </script>

      <?php
        }
      } else {
      }
      ?>

      <table class="table">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $sql = "SELECT * FROM tbl_product_stock ";
          $data =   $conn->query($sql);
          $sl = 1;
          foreach ($data as $row) {
            
          ?>
            <tr>
              <td><?= $sl++ ?></td>
              <td> <?= $row["stock_name"] ?></td>
              <td><?= $row["stock_quantity"] ?></td>
              <td><?= $row["stock_unit"] ?></td>
            </tr>
          <?php }
          ?>

        </tbody>
      </table>
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


</body>

</html>