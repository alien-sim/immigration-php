
  $(document).ready(function () {

    $("#nav-program-search ").on("click", ".program-search-card button", function(){
      var program_id = $(this).attr("attr");
      $("#selectStudentModal input#program_id").val(program_id);
    });

    /*  data tables js  */
    $('#example').DataTable();

    // Select picker(multiple)
    $(function () {
        $('.my-select').selectpicker();
    });
    
    // Range slider(Tution fee)
    var $valueSpan = $('.tutionSpan');
    var $value = $('#tution-slider');
    $valueSpan.html($value.val()+'K');
    $value.on('input change', () => {
      $valueSpan.html($value.val()+'K');
    });

    // Range slider(Application fee)
    var $valueSpan1 = $('.applicationSpan');
    var $value1 = $('#application-slider');
    $valueSpan1.html($value1.val()+'K');
    $value1.on('input change', () => {
      $valueSpan1.html($value1.val()+'K');
    });
    
    // Exam-type change
    $('select#exam_type').on('change', function() {
      var exam_type = this.value;
      var html_data = '';
      var date_data = '<label class="input__label">Date of Exam <span class="text-danger">*</span></label>';
      date_data += '<input type="date" class="form-control input-style" name="exam_type_date">';
      var score = ["listening", "reading", "writing", "speaking"];
      if(exam_type == 'ielts' || exam_type == 'toefl'){
        $(".exam_date").html(date_data);
        for(i=0; i<score.length; ++i){
          html_data = '<label class="input__label">'+score[i] + ' <span class="text-danger">*</span></label>';
          html_data += '<input type="number" class="form-control input-style" name="'+score[i]+'" placeholder="'+score[i]+' Score"  min=0 max=100 >';
          $("."+score[i]).html(html_data);
        }
      }
      else if(exam_type == 'duolingo'){
        html_data = '<label class="input__label">Exact Score <span class="text-danger">*</span></label>';
        html_data += '<input type="number" class="form-control input-style" name="exact_score" placeholder="Overall" min=0 max=100 >';

        $(".listening").html(html_data);
        $(".exam_date").html(date_data);
        $(".reading").html("");
        $(".writing").html("");
        $(".speaking").html("");
      }else{
        $(".exam_date").html("");
        $(".listening").html("");
        $(".reading").html("");
        $(".writing").html("");
        $(".speaking").html("");
      }
    });

    // Highest education
    $("select#level-education").on('change', function(){
      var highest_education = this.value;
      var grading_scheme = '';
      $("select#grading-scheme option").remove();
      if(highest_education == 'grade 10' || highest_education == 'grade 12'){
        grading_scheme = '<option value=null>Select Scheme</option>';
        grading_scheme += '<option value="other">Other - (1-100)</option>';
        grading_scheme += '<option value="cbse">CBSE</option>';
        grading_scheme += '<option value="state_boards">State Boards</option>';
        grading_scheme += '<option value="icse">CISCE/ICSE</option>';
      }else{
        grading_scheme = '<option value=null>Select Scheme</option>';
        grading_scheme += '<option value="scale_1-10">Scale - (1-10)</option>';
        grading_scheme += '<option value="scale_1-100">Scale - (1-100)</option>';
        grading_scheme += '<option value="letter_grade"> Letter Grade</option>';
        grading_scheme += '<option value="others">others</option>';
      }
      $("select#grading-scheme").append(grading_scheme)
    })

    // Upload more docs
    $(".add-doc").click(function(){
      html_form = '<div class="form-row mt-3">';
      html_form += '<div class="form-group col-md-5">';
      html_form += '<label class="input__label">Document Type</label>';
      html_form += '<select class="custom-select" name="doc_type[]">';
      html_form += '<option> Select </option>';
      html_form += '<option>Grade 10 Transcript</option>';
      html_form += '<option>Grade 12 Transcript</option>';
      html_form += '<option>Undergraduate Transcript</option>';
      html_form += '<option>Postgraduate Transcript</option>';
      html_form += '<option>Others</option>';
      html_form += '</select>';
      html_form += '</div>';
      html_form += '<div class="form-group col-md-5">';
      html_form += '<label class="input__label">Doc Attachment</label>';
      html_form += '<div class="custom-file">';
      html_form += '<input type="file" class="custom-file-input" name="doc[]" id="validatedCustomFiledoc">';
      html_form += '<label class="custom-file-label" for="validatedCustomFiledoc">Choose document attachment...</label>';
      html_form += '</div>';
      html_form += '</div>';
      // html_form += '<div class="form-group col-md-2"><button class="btn btn-danger">Remove</button></div>';
      html_form += '</div>';

      $(".more-docs-div").append(html_form);
    })

    // GRE exam
    $('input.gre_check').click(function(){
      if($(this).is(":checked")){
          $(".gre_exam").css("display","block")
      }
      else if($(this).is(":not(:checked)")){
        $(".gre_exam").css("display","none")
      }
    });

    // GMAT exam
    $('input.gmat_check').click(function(){
      if($(this).is(":checked")){
          $(".gmat_exam").css("display","block")
      }
      else if($(this).is(":not(:checked)")){
        $(".gmat_exam").css("display","none")
      }
    });

    // filter ajax search
    $(".apply-filter").click(function(){
      $(".before-ajax").html("<img src='assets/images/search-loader.gif' style='width:100px'>")
      setAllVariables(callbackRequest);
    });
  });

  function setAllVariables(callbackRequest){
    var country     = ($('.country-select').selectpicker('val') == null) ? [] : $('.country-select').selectpicker('val');
      var city        = ($('.city-select').selectpicker('val') == null) ? [] : $('.city-select').selectpicker('val');
      var work_permit = $("input.workPermit").prop("checked");

      var university  = ($("input.university").prop("checked")) ? 'university' : '';
      var college     = ($("input.college").prop("checked")) ? 'college' : '' ;
      var english     = ($("input.english").prop("checked")) ? 'english' : '';
      var high_school = ($("input.highSchool").prop("checked")) ? 'high school' : '';
      var tution_fee  = $('#tution-slider').val();
      var app_fee     = $('#application-slider').val();
      var level       = ($('.level-select').selectpicker('val') == null ) ? [] : $('.level-select').selectpicker('val');
      var intakes     = ($('.intake-select').selectpicker('val') == null ) ? '' : $('.intake-select').selectpicker('val');

      // var exam_type   = $('.exam-type-select').selectpicker('val');
      var student     = ($('.student-select').selectpicker('val') == null ) ? '' : $('.student-select').selectpicker('val');

      
      var school_type = '';
      if(university != ''){
        school_type += "LOWER(s.type) LIKE '%"+university+"%'";
        if(college != '' || english != '' || high_school != ''){
          school_type += ' OR '
        }
      }
      if(college != ''){
        school_type += "LOWER(s.type) LIKE '%"+college+"%'";
        if(english != '' || high_school != ''){
          school_type += ' OR '
        }
      }
      if(english != ''){
        school_type += "LOWER(s.type) LIKE '%"+english+"%'";
        if(high_school != ''){
          school_type += ' OR '
        }
      }
      if(high_school != ''){
        school_type += "LOWER(s.type) LIKE '%"+high_school+"%'";
      }

      args = {
        'filter_search':1,
        'school_type' : school_type,
        'tution_fee'  : tution_fee,
        'application_fee' : app_fee,
        'country'     : country,
        'city'        : city,
        'program_level' : level,
        'work_permit' : work_permit,
        // 'exam_type'   : exam_type,
        'intakes'     : intakes,
        'student'     : student
      }
      callbackRequest(args);
  }
  function callbackRequest(args){
    console.log(args);
    $.ajax({
      url: "ajax_functions.php",
      type: 'post',
      data:args,
      success: function(result){
          console.log("jdkjkj", result);
          $(".before-ajax").hide();
          $(".after-ajax").show();
          $("#nav-program-search").html(result['programs']);
          $("#nav-school-search .row").html(result['schools']);
      },
      error: function(error){
        console.log("error -- ", error);
      }
    })
  }

  