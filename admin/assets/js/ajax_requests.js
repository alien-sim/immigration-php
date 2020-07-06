
  $(document).ready(function () {
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
        'work_permit' : work_permit
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
          $(".before-ajax").hide();
          $(".after-ajax").show();
          $("#nav-program-search").html(result['programs']);
          $("#nav-school-search .row").html(result['schools']);
      }
    })
  }