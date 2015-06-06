<?php

$printername="PDF-Datei mit erweiterten Einstellungen"
$psfile="C:\\temp\\".$_FILES['userfile']['name'].".ps";
$pdffile="c:\\Apache2\\htdocs\\uploads\\".$_FILES['userfile']['name'].".pdf";
$result_link="<b>Result: Open PDF Result\n";
$uploaddir = 'c:\\Apache2\\htdocs\\uploads\\';
$uploaded_doc=$uploaddir.$_FILES['userfile']['name'];
$gsinst="c:\\gs\\gs8.13\\bin\\gswin32c.exe"
?>
<head><title>PDF Document Converter</title></head> 
<body bgcolor="#FFFFFF" text="#000000" link="#0000FF"> 
<table width="100%" border="0"> 
<tr> 
<td width="94%"><b>Office2PDF Conversion Service</b></td> 
</tr> 
<tr> 
<td>Supported Formats: doc, rtf, xls, ppt, txt, html, ps, eps</td> 
</tr> 
</table> 
<form enctype="multipart/form-data" action="<? $PHP_SELF ?>" method="post"> 
<table width="100%" border="0" bgcolor="#CCCCCC"> 
<tr> 
<td width="17%">Office File: </td> 
<td width="83%"><input name="userfile" type="file"></td> 
</tr> 
<tr> 
<td width="17%">Document-Password (if given): </td> 
<td width="83%"><input name="password" type="password"></td> 
</tr> 
<tr> 
<td>Quality: </td> 
<td><table width="200"> 
<tr> 
<td><label> 
<input type="radio" name="quality" value="300dpi"> 
300 DPI</label> 
</td> 
</tr> 
<tr> 
<td><label> 
<input type="radio" name="quality" value="600dpi"> 
600 DPI</label> 
</td> 
</tr> 
<tr> 
<td><label> 
<input type="radio" name="quality" value="1200dpi"> 
1200 DPI</label> 
</td> 
</tr> 
</table> 
</td> 
</tr> 
<tr> 
<td>Start conversion</td> 
<td><input type="submit" name="send" value="send file"> 
</td> 
</tr> 
</table> 
</form> 
<? 
if ($_POST['password']){ 
$password=$_POST['password']; 
} 
else { $password="False"; } 
list ($name, $suffix) = split ('[.]', $_FILES['userfile']['name']); 
function excel($document, $ps_file, $pdf_file){ 
$excel = new COM("excel.application") or die("Unable to instantiate Excel"); 
$excel->AskToUpdateLinks = 0; 
$excel->Workbooks->Open($document); 
$excel->Workbooks[1]->Saved=1; 
$excel->Workbooks[1]->PrintOut(1, 5000, 1, False, $printername, True, False, $ps_file); 
$excel->Workbooks[1]->Close(false); 
$excel->Quit(); 
$excel->Release(); 
$excel = null; 
unset($excel); 
while (exec("$gsinst -sDEVICE=pdfwrite -r300 -dNOPAUSE -dBATCH -dSAFER -sPAPERSIZE=a4 -sOutputFile=\"".escapeshellcmd($pdf_file)."\" \"".escapeshellcmd($ps_file)."\"") > 0){ 
sleep(1); 
} 
} 
function powerpoint($document, $ps_file, $pdf_file){ 
$powerpoint = new COM("powerpoint.application") or die("Unable to instantiate Powerpoint"); 
$powerpoint->Visible = 1; 
$powerpoint->Presentations->Open($document, False, False, False, False); 
$powerpoint->Presentations[1]->Saved=1; 
$powerpoint->ActivePrinter = $printername; 
$powerpoint->Presentations[1]->PrintOut(1, 5000, $ps_file, 0, False); 
$powerpoint->Presentations[1]->Close(); 
$powerpoint->Quit(); 
$powerpoint->Release(); 
$powerpoint = null; 
unset($powerpoint); 
while (exec("$gsinst -sDEVICE=pdfwrite -r300 -dNOPAUSE -dBATCH -dSAFER -sPAPERSIZE=a4 -sOutputFile=\"".escapeshellcmd($pdf_file)."\" \"".escapeshellcmd($ps_file)."\"") > 0) { 
sleep(1); 
} 
} 
function word($document, $ps_file, $pdf_file, $passwd){ 
$word = new COM("word.application") or die("Unable to instantiate Word"); 
//$word->Visible = 0; 
$word->Documents->Open($document, False, True, False, $passwd); 
$word->Documents[1]->Saved = 1; 
$word->ActivePrinter = "PDF-Datei mit erweiterten Einstellungen"; 
$word->Documents[1]->PrintOut(True, False, 0, $ps_file); 
while($word->BackgroundPrintingStatus > 0){ 
sleep(1); 
} 
$word->Documents[1]->Close(false); 
$word->Quit(); 
$word->Release(); 
$word = null; 
unset($word); 
while (exec("$gsinst -sDEVICE=pdfwrite -r300 -dNOPAUSE -dBATCH -dSAFER -sPAPERSIZE=a4 -sOutputFile=\"".escapeshellcmd($pdf_file)."\" \"".escapeshellcmd($ps_file)."\"") > 0){ 
sleep(1); 
} 
} 
if ($_POST['send']){ 
print "<pre>"; 
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$_FILES['userfile']['name'])) { 
if ($suffix=="doc" || $suffix=="dot" || $suffix=="htm" || $suffix=="html" || $suffix=="txt" || $suffix=="rtf"){ 
word($uploaded_doc, $psfile, $pdffile, $password); 
} 
elseif ($suffix=="xls" || $suffix=="xlt" || $suffix=="csv"){ 
excel($uploaded_doc, $psfile, $pdffile); 
} 
elseif ($suffix=="ps" || $suffix=="prn" || $suffix=="eps"){ 
while (exec("$gsinst -dBATCH -sDEVICE=pdfwrite -sOutputFile=\"c:\\apache2\\htdocs\\uploads\\".escapeshellcmd($pdffile)."\" -dNOPAUSE \"$uploaded_doc\"") > 0){ 
sleep(1); 
} 
} 
elseif ($suffix=="ppt" || $suffix=="pps" || $suffix=="pot" || $suffix=="PPT"){ 
powerpoint($uploaded_doc, $psfile, $pdffile); 
} else { 
echo'<strong><font color="#FF0000">Dateiformat wird nicht unterstützt !!!</strong></font><br>'; 
//exec("del \"$uploaded_doc\"");//Hochgeladene Datei löschen 
echo'<strong><font color="#FF0000">Hochgeladene Datei wieder gelöscht.</strong></font>'; 
exit(); 
} 
} else { 
echo '<strong><font color="#FF0000">Datei konnte nicht hochgeladen werden !</strong></font>'; 
exit(); 
} 
while (!(is_writable($pdffile))){ 
sleep(1); 
} 
if (!headers_sent()) { 
$header="http://localhost/uploads/".$_FILES['userfile']['name'].".pdf"; 
header ("Location: $header"); 
exit(); 
} else { echo 'Das Resultat befindet sich für 24 Stunden unter: '.$_FILES['userfile']['name'].'.pdf'; } 
exit(); 
} 
?> 
</BODY> 