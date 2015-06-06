<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Doc extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->library('pdf'); // Load library
    $this->pdf->fontpath = 'font/'; // Specify font folder
  }
  public function index($id,$chap)
  {
	
    
      $filter = array('dep_id' => $id);
	  $department = $this->mhome->get_list($filter,'ssr_t_department');
	
	foreach ($department as $row_department)
	{ 
			
				$this->SetDepartment($row_department->dep_id);
				
				
				$index_array = array();
				$chapter_no = 0;
    
     $filter = array('chap_id' => $chap);
		$chapter = $this->mhome->get_list($filter,'ssr_t_chapter');
   // print_r($chapter);die;	
         $chapter_no = 0;
	
			foreach ($chapter as $row_chapter)
	        {

				if ($row_chapter->dep_id==$row_department->dep_id)
				{
					$index_array[$row_chapter->chap_name][0]=$this->pdf->PageNo()+1;
					
						
					//Set a new Chapter with Chapter Name	
					$this->SetChapterName($row_chapter->chap_id);


					//Start the Chapter with Chapter no and description
					$chapter_no = $chapter_no + 1;
					$chapter_title = "Chapter ".$chapter_no;
					$chapter_title = $chapter_title." - ".$row_chapter->chap_desc;
					$this->SetChapterTitle($row_chapter->chap_id);
					$this->SetItemHeading();

					
$arr_item_names = array();
			
$item_array = array();
$subitem_array = array();

$filter = array('chap_id' => $row_chapter->chap_id);
$item = $this->mhome->get_list($filter,'ssr_t_item');
$filter = array('item_id' => $item[0]->item_id);
$subitem = $this->mhome->get_list($filter,'ssr_t_subitem');
foreach ($item as $row_item)
{
	$existing_item = array_search($row_item->item_class_id,$item_array);
	if(!$existing_item)
	{
		$item_array[$row_item->dep_id][$row_item->chap_id][$row_item->item_name][] = $row_item->item_class_id;
		
	}
	
	
	foreach ($subitem as $row_subitem)
	{
		if ($row_subitem->item_id==$row_item->item_id)
		{
			$subitem_array[$row_item->dep_id][$row_item->chap_id][$row_item->item_name][$row_subitem->subitem_name][]=$row_subitem->rate;
		}
	}
}
			foreach($item as $row_item)
			{
				//print_r($row_item);die;
				if($row_item->chap_id==$row_chapter->chap_id)
							
				{
					$this->SetItemDetails($row_item->item_id);
					// print_r($row_item->item_class_id);die;
					$class_details = (explode(",", $row_item->item_class_id));
					 //$class_details =  implode(",", $row_item->item_class_id);
					//print_r($class_details);die;
					$class_count = sizeof($class_details);
					//print_r($class_count);die;
					$class_names = array();
					
					$class = $this->mhome->get_class_list();	
					for ($i=0;$i<$class_count;$i++)
					{//print_r($class_details[$i]);
						foreach ($class as $key=>$row_class)
						{//print_r($class_details[$i]);
							if ($row_class->id==$class_details[$i])
							{
								$class_names[$i]=$row_class->class_name;
							}
						}
					}
					
					
					for ($i=0;$i < $class_count;$i++)
					{
						$this->pdf->SetX(120+20*$i);
						$this->pdf->Cell(10,10,$class_names[$i]);
					}
					$this->pdf->Ln();
					
					$initial_Y = $this->pdf->GetY();
					
						$subitem_names = $this->mhome->get_subitem_names();
								
						foreach($subitem_names as $row_subitem_names)
						{
							if ($row_subitem_names->item_id==$row_item->item_id)
							{
								$this->pdf->SetX(30);
								$this->pdf->Cell(65,10,$row_subitem_names->subitem_desc,0,0);
								$this->pdf->Cell(20,10,$row_subitem_names->unit,0,1);
							}
						
						
						}
						
						for ($i=0;$i<$class_count;$i++)
						{
							$this->pdf->SetY($initial_Y);
							foreach($subitem as $row_subitem)
							{
								if (($row_subitem->item_id==$row_item->item_id) AND ($row_subitem->subitem_class_id==$class_details[$i]))
								{
									//echo '<pre>';
									//echo $row_subitem[3].' '.$row_subitem[2];
									//echo '</pre>';
									
									
									$this->pdf->SetX(120 + 20*$i);
									$this->pdf->Cell(20,10,$row_subitem->rate,0,1);
									
								}
							}
						}
						
						//$pdf->Ln();
					}
				}
			}
			
			$index_array[$row_chapter->chap_name][1]=$this->pdf->PageNo();
			//print_r($index_array);
		}
	
	
	
	
	$this->pdf->Output();
	
	
	}
  }
	function SetDepartment($dep_id)
	{
		 $filter = array('dep_id' => $dep_id);
		$department = $this->mhome->get_list($filter,'ssr_t_department');
		$this->pdf->SetAutoPageBreak('true', 20);
		
		
		$this->pdf->SetFont('Arial','',50);
		$this->pdf->AddPage();
		$this->pdf->SetTopMargin(TOP_MARGIN);
		
		$this->pdf->AliasNbPages();
		$w = $this->pdf->GetStringWidth($department[0]->dep_name);
		$this->pdf->SetXY(70,130);
		$this->pdf->Cell($w,0,$department[0]->dep_name,0,1,'C');
	}
	function SetChapterName($chap_id)
	{
		 $filter = array('chap_id' => $chap_id);
		$chapter = $this->mhome->get_list($filter,'ssr_t_chapter');
		
		$this->pdf->SetFont('Arial','',30);
		$this->pdf->AddPage();
		$this->pdf->SetAutoPageBreak('true', 20);
		$this->pdf->AliasNbPages();
		$w = $this->pdf->GetStringWidth($chapter[0]->chap_name);
		$this->pdf->SetXY(70,130);
		$this->pdf->Cell($w,0,$chapter[0]->chap_name,0,1,'C');
		$this->pdf->AddPage();
		
		
	}
	function SetItemHeading()
	{


		$this->pdf->SetFont('Arial','B',15);
		$this->pdf->Cell(20,10,'S.No');
		$this->pdf->Cell(80,10,'Particulars of Items');
		$this->pdf->Cell(50,10,'Unit');
		$this->pdf->Cell(20,10,'Rates(in Rs.)',0,1);
		//$this->Ln(20);
	}

	function SetChapterTitle($title)
	{
		$this->pdf->SetFontSize(5);
		$this->pdf->MultiCell(180,10,$title,0,'C');
		$this->pdf->Ln(10);
	}
	function SetItemDetails($item_id)
	{ $filter = array('item_id' => $item_id);
       $item = $this->mhome->get_list($filter,'ssr_t_item');
		$this->pdf->SetFont('Arial','',15);
		$this->pdf->SetFontSize(12);
			
		//print item heading notes
		if ($item[0]->item_heading !== ''){
			$this->pdf->Cell(20,10,'',0,0);
			$this->pdf->MultiCell(60,10,$item[0]->item_heading);
		//$this->pdf->SetFont('Arial','',12);
		}	
		//print item name and description
		$this->pdf->Cell(10,10, $item[0]->item_name,0,0);
		$this->pdf->MultiCell(50, 10, $item[0]->item_desc);
		
		
	}
	function custHeader($font_family, $font_style, $font_size, $content)
	{ 
		$this->pdf->SetFont($font_family, $font_style, $font_size);
		//$this->Cell(80);
		$this->pdf->Cell(30,10,$content,1,1,'C');
	}

	function getTitle()
	{
		return $this->pdf->title;
	}
	function Footer()
	{
		$this->pdf->SetY(-15);
		$this->pdf->SetFontSize(10);
		$this->pdf->Cell(0,10,'Page '.$this->pdf->PageNo().'/{nb}',0,0,'C');
	}
}
?>
