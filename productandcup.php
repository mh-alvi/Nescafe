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

  <link rel="stylesheet" href="./productandcup.css">

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
            <li><a href="login.php">Logout</a></li>

          </ul>
        </div>
      </li>
    </ul>
  </div>
  <!---------------------------------- START OF Topmenu Bar ------------------------------------->

  <div class="container">




    <!-- ------------------------------------END OF SIDEBAR ------------------------------------->
    <div class="containerR">
      <div class="title">Ingredient Tagging</div>
      <div class="content">
        <form method="POST">

          <div class="header">
            <h3>Select Ingredient:</h3>
            <div class="drop">
              <select name="stock_id">
                <option value="" disabled="" selected="selected">-- Select Ingredient --</option>
                <?php
                $sql2 = "SELECT * FROM tbl_product_stock";
                $data2 =   $conn->query($sql2);
                foreach ($data2 as $row2) {
                ?>

                  <option value="<?= $row2["id"] ?>"><?= $row2["stock_name"] ?></option>

                <?php } ?>
              </select>
            </div>


          </div>
          <div class="header">
            <h3>Select Product:</h3>
            <select name="product_id[]" id="subject" multiple>
              <option value="" disabled="" selected>-- Select Product --</option>
              <?php
              $sql = "SELECT * FROM tbl_product";
              $data =   $conn->query($sql);
              foreach ($data as $row) {
              ?>
                <option value="<?= $row["id"] ?>"><?= $row["product_name"] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="user-details">

            <div class="input-box">
              <span class="details">Ingredient Quantity</span>
              <input type="number" step="0.00" name="ingredient_qty" placeholder="Enter product quantity" required>
            </div>
            <?php
            if (isset($_SESSION['add'])) {
              echo $_SESSION['add']; // display session message
              unset($_SESSION['add']); // removing session message
            }
            ?>

            <div class="button">
              <input type="submit" name="submit" value="Create">
            </div>
        </form>

        <?php

        //  $sql4 = "SELECT bt.booth_name,em.employee_name FROM tbl_booth bt, tbl_employee em WHERE em.id=bt.employee_id";
        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
          //1. Get the id of selected admin
          $product_id = $_POST['product_id'];
          $stock_id = $_POST['stock_id'];
          $ingredient_qty = $_POST['ingredient_qty'];

          foreach ($product_id as $ids) {
            echo $ids;

            $sql2 = "SELECT * FROM tbl_stock_tagging WHERE product_id='$ids' AND product_stock_id='$stock_id'";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
              //check the data is available or not
              $count = mysqli_num_rows($res2);
              $rows = mysqli_fetch_assoc($res2);
              if ($count > 0) { //print message already exist
                //get the details
                $_SESSION['add'] = "<div class='error'>Tagging Already Exist!!</div>";
        ?>
                <script>
                  window.location.href = '<?php echo SITEURL ?>cup.php';
                </script>
                <?php
              } else {
                $sql3 = "INSERT tbl_stock_tagging SET
                        product_id = '$ids',
                        product_stock_id = '$stock_id',
                        ingredient_quantity = '$ingredient_qty'
                        ";
                //executing the query
                $res3 = mysqli_query($conn, $sql3);




                //check the query executed successfully or not
                if ($res3 == true) {
                  //Query executed successfully
                  $_SESSION['add'] = "<div class='success'>Tagging Successfull!!</div>";
                ?>
                  <script>
                    window.location.href = '<?php echo SITEURL ?>productandcup.php';
                  </script>
                <?php

                } else {
                  //failed to execute the query
                  $_SESSION['add'] = "<div class='error'>Tagging Failed!!</div>";
                ?>
                  <script>
                    window.location.href = '<?php echo SITEURL ?>productandcup.php';
                  </script>
        <?php
                }
              }
            }
          }
        }

        ?>

        <table class="table">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Product Name</th>
              <th>Ingredient</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql5 = 'SELECT * FROM tbl_stock_tagging';
            $res5 = mysqli_query($conn, $sql5);
            if ($res5 == true) {
              $count = mysqli_num_rows($res5);
              $sl = 1;
              if ($count > 0) {
                while ($data = mysqli_fetch_assoc($res5)) {
                  $id = $data['id'];
                  $product_id = $data['product_id'];
                  $stock_id = $data['product_stock_id'];
                  $ingredient_quantity = $data['ingredient_quantity'];

                  $sql6 = "SELECT product_name FROM tbl_product WHERE id = $product_id";
                  $res6 = mysqli_query($conn, $sql6);
                  if ($res6 == true) {
                    $rows = mysqli_fetch_assoc($res6);
                    $product_name = $rows['product_name'];
                  }
                  $sql7 = "SELECT stock_name FROM tbl_product_stock WHERE id = $stock_id";
                  $res7 = mysqli_query($conn, $sql7);
                  if ($res7 == true) {
                    $rows = mysqli_fetch_assoc($res7);
                    $stock_name = $rows['stock_name'];
                  }
            ?>
                  <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $stock_name; ?></td>
                    <td><?php echo $ingredient_quantity; ?></td>

                  </tr>
            <?php
                }
              } else {
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- ------------------------------------------multiple---------------------------------------- -->

  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
  <script>
    new MultiSelectTag('subject')
  </script>

</body>

</html>