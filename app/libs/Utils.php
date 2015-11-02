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

		$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false";

		// Make the HTTP request
		$data = @file_get_contents($url);
		// Parse the json response
		$jsondata = json_decode($data,true);

		// If the json data is invalid, return empty array
		// if (!check_status($jsondata))   return array();

		$address = array(
		    'country' => google_getCountry($jsondata),
		    'province' => google_getProvince($jsondata),
		    'city' => google_getCity($jsondata),
		    'street' => google_getStreet($jsondata),
		    'postal_code' => google_getPostalCode($jsondata),
		    'country_code' => google_getCountryCode($jsondata),
		    'formatted_address' => google_getAddress($jsondata),
		);

		return $address['city'].' ,'.$address['country'];
	}

		
}