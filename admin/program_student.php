<?php
session_start();
unset($_SESSION['program_student'] );
echo $_POST['program_id'];
    $_SESSION['program_student'] = $_POST['program_id'];
?>

$("#nav-program-search ").on("click", ".program-search-card button", function(){
      var program_id = $(this).attr("attr");
      // $("#selectStudentModal input#program_id").val(program_id);
      // var args = {
      //   "filter_student":1,
      //   "program_id":program_id
      // }
      // $.ajax({
      //   url: "ajax_functions.php",
      //   type: 'post',
      //   data: args,
      //   success: function(result){
      //       console.log("result", result);
            
      //   },
      //   error: function(error){
      //     console.log("error in fetching student -- ", error);
      //   }
      // })
    });

    if(isset($_POST['filter_student'])){
        
        $all_students = '<select class="custom-select input-style" name="student_id" required>';
        $all_students += '<option hidden disabled selected value="">Select..</option>';

        $program_id = $_POST['program_id'];
        $sql = "select s.id, s.first_name, s.last_name from student s 
            inner join program_exam_details ped on s.exam_type_name = ped.exam_type 
            inner join exam_details ed on s.exam_type_id = ed.id 
            where 
                ped.program_id = ".$program_id." and
                ed.reading >= ped.reading and 
                ed.speaking >= ped.speaking and 
                ed.writing  >= ped.writing and 
                ed.listening >= ped.listening  
            order by 
                s.first_name, s.last_name";
        $query = $db->query($sql);
        while($exams = $query->fetch_assoc()) {
            $all_students += "<option value=".$student['id'].">". ucwords($student['first_name']." ".$student['last_name']) ."</option>";
        }

        header('Content-Type: application/json');
        echo json_encode(array('student_list' => $all_students));
        exit;
    }