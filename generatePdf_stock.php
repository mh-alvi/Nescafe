<?php

include('./config/constants.php');
include('./partials/login-check.php');
require_once('TCPDF-main/tcpdf.php');


if (isset($_GET['pdf_generator'])) {
    $booth_id = $_GET['booth_id'];
    $formdate = date("d-m-Y", strtotime($_GET['date']));
    global $formdate;

    $sql = "SELECT * FROM tbl_stock_report AS tsr RIGHT JOIN tbl_employee AS te ON tsr.created_by = te.id RIGHT JOIN tbl_booth AS tb ON (tsr.created_by = te.id AND tsr.booth_id = tb.id) WHERE tsr.booth_id='$booth_id' AND posting_date='$formdate'";

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        while ($data = mysqli_fetch_assoc($res)) {
            $booth_name = $data['booth_name'];
            $emp_name = $data['employee_name'];
            $booth_add = $data['booth_address'];
        }
    } else {
        $_SESSION['add'] = "<div class='error'>No Data Exist!!</div>";
?>
        <script>
            window.location.href = '<?php echo SITEURL ?>stockreport.php';
        </script>
<?php
    }

    class PDF extends TCPDF
    {

        public function Header()
        {
            global $booth_name;
            global $booth_add;
            $this->Ln(5);
            $this->setFont('helvetica', 'B', 12);
            $this->Cell(189, 5, $booth_name, 0, 1, 'C');

            $this->setFont('helvetica', '', 10);
            $this->Cell(189, 4, $booth_add, 0, 1, 'C');
            $this->Cell(189, 4, 'Stock Report', 0, 1, 'C');
        }
        public function Footer()
        {
            $this->setY(-28);
            $this->setFont('helvetica', 'B', 10);
            $this->Cell(20, 1, '_______________', 0, 0);
            $this->Cell(118, 1, '', 0, 0);
            $this->Cell(51, 1, '___________', 0, 1);

            $this->Cell(20, 5, 'Admin Signature', 0, 0);
            $this->Cell(118, 5, '', 0, 0);
            $this->Cell(51, 5, 'Prepared By', 0, 0);
            $this->Ln(10);

            $this->setFont('helvetica', 'I', 8);

            date_default_timezone_set("Asia/Dhaka");
            $today = date("F j, Y/ g:i A", time());

            $this->Cell(25, 5, 'Generation Date/Time: ' . $today, 0, 0, 'L');
            $this->Cell(164, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);


    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nescafe Admin');
    $pdf->SetTitle('Stock Report');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);



    // Add a page
    // This method has several options, check the source code documentation for more information.

    $sql2 = "SELECT * FROM tbl_stock_report AS tsr RIGHT JOIN tbl_product_stock AS tps ON tsr.stock_id=tps.id WHERE tsr.booth_id='$booth_id' AND tsr.posting_date='$formdate'";

    $res2 = mysqli_query($conn, $sql2);
    $sl = 1;

    $pdf->AddPage();

    $pdf->setFont('times', 'B', 10);
    // $pdf->Cell(189, 3, 'Report as on:- ' . $formdate, 0, 1, 'C');
    $pdf->Cell(189, 3, 'Report as on:- ' . $formdate, 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->setFont('times', 'B', 8);
    $pdf->Cell(130, 5, 'Prepared By:- ' . $emp_name, 0, 0);
    // $pdf->Cell(130, 5, 'Reported By:- '.$emp_name, 0, 0);
    $pdf->Ln(8);

    $pdf->setFillColor(224, 235, 255);
    $pdf->Cell(8, 5, 'S N', 1, 0, 'C', 1);
    $pdf->Cell(24, 5, 'Stock Name', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'Price', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'O.Stock', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'Received', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'T.Stock', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'T.Used', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'T.Waste', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'T.Damage', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'C.Stock', 1, 0, 'C', 1);
    $pdf->Cell(16, 5, 'Stock Costs', 1, 1, 'C', 1);
    $pdf->setFont('times', '', 7.5);

    // }
    while ($list = mysqli_fetch_assoc($res2)) {
        $stock_name = $list['stock_name'];
        $stock_price = $list['stock_price'];
        $opening_stock = $list['opening_stock'];
        $stock_rec = $list['stock_receive'];
        $total_stock = $list['total_stock'];
        $stock_used = $list['stock_used'];
        $stock_waste = $list['stock_waste'];
        $stock_damage = $list['stock_damage'];
        $closing_stock = $list['closing_stock'];
        $stock_cost = $list['total_stock_price'];

        $pdf->Cell(8, 4, $sl, 1, 0, 'C', 0);
        $pdf->Cell(24, 4, $stock_name, 1, 0);
        $pdf->Cell(16, 4, $stock_price, 1, 0, 'C');
        $pdf->Cell(16, 4, $opening_stock, 1, 0, 'C');
        $pdf->Cell(16, 4, $stock_rec, 1, 0, 'C');
        $pdf->Cell(16, 4, $total_stock, 1, 0, 'C');
        $pdf->Cell(16, 4, $stock_used, 1, 0, 'C');
        $pdf->Cell(16, 4, $stock_waste, 1, 0, 'C');
        $pdf->Cell(16, 4, $stock_damage, 1, 0, 'C');
        $pdf->Cell(16, 4, $closing_stock, 1, 0, 'C');
        $pdf->Cell(16, 4, $stock_cost, 1, 1, 'C');
        $sl++;
    }

    $sql4 = "SELECT SUM(total_stock_price) AS Total_cost FROM tbl_stock_report WHERE booth_id='$booth_id' AND posting_date='$formdate'";
    //execute query
    $res4 = mysqli_query($conn, $sql4);
    //count rows 
    $row = mysqli_fetch_assoc($res4);
    $total_cost = $row['Total_cost'];

    $pdf->Ln(1);

    $pdf->setFont('times', 'B', 10);
    $pdf->Cell(131, 4, '', 0, 0);
    $pdf->Cell(22, 4, 'Total Cost= ', 0, 0, 'C');
    $pdf->Cell(22, 4, $total_cost, 0, 0, 'C');

    $pdf->Ln(8);
} else {
    echo "Data not Found";
}
// Close and output PDF document
$pdf->Output($booth_name . '_' . $formdate . '.pdf', 'I');
