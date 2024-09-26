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




    <!-- ------------------------------------END OF SIDEBAR ------------------------------------->
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
            $sql3 = "INSERT tbl_product_tagging SET
    booth_id = '$booth_id',
    product_id = '$ids';
    ";
            $sql4 = "UPDATE tbl_product SET
    pro_booth_id = $booth_id WHERE id=$ids";

            //executing the query
            $res3 = mysqli_query($conn, $sql3);
            $res4 = mysqli_query($conn, $sql4);

            //check the query executed successfully or not
            if ($res3 == true) {
              if ($res4 == true) {


                //Query executed successfully
                $_SESSION['add'] = "<div class='success'>Tagging Successfull!!</div>";
        ?>
                <script>
                  window.location.href = '<?php echo SITEURL ?>product_tag.php';
                </script>
              <?php
              }
            } else {
              //failed to execute the query
              $_SESSION['add'] = "<div class='error'>Tagging Failed!!</div>";
              ?>
              <script>
                window.location.href = '<?php echo SITEURL ?>product_tag.php';
              </script>
        <?php
            }
          }
        }
        ?>


        <table class="table">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Booth</th>
              <th>Product</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql5 = 'SELECT * FROM tbl_product_tagging';
            $res5 = mysqli_query($conn, $sql5);
            if ($res5 == true) {
              $count = mysqli_num_rows($res5);
              $sl = 1;
              if ($count > 0) {
                while ($data = mysqli_fetch_assoc($res5)) {
                  $id = $data['id'];
                  $product_id = $data['product_id'];
                  $booth_id = $data['booth_id'];

                  $sql6 = "SELECT product_name FROM tbl_product WHERE id = $product_id";
                  $res6 = mysqli_query($conn, $sql6);
                  if ($res6 == true) {
                    $rows = mysqli_fetch_assoc($res6);
                    $product_name = $rows['product_name'];
                  }
                  $sql7 = "SELECT booth_name FROM tbl_booth WHERE id = $booth_id";
                  $res7 = mysqli_query($conn, $sql7);
                  if ($res7 == true) {
                    $rows = mysqli_fetch_assoc($res7);
                    $booth_name = $rows['booth_name'];
                  }
            ?>
                  <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $booth_name; ?></td>
                    <td><?php echo $product_name; ?></td>
                    <td>
                    <a href="<?php echo SITEURL; ?>delete_pro_tag.php?id=<?php echo $id; ?>"><button class="inactive-button">Remove</button></a>
                    </td>
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
  <!-- ------------------------------------------multiple---------------------------------------- -->

  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
  <script>
    new MultiSelectTag('subject')
  </script>

</body>

</html>