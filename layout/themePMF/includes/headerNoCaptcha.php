<?php
 require_once "Mobile_Detect.php";
 $urlHost = $_SERVER['HTTP_HOST'];
 $urlUri = $_SERVER['REQUEST_URI'];
?>


<link href="https://fonts.googleapis.com/css?family=Montserrat:300‌​,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="https://<?php echo($urlHost);?>/layout/themePMF/css/style.css">

<?php
  if(stripos($urlUri, 'internet/') == 0){
 ?>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous">
  </script>

  <script src="https://code.jquery.com/jquery-migrate-1.3.0.min.js"
    integrity="sha256-+/QytbLYK1r6AApmPrwhgXw7uz4u9H1E65c85XWyHRo="
    crossorigin="anonymous">
  </script>

<?php } ?>


<script src="https://<?php echo($urlHost);?>/scripts/js/ui/jquery-ui.min.js"></script>

<script src="https://<?php echo($urlHost);?>/scripts/js/jquery/jquery.easing.min.js"></script>

<script src="https://<?php echo($urlHost);?>/scripts/js/ui/jquery-ui.min.js"></script>
<script src="https://<?php echo($urlHost);?>/scripts/slidesjs/js/slides.min.jquery.js"></script>
