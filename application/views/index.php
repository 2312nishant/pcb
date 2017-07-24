<!DOCTYPE html>
<html lang="en" ng-app='frontApp'>
<head>
 <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="description"
          content="Pimpri Chinchwad Bulletin: Your best source for all latest news, breaking news happened in Pimpri Chinchwad,pimpri,Chinchwad,Political,Election, Poll,Bhosari, Pune, Maharashtra, India and National & International News. Checkout here top headlines, live news, current news, India news, sport news coverage, current affairs and keep yourself updated with latest happenings."/>
    <title>Pimpri Chinchwad Bulletin: Pimpri News, Chinchwad News, Bhosari News</title>
<link rel="author" href="http://pcbtoday.in/#/home" />

<link rel="icon" href="images/ic_launcher_pcb.png" sizes="16x16" type="image/png">

<!-- CSS & Fonts Start -->
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'><!-- Abel Google Font -->
<link href="css/website/bootstrap.min.css" rel="stylesheet">
<link href="css/website/main.css" rel="stylesheet">
<link href="css/website/responsive.css" rel="stylesheet">
<link href="css/website/font-awesome.min.css" rel="stylesheet">
<link href="css/website/owl.carousel.min.css" rel="stylesheet">
<link href="css/website/owl.theme.default.min.css" rel="stylesheet">

<!-- CSS & Fonts End -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="css/custome.css" rel="stylesheet">
</head>
<body>

<!-- Top Header Section Start -->
<div class="topHeaderSection">
	<div class="container-fluid">
		<div class="topHeaderLeft pull-left">
			<i class="fa fa-newspaper-o"></i> PCB Today
		</div>
		<div class="topHeaderRight pull-right">
			<i class="fa fa-mobile"></i> Get PCB Today App Download from <a href="#">App Store</a> | <a href="#">Android App</a>
		</div>
	</div>
</div>
<div id="loaderDiv" loader>
            <img src="<?php echo base_url() ?>images/ajax_loader_blue_64.gif" class="ajax-loader"/>
        </div>
<!-- Top Header Section End -->

<!-- Header Start -->
<div ui-view="header"></div>
<!-- Header End -->
<div ui-view></div>
<!-- Footer Start -->
<footer>
	<div class="footerTop">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-4">
					<a href="#"><img src="img/logo.png" class="logo"></a>
					<div class="footerCaption">
						<a href="#"><i class="fa fa-newspaper-o"></i> PCBToday</a></br>
						मराठी बातम्या देणारा हक्काचे व्यासपीठ !  मराठी अस्मिते साठी सदेव तत्पर PCBToday
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="footerWidget">
						<h3 class="footerHeading">पिंपरी चिंचवड बुलेटीन</h3>
						<address>
							<p><i class="fa fa-map-marker"></i> ३रा मजला, पी. जे. चेंबर,<br>
							आंबेडकर चौक, पिंपरी, पुणे	<br>
							<i class="fa fa-phone"></i> +91-8793202014 <br>
							<i class="fa fa-envelope"></i> <a href="mailto:pcbtoday@gmail.com">pcbtoday@gmail.com</a> </p>
						</address>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<h3 class="footerHeading">Follow us on</h3>
					<div class="footerSocialLinks">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footerBot">
		<div class="copyTxt text-center">Copyright © 2017 PCB | All rights reserved.</div>
	</div>
</footer>
<!-- Footer End -->

<div id="toTop" class="btn"><span class="glyphicon glyphicon-chevron-up"></span></div><!-- Scroll Top Button -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.10.2.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/website/bootstrap.min.js"></script>
<script src="js/website/owl.carousel.min.js"></script>
<script src="lib/angular.js"></script>
<script src="lib/angular-sanitize.js"></script>
 <script src="lib/angular-ui-router.js"></script>
 <script type="text/javascript" src="lib/ui-bootstrap-tpls.min.js"></script>
<script src="js/appFront.js?v=557"></script>
<script src="js/webServices.js?v=557"></script>
<script src="js/website/jquery.easyPaginate.js?v=557"></script>
<script src="js/custome1.js?v=557"></script>

<script>
 var pcbPath = "<?php echo base_url('') ?>";
            var pcbImagePath = "<?php echo $this->config->item('pcbImagePath')?>";
</script>
<script>
$(document).ready(function(){

/* Big News Slider 
$("#BigNewsSlider").owlCarousel({
	nav : true, 
	singleItem:true,
	items:1,
	loop: true,
	dots:false,
	mouseDrag:false,
	smartSpeed:1000,
	slideSpeed : 300,
	autoplay:true,
	navText: ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"],
});*/




/* Scroll Top Button */
$('body').append('<div id="toTop" class="btn"><span class="glyphicon glyphicon-chevron-up"></span></div>');
$(window).scroll(function () {
	if ($(this).scrollTop() != 0) {
		$('#toTop').fadeIn();
	} else {
		$('#toTop').fadeOut();
	}
}); 
$('#toTop').click(function(){
	$("html, body").animate({ scrollTop: 0 }, 600);
	return false;
});



});
</script>

</body>
</html>