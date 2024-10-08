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




    <!-- ------------------------------------END OF SIDEBAR ------------------------------------->
    <div class="containerR">

      <div class="title">Authentication</div>
      <div class="header">
        <h3>Select Employee:</h3>
      </div>
      <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add']; // display session message
        unset($_SESSION['add']); // removing session message
      }
      ?>

      <div class="drop">

        <form method="POST">
          <select name="employee_id" id="subject">
            <option value="" disabled="" selected="selected">-- Select Employee --</option>
            <?php
            $sql = "SELECT * FROM tbl_employee WHERE em_status=1";
            $data =   $conn->query($sql);
            $sl = 1;
            foreach ($data as $row) {
            ?>

              <option value="<?= $row['id'] ?>"><?= $row['employee_name']; ?></option>

            <?php } ?>
          </select>
      </div>

      <div class="content">


        <div class="user-details">
          <div class="input-box">
            <span class="details"> </span>
            <input type="text" name="em_username" placeholder="Enter user-id" required>
          </div>

          <div class="input-box">
            <span class="details"> </span>
            <input type="password" minlength="5" name="em_password" placeholder="Enter password" required>
          </div>
        </div>




        <div class="submit">

          <button type="submit" class="button" name="submit">Submit</button>
        </div>
        <!-- <input type="submit" name="submit" value="Submit"> -->
        </form>
        <?php


        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
          //1. Get the id of selected admin
          $em_username = $_POST['em_username'];
          $em_password = $_POST['em_password'];
          $id = $_POST['employee_id'];
          //2. Create sql query to get the details
          $sql4 = "SELECT * FROM tbl_authentication WHERE em_username='$em_username' OR employee_id='$id'";

          //Execute the query
          $res4 = mysqli_query($conn, $sql4);

          //check whether the query is executed or not
          if ($res4 == true) {
            //check the data is available or not
            $count = mysqli_num_rows($res4);
            $rows = mysqli_fetch_assoc($res4);
            if ($count > 0) { //print message already exist
              //get the details
              // echo "Admin available";
              $_SESSION['add'] = "<div class='error'>Use Another Username!!</div>";
        ?>
              <script>
                window.location.href = '<?php echo SITEURL ?>authentication.php';
              </script>
              <?php
            } else {
              //Get all the info from the form



              //Create a sql query to update admin
              $sql2 = "INSERT tbl_authentication SET
    em_username = '$em_username',
    em_password = '$em_password',
    employee_id = '$id';
    ";

              //executing the query
              $res2 = mysqli_query($conn, $sql2);

              //check the query executed successfully or not
              if ($res2 == true) {
                //Query executed successfully
                $_SESSION['add'] = "<div class='success'>Authentication Successfull!!</div>";
              ?>
                <script>
                  window.location.href = '<?php echo SITEURL ?>authentication.php';
                </script>
              <?php
              } else {
                //failed to execute the query
                $_SESSION['add'] = "<div class='error'>Authentication Failed!!</div>";
              ?>
                <script>
                  window.location.href = '<?php echo SITEURL ?>authentication.php';
                </script>
        <?php
              }
            }
          } else {
          }
        }

        ?>




        <table class="table">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Name</th>
              <th>User-ID</th>
              <th>Password</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Query to get all admin
            $sql3 = 'SELECT * FROM tbl_authentication';
            // Execute the query
            $res3 = mysqli_query($conn, $sql3);
            // check the query whether it is executed or not
            if ($res3 == true) {
              $count = mysqli_num_rows($res3); // function to get all the rows in database

              $sn = 1; //create a variable for maintain the serial of id

              if ($count > 0) {
                // we have the data in database
                while ($rows = mysqli_fetch_assoc($res3)) {
                  // using while loop to get all data from database
                  // and while loop will run as long as we have data in database
                  // Get individual data
                  $id = $rows['id'];
                  $em_username = $rows['em_username'];
                  $em_password = $rows['em_password'];
                  $em_id = $rows['employee_id'];
                  $auth_status = $rows['auth_status'];

                  $sql5 = "SELECT employee_name FROM tbl_employee WHERE id = $em_id";
                  $res5 = mysqli_query($conn, $sql5);
                  if ($res5 == true) {
                    $data = mysqli_fetch_assoc($res5);
                    $employee_name = $data['employee_name'];
                  }

                  // display the value in table
            ?>

                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $employee_name; ?></td>
                    <td><?php echo $em_username; ?></td>
                    <td><?php echo $em_password; ?></td>
                    <td>
                      <?php

                      if ($auth_status == 1) {

                        echo '<p><a  href="./all-status/auth-status.php?id=' . $id  . '&action=0" ><button class="active-button">Active</button></a></p>';
                      } else if ($auth_status == 0) {

                        echo '<p><a href="./all-status/auth-status.php?id=' . $id  . '&action=1"><button  class="inactive-button">Inactive</button></a></p>';
                      }
                      ?>
                    </td>
                    <td>
                      <a href="<?php echo SITEURL; ?>update_auth.php?id=<?php echo $id; ?>"><button class="active-button">Update</button></a>
                      <a href="<?php echo SITEURL; ?>delete_auth.php?id=<?php echo $id; ?>"><button class="inactive-button">Remove</button></a>
                    </td>
                  </tr>

            <?php
                }
              } else {
                // we do not have data in database
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



</body>

</html>