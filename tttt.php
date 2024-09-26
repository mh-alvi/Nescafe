<?php

$sql = "SELECT * FROM tbl_sales";
$res = mysqli_query($conn, $sql);
if ($res == true) {
    $count = mysqli_num_rows($res);
    $sl = 1;
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $booth_id = $row['booth_id'];
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $opening = $row['opening'];
            $closing = $row['closing'];
            $wastage = $row['wastage'];
            $sales = $row['sales'];
            $total = $row['total'];
            $due = $row['due'];
            $other = $row['other'];
            $expense = $row['expense'];
            $total_expense = $row['total_expense'];
            $collection = $row['collection'];
            $total_cash = $row['total_cash'];
            $created_at = $row['created_at'];
?>
            <tr>
                <td><?php echo $sl++; ?></td>
                <td><?php echo $product_name; ?></td>
                <td><?php echo $opening; ?></td>
                <td><?php echo $closing; ?></td>
                <td><?php echo $wastage; ?></td>
                <td><?php echo $sales; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo $due; ?></td>
                <td><?php echo $other; ?></td>
                <td><?php echo $expense; ?></td>
                <td><?php echo $total_expense; ?></td>
                <td><?php echo $collection; ?></td>
                <td><?php echo $total_cash; ?></td>
            </tr>
<?php
        }
    } else {
    }
}
?>


<?php
$sql = "SELECT * FROM tbl_booth";
$data =   $conn->query($sql);
$booth_id = $row['booth_id'];
foreach ($data as $row) {
?>
    <option value="<?= $row["id"] ?>"><?= $row["booth_name"] ?></option>

<?php } ?>
<?php date_default_timezone_set('Asia/Dhaka');
echo date('Y-m-d'); ?>

booth_id='$booth_id' AND sales_date='$date1'"

<?php

//check whether the submit button is clicked or not
if (isset($_GET['booth_id']) && isset($_GET['date'])) {
    //1. Get the id of selected admin
    $booth_id = $_GET['booth_id'];
    $date = $_GET['date'];

    $newDate = date("d-m-Y", strtotime($date));
    //2. Create sql query to get the details
    $sql2 = "SELECT * FROM tbl_sales WHERE booth_id='$booth_id' AND sales_date='$newDate'";

    //Execute the query
    $res2 = mysqli_query($conn, $sql2);
    $sl = 1;

    //check whether the query is executed or not
    if ($res2 == true) {
        //check the data is available or not
        $count = mysqli_num_rows($res2);
        // $rows = mysqli_fetch_assoc($res2);
        if ($count > 0) { //print message already exist
            //get the details
            while ($rows = mysqli_fetch_assoc($res2)) {
                $booth_id = $rows['booth_id'];
                $product_id = $rows['product_id'];
                $product_name = $rows['product_name'];
                $opening = $rows['opening'];
                $closing = $rows['closing'];
                $wastage = $rows['wastage'];
                $sales = $rows['sales'];
                $total = $rows['total'];
                $due = $rows['due'];
                $other = $rows['other'];
                $expense = $rows['expense'];
                $total_expense = $rows['total_expense'];
                $collection = $rows['collection'];
                $total_cash = $rows['total_cash'];
                $created_at = $rows['created_at'];
?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $opening; ?></td>
                    <td><?php echo $closing; ?></td>
                    <td><?php echo $wastage; ?></td>
                    <td><?php echo $sales; ?></td>
                    <td><?php echo $total; ?></td>
                </tr>

            <?php
            }
        } else {
            ?>
            <tr>
                <td><?php echo "No Data Added!!"; ?></td>
            </tr>
<?php

        }
    }
}

?>
  if (isset($_GET['search'])) {
                $date1 = date("Y-m-d", strtotime($_GET['date1']));
                $date2 = date("Y-m-d", strtotime($_GET['date2']));
                $query = mysqli_query($conn, "SELECT * FROM employees WHERE date(`date_of_birth`) BETWEEN '$date1' AND '$date2'");
                $row = mysqli_num_rows($query);
                if ($row > 0) {
                    foreach ($query as $key => $fetch) {   ?>
                        <tr>
                            <td><?php echo $fetch['first_name'] ?></td>
                        </tr>
            <?php
                    }
                } else {
                    echo '
   <tr>
    <td colspan = "4"><center>Record Not Found</center></td>
   </tr>';
                }
            } ?>




<select name="product_id" id="subject">
        <option value="" disabled="" selected="selected">-- Select Product --</option>
          <?php
          $sql = "SELECT * FROM tbl_product";
          $data =   $conn->query($sql);
          foreach ($data as $row) {
          ?>

            <option value="<?= $row["id"] ?>"><?= $row["product_name"] ?></option>

          <?php } ?>
        </select>