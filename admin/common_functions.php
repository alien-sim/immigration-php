<?php
    include_once './config.php';

    function get_timestamp(){
        $date = new DateTime();
		$ts = $date->getTimestamp();
        return $ts;
    }
    
    function get_country_name($country_id){
        $sql = "select country_name from countries where id='".$country_id."'";
        $result = mysqli_query($GLOBALS['db'], $sql);
        $country   = mysqli_fetch_array($result);
        return $country[0];
    }

    function get_google_map_canvas($address){
        
        $data_arr = geocode($address);
        if($data_arr){
         
            $latitude = $data_arr[0];
            $longitude = $data_arr[1];
            $formatted_address = $data_arr[2];

            ?>
            
                <!-- JavaScript to show google map -->
                <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=<?php echo $GLOBALS['api_key'] ?>"></script>   
                <script type="text/javascript">
                    function init_map() {
                        var myOptions = {
                            zoom: 14,
                            center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
                        });
                        infowindow = new google.maps.InfoWindow({
                            content: "<?php echo $formatted_address; ?>"
                        });
                        google.maps.event.addListener(marker, "click", function () {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                </script>
            
            <?php
        }
    }

    function geocode($address){
        
        // url encode the address
        $address = urlencode($address);
         
        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$GLOBALS['api_key']}";
     
        // get the json response
        $resp_json = file_get_contents($url);
         
        // decode the json
        $resp = json_decode($resp_json, true);
     
        // response status will be 'OK', if able to geocode given address 
        if($resp['status']=='OK'){
     
            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
             
            // verify if data is complete
            if($lati && $longi && $formatted_address){
             
                // put the data in the array
                $data_arr = array();            
                array_push(
                    $data_arr, 
                        $lati, 
                        $longi, 
                        $formatted_address
                    );
                 
                return $data_arr;
                 
            }else{
                return false;
            }
             
        }
        else{
            // echo "<strong>ERROR: {$resp['status']}</strong>";
            echo "<script>console.log({$resp_json})</script>";
            return false;
        }
    }
?>