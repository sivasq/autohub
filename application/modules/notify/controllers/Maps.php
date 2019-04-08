<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends MY_Controller {

	function __construct()
	{
		parent::__construct();		
	}


	public function calc_distance($lat1, $lon1, $lat2, $lon2, $unit)
	{
	  	$theta = $lon1 - $lon2;

	  	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

	  	$dist = acos($dist);

	  	$dist = rad2deg($dist);

	  	$miles = $dist * 60 * 1.1515;
	
	  	$feet = $miles * 5280;

	  	$yards = $feet / 3;

	  	$unit = strtoupper($unit);
	
	  	if ($unit == "K")
	  	{
	    	return ($miles * 1.609344); // Kilometer

	  	}elseif($unit == "N"){

	    	return ($miles * 0.8684); 

	  	}elseif($unit == "ME"){

	    	return round($miles * 1609); // Meters
	  		// return $meters = round($kilometers * 1000);

	  	}elseif($unit == "FT"){

	    	return round($miles * 5280); // Feets	  	

	  	}elseif ($unit == "YD"){

	  		return round($miles * 5280)/3;	//Yards   	

	  	}else{

	  		return $miles;		  
	  	}
	}

	function IsNullOrEmptyString($question)
    {
        return (!isset($question) || trim($question)===''); 
    }

	public function find_addres1($latitude, $longitude)
    {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&token=AIzaSyAOVG0ZCVPWXEjhEp6L4CvD-TIdxdmi6NY";
 
        $response = @file_get_contents($url);
        
        $data = json_decode($response); //set json response to array based
        
        $address_arr = $data->results[0]->address_components;
        
        $address = "";
        
        foreach ($address_arr as $arr1){
        
            if(strcmp($arr1->types[0],"street_number") == 0)
            {
                $address .= $arr1->long_name." ";
                continue;
            }
            
            if(strcmp($arr1->types[0],"route") == 0)
            {     
                $address .= $arr1->long_name;
                continue;
            }
        
            if(strcmp($arr1->types[0],"locality") == 0)
            {         
                $city = $arr1->long_name;
                continue;
            }
             
            if(strcmp($arr1->types[0],"administrative_area_level_1") == 0)
            {         
                $state = $arr1->long_name;
                continue;         
            }
        
            if(strcmp($arr1->types[0],"administrative_area_level_2") == 0)
            {
                $state2 = $arr1->long_name;
                continue;
            }
        
            if(strcmp($arr1->types[0],"postal_code") == 0)
            {
                $zip_code = $arr1->long_name; 
                continue; 
            }
        
            if(strcmp($arr1->types[0],"country") == 0)
            { 
                $country = $arr1->long_name; 
                continue; 
            }
        
        }
                
        if(!$this->IsNullOrEmptyString($state))
        { 
            $response = array("address"=>$address, "city"=>$city, "state"=>$state, "zipcode"=>$zip_code, "country"=>$country); //level_1 administrative data exist 
        }else{
 
            $response = array("address"=>$address, "city"=>$city, "state"=>$state2, "zipcode"=>$zip_code, "country"=>$country); //level_1 administrative data not exist 
        }
 
        return $response;
    }

    public function find_addres($latitude, $longitude)
    {
        // $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false";
        
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&token=AIzaSyAOVG0ZCVPWXEjhEp6L4CvD-TIdxdmi6NY";

        $response = @file_get_contents($url);

        $data = json_decode($response);

        $status = $data->status;    
        
        if($status == "OK")
        {
            return $address = $data->results[0]->formatted_address;
        }
        else
        {
            return "No Data Found Try Again";
        }
    }

    public function find_coordinates($address)
    {       
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";

        $response = @file_get_contents($url);

       	$data = json_decode($response);

        $status = $data->status;    
        
        if($status == "OK")
        {
           	return array('latitude' => $data->results[0]->geometry->location->lat, 'longitude' => $data->results[0]->geometry->location->lng);  			
        }
        else
        {
            return "No Data Found Try Again";
        }
    }

}