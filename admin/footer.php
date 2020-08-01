<!--footer section start-->
<footer class="dashboard">
  <p>&copy 2020 Express Abroad. All Rights Reserved.</p>
</footer>
<!--footer section end-->

<!-- move top -->
<button onclick="topFunction()" id="movetop" class="bg-primary1" title="Go to top">
  <span class="fa fa-angle-up"></span>
</button>


<script>
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("movetop").style.display = "block";
    } else {
      document.getElementById("movetop").style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
<!-- /move top -->


<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<!-- <script src="assets/js/jquery.js"></script> -->

<!-- chart js -->
<!-- <script src="assets/js/Chart.min.js"></script> -->
<!-- <script src="assets/js/utils.js"></script> -->
<!-- //chart js -->

<!-- Different scripts of charts.  Ex.Barchart, Stackedchart, Linechart, Piechart -->
<!-- <script src="assets/js/bar.js"></script> -->
<!-- <script src="assets/js/stacked.js"></script> -->
<!-- <script src="assets/js/linechart.js"></script> -->
<!-- <script src="assets/js/pie.js"></script> -->
<!-- //Different scripts of charts.  Ex.Barchart, Stackedchart, Linechart, Piechart -->

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>


<script src="assets/js/faq.js"></script>

<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/scripts.js"></script>

<!-- close script -->
<script>
  var closebtns = document.getElementsByClassName("close-grid");
  var i;

  for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function () {
      this.parentElement.style.display = 'none';
    });
  }
</script>
<!-- //close script -->

<!-- CK Editor settings -->
<script>
	var toolbar = {
		toolbar: [
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
			{ name: 'links', items: [ 'Link' ] },
			{ name: 'insert', items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
		]
  }
  var path_name = window.location.pathname
  if (path_name.includes("programs.php") || path_name.includes("program.php")){
    CKEDITOR.replace( 'admission_req', toolbar);
    CKEDITOR.replace( 'other_fees', toolbar);
    CKEDITOR.replace( 'description', toolbar);
  }
</script>
<!-- // CK Editor settings -->

<!-- disable body scroll when navbar is in active -->
<script>
  $(function () {
    $('.sidebar-menu-collapsed').click(function () {
      $('body').toggleClass('noscroll');
    })
  });
</script>
<!-- disable body scroll when navbar is in active -->

 <!-- loading-gif Js -->
 <script src="assets/js/modernizr.js"></script>
 <script>
     $(window).load(function () {
         // Animate loader off screen
         $(".se-pre-con").fadeOut("slow");;
     });
 </script>
 <!--// loading-gif Js -->


<!-- Bootstrap Core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified JavaScript Bootstrap Select -->
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="assets/js/ajax_requests.js"></script>

