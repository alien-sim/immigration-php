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
        $id_vars = '(';
        $id_sql = "select ped.program_id as `ids` from program_exam_details ped
            inner join student s on ped.exam_type = s.exam_type_name
            inner join exam_details ed on s.id = ed.student_id
            where 
                ed.student_id = ".$student_id." and
                ed.reading >= ped.reading and 
                ed.speaking >= ped.speaking and 
                ed.writing  >= ped.writing and 
                ed.listening >= ped.listening ";
        $id_result = $GLOBALS['db']->query($id_sql);
        // echo $id_sql;
        while($program_ids = $id_result->fetch_assoc()){
            $id_vars .= $program_ids['ids'].",";
        } 
        $id_vars = rtrim($id_vars, ",");
        $id_vars = $id_vars.")";

        $program_sql = "select 
                p.id, p.program_name, p.tution_fee, p.application_fee, p.cost_of_living, p.program_level,
                sc.id as `sid` , sc.school_name, sc.school_logo, sc.city, sc.state, sc.country,
                c.country_currency, c.currency_symbol, c.country_name
            from programs p
            left join schools sc on p.school_id = sc.id 
            inner join countries c on sc.country = c.id
            where p.id in".$id_vars;

        // echo $program_sql;
        if($return_query){
            // echo $program_sql;
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

    function get_map_link($post_map){
        $start = strpos($post_map, '"');
		$end = strpos($post_map, '" wid');
        $length = $end-($start+1);
        
		if ($start && $end && $length != -1){
			$map = substr($post_map, $start+1, $length);
		}else{
			$map = $post_map;
        }
        
        return $map;
    }

    function intake_for_programs(){
                 
        $intake_months = ['Jan', 'Mar', 'May', 'Jul', 'Sept', 'Nov'];
        $current_month = date('m');
        $current_year = date('Y');
        $next_year = $current_year + 1;
        if($current_month > 1){
            foreach($intake_months as $key => $month){
                
            }
        }
                
    }
?>