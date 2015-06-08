<?php
if (! function_exists('array_column')) {
	function array_column(array $input, $columnKey, $indexKey = null) {
		$array = array();
		foreach ($input as $value) {
			if ( ! isset($value[$columnKey])) {
				trigger_error("Key \"$columnKey\" does not exist in array");
				return false;
			}
			if (is_null($indexKey)) {
				$array[] = $value[$columnKey];
			}
			else {
				if ( ! isset($value[$indexKey])) {
					trigger_error("Key \"$indexKey\" does not exist in array");
					return false;
				}
				if ( ! is_scalar($value[$indexKey])) {
					trigger_error("Key \"$indexKey\" does not contain scalar value");
					return false;
				}
				$array[$value[$indexKey]] = $value[$columnKey];
			}
		}
		return $array;
	}
}
require('fpdf/fpdf.php');
define("FIRST_PAGE_NO",0);
$dep_id=$_GET["dep_id"];
$chap_id=$_GET["chap_id"];
class PDF extends FPDF
{
	var $curcol = 0;
	var $y0 = 0;
	var $maxcols;
	var $state;
	
	function get_state()
	{
		return $this->state;
	}
	
	function set_y0($x)
	{
		$this->y0 = $x;
	}
	function get_cut_col()
	{
		return $this->curcol;
	}
	
	function set_cut_col($x)
	{
		$this->curcol = $x;
	}
	
	function get_max_col()
	{
		return $this->maxcols;
	}
	
	function set_max_col($x)
	{
		$this->maxcols = $x;
	}
	
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	     $this->SetY(-10);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $pno = FIRST_PAGE_NO + $this->pageNo();
	    $this->Cell(0,10,'Page '.$pno,0,0,'R');
	}
	
	
	
}

$servername = "localhost";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=sor", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully";
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}


// Column headings

// Data loading
//start testing
$st = $conn->prepare('SELECT * FROM ssr_t_department WHERE dep_id="'.$dep_id.'"');
$st->execute();
$department = $st->fetchAll();


 $st = $conn->prepare('SELECT * FROM ssr_t_chapter WHERE chap_id="'.$chap_id.'" ');
 $st->execute();
 $chapter = $st->fetchAll();
//end testing
$st = $conn->prepare('SELECT * FROM ssr_t_item  WHERE dep_id="'.$dep_id.'" AND chap_id="'.$chap_id.'" ORDER BY item_name, item_class_id');
$st->execute();
$item = $st->fetchAll();


$st = $conn->prepare('SELECT * FROM ssr_t_subitem  WHERE dep_id="'.$dep_id.'" AND chap_id="'.$chap_id.'" ORDER BY item_id, subitem_name, subitem_class_id');
$st->execute();
$subitem = $st->fetchAll();

$st = $conn->prepare('SELECT unit_code  FROM ssr_t_uom ORDER BY unit_code');
$st->execute();
$unit = $st->fetchAll();

$u1 = array_column($unit, 'unit_code');
$u2 = array_column($unit, 'unit_code');
$u3 = array();
for ($i=0;$i<count($u1);$i++)
{
	$u3[$u1[$i]]=$u2[$i];
}

//echo '<pre>';
//print_r($u3);
//echo '</pre>';

$st = $conn->prepare('SELECT id, class_name FROM ssr_t_class ORDER BY id');
$st->execute();
$class = $st->fetchAll();

$c1 = array_column($class, 'id');
$c2 = array_column($class, 'class_name');
$c3 = array();
for ($i=0;$i<count($c1);$i++)
{
	$c3[$c1[$i]]=$c2[$i];
}

//echo '<pre>';
//print_r($c3);
//echo '</pre>';

$a4 = array();
$i_id = array_unique(array_column($item, 'item_id'), SORT_STRING);


$pdf = new PDF();
$pdf->AliasNbPages();
//$pdf->SetAutoPageBreak(true,20);

