<?php 
require('pdf_js.php');

class PDF_AutoPrint extends PDF_JavaScript{

	function AutoPrint($dialog=false){
		$param=($dialog ? 'true' : 'fasle');
		$script="print($param);";
		$this->IncludeJS($script);
	}
	
	function AutoPrintToPrinter($server, $printer, $dialog=false){
		$script= "var pp = getPrintParams();";
		if($dialog){
			$script .="pp.interactive = pp.constants.interactionLevel.full;";	
		}else{
			$script .="pp.interactive = pp.constants.interactionLevel.automatic;";		
		}
		$script .="pp.printerName = '\\\\\\\\".$server."\\\\".$printer.";";
		$script .="print(pp);";
		$this->IncludeJS($script);
	}
}

$pdf= new PDF_AutoPrint();
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->Text(90,50,'Print me!');
$pdf->AutoPrint(false);
$pdf->Close();
?>