<?php
	class Valor{
		function __construct(){
			$this->Cont = "'retencion'"; 
		}
		function CargaValores($estilo){
			$Url = "'../Registrar TRD/BuscarRetencion.php'";
			print '<select name="valores" class="'.$estilo.'" id="valores" onchange="AnosRet('.$Url.','.$this->Cont.');">
				<option value="0" selected>...</option>';
			$sql = "SELECT idValorDoc,Descripcion FROM valordoc";
			$query = mysql_query($sql);   		
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					print '<option value='.$row['idValorDoc'].'>'.$row['Descripcion'].'</option>';
				}
			}
			print '</select>';
		}
		function DesabValores($estilo){
			print '<select name="valores" class="'.$estilo.'" id="valores" disabled="disabled">
				<option value="0" selected>...</option>';
			$sql = "SELECT idValorDoc,Descripcion FROM valordoc";
			$query = mysql_query($sql);   		
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					print '<option value='.$row['idValorDoc'].'>'.$row['Descripcion'].'</option>';
				}
			}
			print '</select>';
		}
		function ModificarValores($estilo,$idValor,$Fmro){
			$Url = "'../Modificar TRD/BuscarRetencion.php'";
			print '<select name="anosret" class="'.$estilo.'" id="anosret" onchange="AnosRet2('.$Url.','.$this->Cont.','.$idValor.','.$Fmro.');">
					<option value="0">...</option>';
			$sql = "SELECT idValorDoc,Anos_Ret,Descripcion FROM valordoc";
			$query = mysql_query($sql);   		
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					if($idValor==$row['idValorDoc']){
						print '<option value="'.$row['idValorDoc'].'-'.$row['Anos_Ret'].'" selected>'.$row['Descripcion'].'</option>';
					}
					else{
						print '<option value="'.$row['idValorDoc'].'-'.$row['Anos_Ret'].'">'.$row['Descripcion'].'</option>';
					}
				}
			}
			print '</select>';
		}
		function ModificarValores2($estilo,$idValor,$Fmro){
			print '<select name="valores" class="'.$estilo.'" id="valores" onchange="AnosRet2('.$Url.','.$this->Cont.','.$idValor.','.$Fmro.');">
					<option value="0">...</option>';
			$sql = "SELECT idValorDoc,Anos_Ret,Descripcion FROM valordoc";
			$query = mysql_query($sql);   		
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					print '<option value="'.$row['idValorDoc'].'-'.$row['Anos_Ret'].'">'.$row['Descripcion'].'</option>';
				}
			}
			print '</select>';
		}
		function ConservarValores($estilo){
			$Url = "'../Desincorporar/BuscarRetencion.php'";
			print '<select name="valores" class="'.$estilo.'" id="valores" onchange="AnosRet('.$Url.','.$this->Cont.');">
					<option value="0">...</option>';
			$sql = "SELECT idValorDoc,Anos_Ret,Descripcion FROM valordoc";
			$query = mysql_query($sql);   		
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					print '<option value="'.$row['idValorDoc'].'-'.$row['Anos_Ret'].'">'.$row['Descripcion'].'</option>';
				}
			}
			print '</select>';
		}
	}
?>