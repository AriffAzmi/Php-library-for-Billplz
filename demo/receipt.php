<?php
define('SERVER_PATH','/var/www/html/payment-gateway/');
require_once(SERVER_PATH.'receipt/modules/pdf/tcpdf_include.php');

$today_date = date('Y-m-d H:i:s');
$today_format = date('dS F Y - H:i', strtotime($today_date));

$bill_id = $_REQUEST['bill_id'];

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
// $pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Receipt Payment For Your Product Purchased. Bill id: '.$bill_id.'');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(SERVER_PATH.'receipt/modules/pdf/lang/eng.php')) {
	require_once(SERVER_PATH.'receipt/modules/pdf/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('', '', 10);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

$html = '
<table border="" cellspacing="" cellpadding="">
	<tr>
		<th></th>
		<th align="right"></th>
		<th align="left"></th>
		<th></th>
	</tr>
	<tr>
		<td colspan="4" align="center">
			<img src="http://store.storeimages.cdn-apple.com/4973/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone6/plus/iphone6-plus-box-silver-2014_GEO_US?wid=478&hei=595&fmt=jpeg&qlt=95&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1453545546605" width="100" alt="Company Logo">
			<br>
			<br>
			Thank you for purchased our product.
			<br>  
			<hr>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<font color="#2C3E50"><b>PRODUCT DETAILS</b></font>
			<br>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<small style="color:#6C7A89">BILL ID</small>
			<br>
			'.$bill_id.'
		</td>
		<td colspan="2">
			<small style="color:#6C7A89">PURCHASED DATE</small>
			<br>
			'.$today_format.'
		</td>
	</tr>
	<tr>
		<td colspan="4" height="10">
		
			
		</td>
	</tr>
	<tr>
		<td colspan="4" height="40">
		
			<hr>	
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<font color="#2C3E50"><b>RECEIPT SUMMARY</b></font>
			<br>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<small style="color:#6C7A89">DESCRIPTION</small>
			<br>
			Product Details
		</td>
		<td colspan="2">
			<small style="color:#6C7A89">KILOMETERS (KM)</small>
			<br>
			'.$distance.'
			<br>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<hr>			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Total MYR
		</td>
		<td colspan="2">
			<b>'.$paymentTotal.'</b>
			<br>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<hr>			
		</td>
	</tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example-receipt.pdf');

//============================================================+
// END OF FILE
//============================================================+