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

	//Works for googles reverse-geocoding
	public static function getAddressFromCoordinates($lat, $lon) {

		try {
			$response = Geocode::make()->latLng($lat,$lon);
		
			if ($response) {
			    // echo $response->latitude();
			    // echo $response->longitude();
			    echo $response->formattedAddress();
			    // echo $response->locationType();
			}
		} catch (Exception $e) {
			
			echo "Decoding error!";
		}

	}


	public static function getTimeFromMilis($mil){

		$seconds = $mil / 1000;
		echo date("H:i:s", $seconds);

	} 
		
}