<?php	
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['RegistroPrestamo']==0)
		header('Location: ../menu.php');
	
	include('PrestamoEnPDF.php');
	
	$idCaja = $_GET['idcaja'];
	$Estante = $_GET['estante'];
	$Fila = $_GET['fila'];
	$Ubicacion = $_GET['ubicacion'];
	$Fprestamo = $_GET['fprestamo'];
	$Festimada = $_GET['festimada'];
	$Observacion = $_GET['observacion'];
	$Responsable = $_GET['responsable'];
	
	list($ano,$mes,$resto1) = explode('-',$Fprestamo);
	list($resto2,$minuto,$segundo) = explode(':',$resto1);
	list($dia,$hora) = explode(' ',$resto2);
	$Fprestamo = $dia.'-'.$mes.'-'.$ano.'   '.$hora.':'.$minuto;
	list($ano,$mes,$resto1) = explode('-',$Festimada);
	list($resto2,$minuto,$segundo) = explode(':',$resto1);
	list($dia,$hora) = explode(' ',$resto2);
	$Festimada = $dia.'-'.$mes.'-'.$ano.'  /  '.$hora.':'.$minuto;
	$pdf = new PDF('L','mm','letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Descripcion($Fprestamo);
	$pdf->Informacion($idCaja,$Estante,$Fila,$Ubicacion,$Festimada,$Observacion,$Responsable);
	$pdf->Output();
?>