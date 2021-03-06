<?php

require_once(app_path().'/library/OAuth.php');

class YelpAPI{

/** 
 * Makes a request to the Yelp API and returns the response
 * 
 * @param    $host    The domain host of the API 
 * @param    $path    The path of the APi after the domain
 * @return   The JSON response from the request      
 */
function request($host, $path) {
    $unsigned_url = "http://" . $host . $path;

    // Token object built using the OAuth library
    $token = new OAuthToken(YelpConstants::$TOKEN, YelpConstants::$TOKEN_SECRET);

    // Consumer object built using the OAuth library
    $consumer = new OAuthConsumer(YelpConstants::$CONSUMER_KEY, YelpConstants::$CONSUMER_SECRET);

    // Yelp uses HMAC SHA1 encoding
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

    $oauthrequest = OAuthRequest::from_consumer_and_token(
        $consumer, 
        $token, 
        'GET', 
        $unsigned_url
    );
    
    // Sign the request
    $oauthrequest->sign_request($signature_method, $consumer, $token);
    
    // Get the signed URL
    $signed_url = $oauthrequest->to_url();
    
    // Send Yelp API Call
    $ch = curl_init($signed_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
}

/**
 * Query the Search API by a search term and location 
 * 
 * @param    $term        The search term passed to the API 
 * @param    $location    The search location passed to the API 
 * @return   The JSON response from the request 
 */
function search($term, $location,$ccl=null,$sort = null , $radius_filter =null) {
    $url_params = array();
    
    $url_params['term'] = $term ?: YelpConstants::$DEFAULT_TERM;
    $url_params['location'] = $location?: YelpConstants::$DEFAULT_LOCATION;
    
    if($ccl != null){
        $url_params['cll'] = $ccl;
    }

    if($sort !=null){
         $url_params['sort'] = $sort;
    }

    if($radius_filter != null){
         $url_params['radius_filter'] = $radius_filter;
    }

    $url_params['limit'] = 20;
    $search_path = YelpConstants::$SEARCH_PATH. "?" . http_build_query($url_params);
    
    return $this->request(YelpConstants::$API_HOST, $search_path);
}

/**
 * Query the Business API by business_id
 * 
 * @param    $business_id    The ID of the business to query
 * @return   The JSON response from the request 
 */
function get_business($business_id) {
    $business_path = YelpConstants::$BUSINESS_PATH . $business_id;
    
    return $this->request(YelpConstants::$API_HOST, $business_path);
}

/**
 * Queries the API by the input values from the user 
 * 
 * @param    $term        The search term to query
 * @param    $location    The location of the business to query
 */
function query_api($term, $location,$ccl = null,$sort = null , $radius_filter =null) {     
    if($ccl != null){
       return $response = json_decode($this->search($term, $location,$ccl ,$sort ,$radius_filter),true);
    }else
        return $response = json_decode($this->search($term, $location));
  //  $business_id = $response->businesses[0]->id;

  
    
  //  $response = $this->get_business($business_id);
    
    //print sprintf("Result for business \"%s\" found:\n", $business_id);
    // print "$response\n";
}



}

?>