<?php
	include_once './config.php';
    include_once './common_functions.php' ;
    
    if(isset($_POST['filter_search'])){
        $program_html = '';
        $school_html = '';
        $school_type = $_POST['school_type'];
        $tution_fee  = $_POST['tution_fee'];
        $application_fee = $_POST['application_fee'];
        $country     = (isset($_POST['country'])) ?  $_POST['country'] : array();
        $city        = (isset($_POST['city'])) ?  $_POST['city'] : array();
        $program_level =(isset($_POST['program_level'])) ?  $_POST['program_level'] : array();
        $work_permit = ($_POST['work_permit'] == 'false') ? false : true;
        
        // Type of school
        $where_statement = '';
        if($school_type != ''){
            $where_statement = ' where ';
            $where_statement .= $school_type;
        }
        // Tution fee
        if($tution_fee != 0){
            if(!(empty($where_statement))){
                $where_statement .= ' OR ';
            }else{
                $where_statement = ' where ';
            }
            $tution_fee = $tution_fee*1000;
            $where_statement .= ' p.tution_fee < '. $tution_fee;
        }
        // Application fee
        if($application_fee != 0){
            if(!(empty($where_statement))){
                $where_statement .= ' OR ';
            }else{
                $where_statement = ' where ';
            }
            $application_fee = $application_fee*1000;
            $where_statement .= ' p.application_fee < '. $application_fee;
        }
        // Country
        if(count($country)){
            if(!(empty($where_statement))){
                $where_statement .= ' OR ';
            }else{
                $where_statement = ' where ';
            }
            $where_statement .= ' s.country in (';
            foreach($country as $c){
                $where_statement .= $c.",";
            } 
            $where_statement = rtrim($where_statement, ",");
            $where_statement .= ')';
        }
        // City
        if(count($city)){
            if(!(empty($where_statement))){
                $where_statement .= ' OR ';
            }else{
                $where_statement = ' where ';
            }
            $where_statement .= ' LOWER(s.city) in (';
            foreach($city as $c){
                $where_statement .= "LOWER('".$c."'),";
            } 
            $where_statement = rtrim($where_statement, ",");
            $where_statement .= ')';
        }

        //Program Level
        if(count($program_level)){
            if(!(empty($where_statement))){
                $where_statement .= ' OR ';
            }else{
                $where_statement = ' where ';
            }
            $where_statement .= ' LOWER(p.program_level) in (';
            foreach($program_level as $p){
                $where_statement .= "LOWER('".$p."'),";
            } 
            $where_statement = rtrim($where_statement, ",");
            $where_statement .= ')';
        }

        // Work permit feature
        if($work_permit){
            if(!(empty($where_statement))){
                $where_statement .= ' OR ';
            }else{
                $where_statement = ' where ';
            }
            $where_statement .= ' f.work_permit = 1 ';
        }

        $all_programs = "select p.*, s.school_name as school_name, s.id as s_id, c.country_name, c.country_currency, c.currency_symbol from programs p
                    LEFT JOIN schools s
                    on p.school_id = s.id
                    left join 
                    features f 
                    on s.features = f.id
                    left join countries c on s.country = c.id".$where_statement."
                    order by school_name asc";

        $program_html .= "<div class='d-none'>".$all_programs."</div>";
        $program_result = $db->query($all_programs);
        while($program_row = $program_result->fetch_assoc()){

            $program_html .= '<div class="bg-light w-100 program-search-card p-3 mb-3">';
            $program_html .= '<h6 class="program-heading-search mb-2">';
            $program_html .= '<a href="program_detail.php?id= '.$program_row['id'].'" target="_blank">'. $program_row['program_name'] .'</a>';
            $program_html .= '</h6>'; 
            $program_html .= '<a href="school_detail.php?id='. $program_row['s_id'].'" target="_blank"><label><i class="fa fa-map-marker"></i> '.$program_row['school_name'].' - '.strtoupper($program_row['country_name']).'</label></a>';
            $program_html .= '<table class="mt-3">';
            $program_html .= '<tr>';
            $program_html .= '<td width="25%">';
            $program_html .= 'TUTION FEE<br>';
            $program_html .= $program_row['currency_symbol']." ".number_format($program_row['tution_fee'],2)." ".$program_row['country_currency'];
            $program_html .= '</td>';
            $program_html .= '<td width="25%">';
            $program_html .= 'APPLIACTION FEE<br>';
            $program_html .= $program_row['currency_symbol']." ".number_format($program_row['application_fee'],2)." ".$program_row['country_currency'];
            $program_html .= '</td>';
            $program_html .= '<td width="25%">';
            $program_html .= 'PROGRAM LEVEL<br>';
            $program_html .= $program_row['program_level'];
            $program_html .= '</td>';
            $program_html .= '</tr>';
            $program_html .= '</table>';
            $program_html .= '</div>';
        }

        $all_schools = "select distinct s.id, s.school_name, s.school_logo, c.country_name from schools s
            left join programs p on s.id = p.school_id
            inner join countries c on s.country = c.id 
            inner join features f on s.features = f.id
            ".$where_statement;
        
        $school_html .= "<div class='d-none'>".$all_schools."</div>";
        $school_result = $db->query($all_schools);
        while($school_row = $school_result->fetch_assoc()){
            $school_html .= '<div class="col-md-6" style="margin-bottom:30px">';
            $school_html .= '<div class="col-md-12 border d-flex">';
            $school_html .= '<div class="row py-3">';
            $school_html .= '<div class="col-md-3 search-school-logo d-flex">';
            $school_html .= '<img class="my-auto" src="../media/logos/'.$school_row['school_logo'].'">';
            $school_html .= '</div>';
            $school_html .= '<div class="col-md-9 d-flex">';
            $school_html .= '<div class="w-100 my-auto">';
            $school_html .= '<h6 style="font-size:18px"><a href="school_detail.php?id='.$school_row['id'].'" target="_blank">'.$school_row['school_name'].'</a></h6>';
            $school_html .= '<h6 style="font-size:14px">- '.$school_row['country_name'].'</h6>';
            $school_html .= '</div>';
            $school_html .= '</div>';
            $school_html .= '</div>';
            $school_html .= '</div>';
            $school_html .= '</div>';
        }
        header('Content-Type: application/json');
        echo json_encode(array('programs' => $program_html, 'schools' => $school_html));
        exit;
    }
?>