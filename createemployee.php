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
  <link rel="stylesheet" href="./createemployee.css">
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
      <div class="title">Add Employee</div>
      <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add']; // display session message
        unset($_SESSION['add']); // removing session message
      }
      ?>
      <div class="content">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Full Name</span>
              <input type="text" name="name" placeholder="Enter name" required>
            </div>
            <div class="input-box">
              <span class="details">Designation</span>
              <input type="text" name="designation" placeholder="Enter designation" required>
            </div>
            <div class="input-box">
              <span class="details">Job-ID</span>
              <input type="text" name="job-id" placeholder="Enter job-id" required>
            </div>
            <div class="input-box">
              <span class="details">Email</span>
              <input type="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="input-box">
              <span class="details">Phone Number</span>
              <input type="text" name="number" placeholder="Enter number" required>
            </div>
            <div class="input-box">
              <span class="details">Address</span>
              <input type="text" name="address" placeholder="Enter address" required>
            </div>
            <div class="input-box">
              <span class="details">NID</span>
              <input type="text" name="nid" placeholder="Enter NID no" required>
            </div>
            <div class="input-box">
              <span class="details">Education</span>
              <input type="text" name="education" placeholder="Enter education details" required>
            </div>
            <div class="input-box">
              <span class="details">Social link</span>
              <input type="text" name="social-link" placeholder="Enter social link" required>
            </div>
            <div class="input-box">
              <span class="details">Join Date</span>
              <input type="date" name="date" placeholder="Enter joining date" required>
            </div>
            <div class="input-box2">
              <span class="details2">Upload your photo</span>
              <input type="file" id="myFile" name="filename">
            </div>
          </div>
          <div class="gender-details">
            <input type="radio" name="gender" value="male" id="dot-1">
            <input type="radio" name="gender" value="female" id="dot-2">
            <input type="radio" name="gender" value="others" id="dot-3">
            <span class="gender-title">Gender</span>
            <div class="category">
              <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Male</span>
              </label>
              <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Female</span>
              </label>
              <label for="dot-3">
                <span class="dot three"></span>
                <span class="gender">Prefer not to say</span>
              </label>
            </div>
          </div>
          <div class="button">
            <input type="submit" name="submit" value="Create">
          </div>
        </form>

        <?php

        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
          //1. Get the value from category form
          $name = $_POST['name'];
          $designation = $_POST['designation'];
          $job_id = $_POST['job-id'];
          $email = $_POST['email'];
          $phone = $_POST['number'];
          $address = $_POST['address'];
          $nid = $_POST['nid'];
          $education = $_POST['education'];
          $date = $_POST['date'];
          $social_link = $_POST['social-link'];

          //for radio input we need to check whether the button is clicked or not
          if ($_POST['gender'] == 'male') {
            //Get the value from form
            $gender = $_POST['gender'];
          } elseif ($_POST['gender'] == 'female') {
            $gender = $_POST['gender'];
          } else {
            $gender = $_POST['gender'];
          }

            //image adding
            $direction = 'images/employee-image/';
            $image = $_FILES['filename']['name'];
            $file_path = $direction . $image;
            $image2 = $_FILES['filename']['tmp_name'];
            move_uploaded_file($image2, $file_path);

          //2. Create sql query to insert category into database
          $sql = "INSERT INTO tbl_employee_details SET
                em_name = '$name',
                em_designation = '$designation',
                em_job_id = '$job_id',
                em_email = '$email',
                em_phone = '$phone',
                em_address = '$address',
                em_nid = '$nid',
                em_education = '$education',
                em_joining_date = '$date',
                em_social_link = '$social_link',
                em_gender = '$gender',
                image_name = '$image'
                ";

          //execute the query and save it in database
          $res = mysqli_query($conn, $sql);

          //4. check whether the qeury execute or not and data added or not
          if ($res == true) {
            $sql2 = "SELECT em_name, em_job_id, em_joining_date, id FROM tbl_employee_details ORDER BY id DESC LIMIT 1";
            $res2 = mysqli_query($conn, $sql2);
            $count = mysqli_num_rows($res2);
            if ($count > 0) {
              // we have the data in database
              while ($rows = mysqli_fetch_assoc($res2)) {
                $em_name = $rows['em_name'];
                $em_job_id = $rows['em_job_id'];
                $em_join_date = $rows['em_joining_date'];
                $em_id = $rows['id'];
              }
            }

            if ($res2 == true) {
              $sql3 = "INSERT INTO tbl_employee SET
                employee_name = '$em_name',
                job_id = '$em_job_id',
                join_date = '$em_join_date',
                employee_details_id = '$em_id'
                ";
              $res3 = mysqli_query($conn, $sql3);
              if ($res3 == true) {
                //query executed and employee added
                $_SESSION['add'] = "<div class='success'>Employee Added Successfully!!</div>";
                //redirect  to employee main
        ?>
                <script>
                  window.location.href = '<?php echo SITEURL ?>employee.php';
                </script>
              <?php
              } else {
                //failed to add employee
                $_SESSION['add'] = "<div class='error'>Failed to Add Employee!!</div>";
                //redirect  to employee
              ?>
                <script>
                  window.location.href = '<?php echo SITEURL ?>employee.php';
                </script>
        <?php
              }
            }
          }
        } else {
        }

        ?>

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