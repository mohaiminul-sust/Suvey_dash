<?php 

class Utils{

	public static function getAccordianId($type, $iter){
		if($type=='mcq'){
			echo "accordion1_".$iter;
		}else if($type=='written'){
			echo "#";
		}
	}

	public static function getAccordianClass($type){
		
		if($type=='mcq'){
			echo "panel-collapse collapse-in";
		}else if($type=='written'){
			echo "panel-collapse collapse";
		}
	} 
}