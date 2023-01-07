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

            <li class="open-prosubmenu"><a href="">Stock</a><i class="fa fa-angle-right"></i>
              <div class="pro-submenu">
                <ul>
                  <li><a href="">Add Product Stock</a></li>
                  <li><a href="">Add Cup Stock</a></li>
                  <li><a href="">Product Stock List</a></li>
                  <li><a href="">Cup Stock List</a></li>
                </ul>
              </div>
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

      <div class="title">Booth Tagging</div>
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
          <select name="booth_id" id="subject">
            <?php
            $sql = "SELECT * FROM tbl_booth WHERE bt_status=1";
            $data =   $conn->query($sql);
            foreach ($data as $row) {
            ?>
              <option value="<?= $row["id"] ?>"><?= $row["booth_name"] ?></option>
            <?php } ?>
            <option value="" selected="selected">-- Select Booth --</option>
          </select>
      </div>
      <div class="header">
        <h3>Select Employee:</h3>
      </div>
      <div class="drop">

        <select name="employee_id" id="subject">
          <?php
          $sql = "SELECT * FROM tbl_employee WHERE em_status=1";
          $data =   $conn->query($sql);
          foreach ($data as $row) {
          ?>

            <option value="<?= $row["id"] ?>"><?= $row["employee_name"] ?></option>

          <?php } ?>
          <option value="" selected="selected">-- Select Employee --</option>
        </select>
      </div>

      <div class="content">

        <div class="submit">

          <button class="button" type="submit" name="submit">Add</button>
        </div>
        </form>
        <?php

        //  $sql4 = "SELECT bt.booth_name,em.employee_name FROM tbl_booth bt, tbl_employee em WHERE em.id=bt.employee_id";
        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
          //1. Get the id of selected admin
          $booth_name = $_POST['booth_name'];
          $employee_name = $_POST['employee_name'];
          $booth_id = $_POST['booth_id'];
          $id = $_POST['employee_id'];
          //2. Create sql query to get the details
          $sql2 = "SELECT * FROM tbl_tagging WHERE employee_id='$id'";

          //Execute the query
          $res2 = mysqli_query($conn, $sql2);

          //check whether the query is executed or not
          if ($res2 == true) {
            //check the data is available or not
            $count = mysqli_num_rows($res2);
            $rows = mysqli_fetch_assoc($res2);
            if ($count > 0) { //print message already exist
              //get the details
              $_SESSION['add'] = "<div class='error'>Employee Already Added!!</div>";
        ?>
              <script>
                window.location.href = '<?php echo SITEURL ?>boothtag.php';
              </script>
              <?php
            } else {
              //Get all the info from the form


              //Create a sql query to update admin
              $sql3 = "INSERT tbl_tagging SET
    booth_name = '$booth_name',
    employee_name = '$employee_name',
    booth_id = '$booth_id',
    employee_id = '$id';
    ";
              $sql4 = "UPDATE tbl_employee SET
    booth_id = $booth_id WHERE id=$id";

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
                    window.location.href = '<?php echo SITEURL ?>boothtag.php';
                  </script>
                <?php
                }
              } else {
                //failed to execute the query
                $_SESSION['add'] = "<div class='error'>Tagging Failed!!</div>";
                ?>
                <script>
                  window.location.href = '<?php echo SITEURL ?>boothtag.php';
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
              <th>Booth</th>
              <th>Employee</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql5 = 'SELECT * FROM tbl_tagging';
            $res5 = mysqli_query($conn, $sql5);
            if ($res5 == true) {
              $count = mysqli_num_rows($res5);
              $sl = 1;
              if ($count > 0) {
                while ($data = mysqli_fetch_assoc($res5)) {
                  $id = $data['id'];
                  $booth_name = $data['booth_name'];
                  $employee_name = $data['employee_name'];
                  $employee_id = $data['employee_id'];
                  $booth_id = $data['booth_id'];
                  $tag_status = $data['tag_status'];

                  $sql6 = "SELECT employee_name FROM tbl_employee WHERE id = $employee_id";
                  $res6 = mysqli_query($conn, $sql6);
                  if($res6 == true){
                  $rows = mysqli_fetch_assoc($res6);
                  $employee_name = $rows['employee_name'];
                  }
                  $sql7 = "SELECT booth_name FROM tbl_booth WHERE id = $booth_id";
                  $res7 = mysqli_query($conn, $sql7);
                  if($res7 == true){
                  $rows = mysqli_fetch_assoc($res7);
                  $booth_name = $rows['booth_name'];
                  }
            ?>
                  <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $booth_name; ?></td>
                    <td><?php echo $employee_name; ?></td>
                    <td>
                      <?php

                      if ($tag_status == 1) {

                        echo '<p><a  href="./all-status/tag-status.php?id=' . $id  . '&action=0" ><button class="success">Active</button></a></p>';
                      } else if ($tag_status == 0) {

                        echo '<p><a href="./all-status/tag-status.php?id=' . $id  . '&action=1"><button  class="error">Inactive</button></a></p>';
                      }
                      ?>
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


</body>

</html>