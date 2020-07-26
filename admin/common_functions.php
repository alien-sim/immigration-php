<?php
    include_once './config.php';

    function get_timestamp(){
        $date = new DateTime();
		$ts = $date->getTimestamp();
        return $ts;
    }
    
    function get_country_name($country_id, $currency=false){
        $sql = "select country_name, currency_symbol from countries where id='".$country_id."'";
        $result = mysqli_query($GLOBALS['db'], $sql);
        $country   = mysqli_fetch_array($result);
        if($currency){
            return [$country[0], $country[1]];
        }
        return $country[0];
    }

    function get_countries(){
        $countries = array();
        $country = "SELECT id, country_name from `countries`";
        $country_result = $GLOBALS['db']->query($country);
        while($country_row = mysqli_fetch_array($country_result)){
            $countries[] = $country_row;
        }
        return $countries;
    }

    function get_date_format($date_obj){
        $date = new DateTime($date_obj) ;
        return $date->format('M d, Y');
    }

    function get_agent_email($agent_id){
        $sql = "select email from admin where id=".$agent_id;
        $result = $GLOBALS['db']->query($sql);
        $agent = mysqli_fetch_array($result);

        return $agent[0];
    }

    function get_program($program_id){
        
        $sql = "select program_name, school_id from programs where id=".$program_id;
        $result = $GLOBALS['db'] -> query($sql);
        $program = mysqli_fetch_array($result);
        return $program;
    }

    function get_school($school_id){
        $sql = "select school_name from schools where id=".$school_id;
        $result = $GLOBALS['db'] -> query($sql);
        $school = mysqli_fetch_array($result);
        return $school[0];
    }

    function get_student_programs($student_id, $return_query=false){
        $program_array = [];
        $student_sql = "select * from student s left join exam_details e on s.exam_type_id = e.id where s.id=".$student_id;
        $student_result = $GLOBALS['db']->query($student_sql);
        $student = mysqli_fetch_array($student_result);

        $program_sql = "select  p.*, s.id as sid, s.school_name, s.school_logo, s.city, s.country, c.country_name, c.country_currency, c.currency_symbol  from programs p
                        inner join schools s on p.school_id = s.id 
                        inner join countries c on s.country = c.id
                        where
                            case 
                                when exam_type = 'duolingo'
                                    then total_score <= ".$student['score']."
                                else 
                                    exam_type = '".$student['exam_type_name']."' and
                                    speaking <= ".$student['speaking']." and 
                                    listening <= ".$student['listening']." and 
                                    writing <= ".$student['writing']." and
                                    reading <= ".$student['reading']."
                            end";
        if($return_query){
            return $program_sql;
        }
        $program_result = $GLOBALS['db']->query($program_sql);
        while($programs = $program_result->fetch_assoc()){
            array_push($program_array, $programs);
        }
        return $program_array;

    }

    function get_program_levels(){
        $level_array = [];
        $sql = "select * from program_levels order by show_order";
        $result = $GLOBALS['db']->query($sql);
        while($level = $result->fetch_assoc()){
            array_push($level_array, $level);
        }
        return $level_array;

    }

    function get_education_level($level, $field){
        $level = mysqli_real_escape_string($GLOBALS['db'],$level);
        $sql = "select ".$field." from program_levels where level = '".$level."'";
        // echo $sql;
        $result = $GLOBALS['db'] -> query($sql);
        $level = mysqli_fetch_array($result);
        return $level[0];

    }

    function get_student_application_details($student_id){
        $sql = "select 
        count(id) as added, 
        (select count(id) from applications where student_id=".$student_id." and applied=1) as applied, 
        (select count(id) from applications where student_id=".$student_id." and submitted=1) as submitted,
        (select count(id) from applications where student_id=".$student_id." and status='cancelled') as cancelled,
        (select count(id) from applications where student_id=".$student_id." and status='accepted') as accepted
    from applications where student_id=".$student_id;
        $result = $GLOBALS['db']->query($sql);
        $applications = mysqli_fetch_array($result);

        return $applications;
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