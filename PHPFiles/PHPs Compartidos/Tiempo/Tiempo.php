<?php
class Tiempo{
	function __construct(){
		$this->fecha = time()-16200;
		$this->horas = date('H',$this->fecha);
		$this->minutos = date('i',$this->fecha);
	}
	function Hora($num,$clase){
		print '<select name="hora" class="'.$clase.'" id="hora'.$num.'">';
		for($h=0;$h<=23;$h++){
			if($h<10)
				$hh = "0" . $h;
			else
				$hh = $h;
		print "<option value='$hh'";
		if($this->horas==$hh)
			print ' selected="selected">'.$hh.'</option>';
		else
			print '>'.$hh.'</option>';
		}
		print '</select>';
	}
	function Minuto($num,$clase){
		print '<select name="minuto" class="'.$clase.'" id="minuto'.$num.'">';
		for($m=0;$m<=59;$m++){
			if($m<10)
				$mm = "0" . $m;
			else
				$mm = $m;
			print "<option value='$mm'";
			if($this->minutos==$mm)
				print ' selected="selected">'.$mm.'</option>';
			else
				print '>'.$mm.'</option>';
		}
		print '</select>';
	}	
}
?>