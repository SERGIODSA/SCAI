<?php
	require('../../../FPDF/fpdf.php');
	include('ConsultaPDF.php');
	class PDF extends FPDF{
		// cabecera
		function header(){
			$this->Image('../../../Imagenes/Kialogo2.png',14,8,20);                   // Logo
			$this->SetFont('Arial','B',16);                                           // Fuente arial
			$this->Cell(115);                                                         // Movernos a la derecha
			$this->Cell(30,10,'Tabla de Retencion Documental (TRD)',0,0,'C');         // Título
			$this->Ln(20);                                                            // Salto de línea
		}
		// pie de pagina
		function footer(){	    
			$this->SetY(-15);                                                         // Posición: a 1,5 cm del final 
			$this->SetFont('Arial','I',8);                                            // Arial italic 8
			$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');              // Número de página
		}
		function Descripcion($idCaja,$Fechatran){
			$datos1 = Consulta1($idCaja);
			$datos2 = Consulta2($idCaja);
			// Colores, ancho de línea y fuente 
			$this->SetFillColor(255,255,255);
			$this->SetTextColor(51,51,51);
			$this->SetDrawColor(0,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('courier','','12');
			
			// construimos la tabla
			$this->SetLeftMargin(20);
			$this->Cell(37,8,'Responsable:',1,0,'L',false);
			$this->Cell(80,8,$datos2['nombre'].' '.$datos2['apellido'],1,0,'L',false);
			$this->Cell(67,8,'Fecha de Transferencia:',1,0,'L',false);
			$this->Cell(56,8,$Fechatran,1,0,'C',false);
			$this->Ln();
			$this->Cell(37,8,'Departamento:',1,0,'L',false);
			$this->Cell(74,8,$datos2['Depa'],1,0,'L',false);
			$this->Cell(55,8,'Oficina productora:',1,0,'L',false);
			$this->Cell(74,8,$datos2['Depe'],1,0,'L',false);
			$this->SetLeftMargin(14);
			$this->Ln();
			$this->Ln();
		}
		function TRDCabeza(){
			$this->SetFont('courier','','9');
			$this->SetLeftMargin(14);
			$this->Cell(17,6,'Cod.','LRT',0,'C',false);
			$this->Cell(34,6,'Nº Serie.',1,0,'C',false);
			$this->Cell(61,6,'Serie','LRT',0,'C',false);
			$this->Cell(44,6,'Fechas Extremas',1,0,'C',false);
			$this->Cell(28,6,'Valor','LRT',0,'C',false);
			$this->Cell(32,6,'Retencion',1,0,'C',false);
			$this->Cell(35,6,'Ubicacion',1,0,'C',false);
			$this->Ln();
			$this->Cell(17,6,'Carp.','LRB',0,'C',false);
			$this->Cell(17,6,'Inf.',1,0,'C',false);
			$this->Cell(17,6,'Sup.',1,0,'C',false);
			$this->Cell(61,6,'Documental','LRB',0,'C',false);
			$this->Cell(22,6,'Inicial',1,0,'C',false);
			$this->Cell(22,6,'Final',1,0,'C',false);
			$this->Cell(28,6,'Documental','LRB',0,'C',false);
			$this->Cell(10,6,'Años',1,0,'C',false);
			$this->Cell(22,6,'Fecha Dest.',1,0,'C',false);
			$this->Cell(15,6,'Estante',1,0,'C',false);
			$this->Cell(10,6,'Fila',1,0,'C',false);
			$this->Cell(10,6,'Caja',1,0,'C',false);
			$this->Ln();
		}
		function TRDCuerpo($idCaja){
			$datos1 = Consulta1($idCaja);
			$datos2 = Consulta2($idCaja);
			$n = sizeof($datos1['Serie']);
			for($i=0;$i<$n;$i++){
				$this->Cell(17,12,$datos1['idCarpeta'][$i],1,0,'C',false);
				$this->Cell(17,12,$datos1['nSerieInf'][$i],1,0,'C',false);
				$this->Cell(17,12,$datos1['nSerieSup'][$i],1,0,'C',false);
				$this->Cell(61,12,$datos1['Serie'][$i],1,0,'C',false);
				$this->Cell(22,12,$datos1['Fecha_Ini'][$i],1,0,'C',false);
				$this->Cell(22,12,$datos1['Fecha_Fin'][$i],1,0,'C',false);
				$this->Cell(28,12,$datos2['Valor'],1,0,'C',false);
				$this->Cell(10,12,$datos2['Anos'],1,0,'C',false);
				$this->Cell(22,12,$datos1['FechaMaxRet'][$i],1,0,'C',false);
				$this->Cell(15,12,$datos2['Estante'],1,0,'C',false);
				$this->Cell(10,12,$datos2['Fila'],1,0,'C',false);
				$this->Cell(10,12,$datos2['idCaja'],1,0,'C',false);
				$this->Ln();
			}
		}	
	}
?>