<?php
	class tipo{
		function CargaTipo($estilo){
			print '<select name="tipo" class="'.$estilo.'" id="tipo">
				<option value="0" selected>...</option>';
			$n=1;
			$sql = "SELECT idTipoCarpeta,Descripcion FROM tipocarpeta";
			$query = mysql_query($sql);   		
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					print '<option value='.$row['idTipoCarpeta'].'>'.$row['Descripcion'].'</option>';
					$n++;
				}
			}
			print '</select>';
		}
		function ModificarTipo($estilo,$valor){
			print '<select name="tipo" class="'.$estilo.'" id="tipo">';
			$n=1;
			$sql = "SELECT idTipoCarpeta,Descripcion FROM tipocarpeta";
			$query = mysql_query($sql);   		
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					if($valor==$row['idTipoCarpeta'])
						print '<option value='.$row['idTipoCarpeta'].' selected>'.$row['Descripcion'].'</option>';
					else
						print '<option value='.$row['idTipoCarpeta'].'>'.$row['Descripcion'].'</option>';
					$n++;
				}
			}
			print '</select>';
		}
	}
?>