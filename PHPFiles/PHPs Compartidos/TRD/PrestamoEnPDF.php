<?php
	require('../../../FPDF/fpdf.php');
	include('ConsultaPDF.php');
	class PDF extends FPDF{
		// cabecera
		function header(){
			$this->Image('../../../Imagenes/Kialogo2.png',14,8,20);                            // Logo
			$this->SetFont('Arial','B',16);                                           // Fuente arial
			$this->Cell(115);                                                         // Movernos a la derecha
			$this->Cell(30,10,'Reporte de Prestamo',0,0,'C');                         // Título
			$this->Ln(20);                                                            // Salto de línea
		}
		// pie de pagina
		function footer(){	    
			$this->SetY(-15);                                                         // Posición: a 1,5 cm del final 
			$this->SetFont('Arial','I',8);                                            // Arial italic 8
			$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');              // Número de página
		}
		function Descripcion($Fprestamo){
			$datos = Consulta3();
			// Colores, ancho de línea y fuente 
			$this->SetFillColor(255,255,255);
			$this->SetTextColor(51,51,51);
			$this->SetDrawColor(0,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('courier','','12');
			
			// construimos la tabla
			$this->SetLeftMargin(20);
			$this->Cell(37,8,'Usuario:',1,0,'L',false);
			$this->Cell(80,8,$datos['nombre'].' '.$datos['apellido'],1,0,'L',false);
			$this->Cell(67,8,'Fecha de Prestamo:',1,0,'L',false);
			$this->Cell(56,8,$Fprestamo,1,0,'C',false);
			$this->Ln();
			$this->Cell(37,8,'Departamento:',1,0,'L',false);
			$this->Cell(74,8,$datos['Depa'],1,0,'L',false);
			$this->Cell(55,8,'Oficina productora:',1,0,'L',false);
			$this->Cell(74,8,$datos['Depe'],1,0,'L',false);
			$this->SetLeftMargin(14);
			$this->Ln(16);
		}
		function Informacion($idCaja,$Estante,$Fila,$Ubicacion,$Festimada,$Observacion,$Responsable){
			$this->Ln(10);
			$this->SetLeftMargin(30);
			$this->Cell(19,5,'ID Caja','B',0,'L',true);
			$this->Cell(20,5,': '.$idCaja,0,0,'L',true);
			$this->Ln(8);
			$this->Cell(19,5,'Estante','B',0,'L',true);
			$this->Cell(20,5,': '.$Estante,0,0,'L',true);
			$this->Ln(8);
			$this->Cell(12,5,'Fila','B',0,'L',true);
			$this->Cell(20,5,': '.$Fila,0,0,'L',true);
			$this->Ln(8);
			$this->Cell(24,5,'Ubicacion','B',0,'L',true);
			$this->Cell(20,5,': '.$Ubicacion,0,0,'L',true);
			$this->Ln(8);
			$this->Cell(82,5,'Fecha y hora estimada de entrega','B',0,'L',true);
			$this->Cell(30,5,': '.$Festimada,0,0,'L',true);
			$this->Ln(8);
			$this->Cell(47,5,'Persona que recibe','B',0,'L',true);
			$this->Cell(20,5,': '.$Responsable,0,0,'L',true);
			$this->Ln(8);
			$this->Cell(29,5,'Observacion','B',0,'L',true);
			$this->Cell(80,5,': '.$Observacion,0,0,'L',true);
			$this->Ln(20);
			$this->setX(20);
			$this->Cell(140,5,'Yo ______________________________, portador de la C.I. Nº _____________, me hago responsable',0,0,'L',true); 
			$this->Ln(8);
			$this->setX(20);
			$this->Cell(140,5,'de la caja y su contenido, asi mismo me comprometo a entregarla en la fecha y hora acordada.',0,0,'L',true);
			$this->Ln(30);
			$this->SetLeftMargin(70);
			$this->Cell(50,5,'                    ','B',0,true);
			$this->setX(160);
			$this->Cell(50,5,'                    ','B',0,true);
			$this->Ln(7);
			$this->Cell(50,5,'Firma',0,0,'C',true);
			$this->setX(160);
			$this->Cell(50,5,'Firma',0,0,'C',true);
			$this->Ln(7);
			$this->Cell(50,5,'(Persona que entrega)',0,0,'C',true);
			$this->setX(160);
			$this->Cell(50,5,'(Persona que recibe)',0,0,'C',true);
		}
	}
?>