//Set column spacing for various elements
$w_item = array(20,70,20,20);
$w1_item = array(20,65,20,20);
$w_class = array(120,20);
$w_si = array(30,75,20,20);

//Declare header for items
$h_item = array('S.No','Particulars of Items','Unit','Rates(in Rs.)');


//$pdf->AddPage();
//
foreach ($chapter as $row_chapter)
{  
			
			$pdf->AddPage();
			$pdf->SetFontSize(40);
			$chapter_title = $row_chapter['chap_name'];
			$pdf->MultiCell(100,230,$chapter_title,0,'C');
			$pdf->AddPage();
		
//
foreach($item as $row_item)
{
	$pdf->SetFont('Arial','',10);
	
	//Set formating parameters of the PDF class
	$pdf->set_cut_col(0);
	$pdf->set_max_col(0);
	$pdf->set_y0(0);
	
	//Print item header row
	$pdf->SetFont('Arial','B',10);
	for($i=0;$i<count($w_item);$i++)
	{
		$pdf->Cell($w_item[$i],10,$h_item[$i],0,0,'L');
	}
	$pdf->Ln();
	
	$pdf->SetFont('Arial','',10);
	//Print item name
	$pdf->Cell($w1_item[0],8,$row_item[3],0,0,'L');
	$y = $pdf->GetY();
	
	//Print item description
	$pdf->MultiCell($w1_item[1],8,$row_item[5]);
	
	
	//Get all classes of the item in an array
	$class = explode(',',$row_item[7]);
	$pdf->set_max_col(count($class)+2);
	$r = $pdf->get_max_col();
	
	
	
	//Print class names for the item
	$pdf->SetX($w_class[0]);
	for ($i=0;$i<count($class);$i++)
	{
		$class_to_show = $c3[$class[$i]];
		$pdf->Cell($w_class[1],8,$class_to_show,0,0,'L');
	}
	$pdf->Ln();
	
	
	$a2 = array();
	foreach ($subitem as $row_subitem)
	{
		//Put units and rates of all subitems for the current item in an associative array	
		if ($row_subitem[3]==$row_item[0])
		{  
			if (array_key_exists($row_subitem[6],$u3))
			{ 
				$unit_to_show = $u3[$row_subitem[6]];
				//echo $unit_to_show;
			}
			
			
			
			$a2[$row_subitem[8]][$row_subitem[5]][0] = $unit_to_show;
			$a2[$row_subitem[8]][$row_subitem[5]][1] = $row_subitem[7];
			  
		}
	}

	foreach($a2 as $k_sid=>$v_sid)
	{
		
		
		//print the subitem description
		$pdf->set_cut_col(1);
		$pdf->SetX($w_si[0]);
		
		//Get Y before and after priniting the 
		$ytop = $pdf->GetY();
		$pdf->MultiCell($w_si[1],8,$k_sid);
		$ybot = $pdf->GetY();
		if ($ybot<$ytop)
		{
			$ytop = $ybot-10;
			$ybot = $ytop + 10;
		}
		
		
		
		$pdf->set_cut_col(2);
		$pdf->SetY($ytop);
		$unit_printed = false;
		
		$l=0;
		
		
		foreach($v_sid as $k_sic=>$v_sic)
		{
								
				//print the units
				if (!$unit_printed)
				{
					$pdf->SetX($w_si[0]+$w_si[1]);
					$pdf->Cell($w_si[2],8,$v_sic[0],0,0,'L');
					$unit_printed = true;
					
				}
				
				//print the rates
				$pdf->SetX(120 + 20*$l);
				$pdf->set_cut_col(3+$l);
				//echo 60 + 40*$l;
				
				$pdf->Cell(20,8,$v_sic[1],0,0,'L');
				$l = $l + 1;
			
			
		}
		$pdf->SetY($ybot);
		$pdf->set_cut_col($pdf->get_cut_col()+1);
	
		
	}
}
//
}
//


$pdf->Output();

?>