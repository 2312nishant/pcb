<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="description"
          content="Pimpri Chinchwad Bulletin: Your best source for all latest news, breaking news happened in Pimpri Chinchwad,pimpri,Chinchwad,Political,Election, Poll,Bhosari, Pune, Maharashtra, India and National & International News. Checkout here top headlines, live news, current news, India news, sport news coverage, current affairs and keep yourself updated with latest happenings."/>
    <!-- Place this data between the <head> tags of your website -->
<title></title>


<link rel="author" href="http://pcbtoday.in/#/home" />

<link rel="icon" href="images/ic_launcher_pcb.png" sizes="16x16" type="image/png">

<!-- CSS & Fonts Start -->
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'><!-- Abel Google Font -->
<link href="<?php echo base_url()?>css/website/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>css/website/main.css" rel="stylesheet">
<link href="<?php echo base_url()?>css/website/responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>css/website/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>css/website/owl.carousel.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>css/website/owl.theme.default.min.css" rel="stylesheet">

<!-- CSS & Fonts End -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="<?php echo base_url()?>css/custome.css" rel="stylesheet">
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
<!-- Top Header Section End -->

<!-- Header Start -->
<div>
	<header>
	<div class="mainLogoSection">
		<div class="container-fluid text-center">
			<a href="<?php echo base_url()?>#/home"><img src="<?php echo base_url()?>img/logo.png" class="logo"></a>
			<a href="#" class="navToggleBtn"><i class="fa fa-bars"></i></a>
		</div>
	</div>
	<nav class="navigationMenu"><!-- Navigation Menu Start -->
		<div class="container-fluid">
			<ul class="navMenuList clean clearfix list-unstyled">
				<li><a href="<?php echo base_url()?>#/newslist/1">बँनर न्यूज </a></li>
				<li class="active"><a href="<?php echo base_url()?>#/newslist/2">पिंपरी </a></li>
				<li><a href="<?php echo base_url()?>#/newslist/3">चिंचवड </a></li>
				<li><a href="<?php echo base_url()?>#/newslist/4">भोसरी </a></li>
				<li><a href="<?php echo base_url()?>#/newslist/5">पुणे </a></li>
				<li><a href="<?php echo base_url()?>#/newslist/12">पुणे  ग्रामीण</a></li>
				<li><a href="<?php echo base_url()?>#/newslist/6">महाराष्ट्र </a></li>
				<li><a href="<?php echo base_url()?>#/newslist/7">देश </a></li>
				<li><a href="<?php echo base_url()?>#/newslist/8">विदेश </a></li>
				
				<li><a href="<?php echo base_url()?>#/newslist/11">ठळक बातम्या </a></li>
				<li class="dropdown"> 
					<a href="#" class="dropdown-toggle" id="otherMenus" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> इतर <span class="caret"></span> </a> 
					<ul class="dropdown-menu" aria-labelledby="otherMenus"> 
						<li><a href="<?php echo base_url()?>/Poll">पोल</a></li> 
						<li><a href="<?php echo base_url()?>#/newslist/1">संपर्क</a></li> 
						<li><a href="<?php echo base_url()?>#/newslist/1">जाहिरातविषयक</a></li> 
						<li role="separator" class="divider"></li> 
						<li><a href="<?php echo base_url()?>#/newslist/1">अभिप्राय</a></li>
					</ul> 
				</li>
			</ul>
		</div>
	</nav><!-- Navigation Menu End -->
	
	<div class="marqueeDiv relative clearfix"><!-- Breaking News Start -->
		<span>Breaking News</span>
		<marquee class="marqueeNews" direction=left>
			<ul class="list-unstyled clean clearfix">
					<?php if(isset($breaking)){ 
				for($i=0 ; $i<count($breaking) ;$i++){
							?>
				<li><?php echo $breaking[$i]['text']?></li>
				<?php }}?>
			</ul>
		</marquee>
	</div><!-- Breaking News End -->
</header>
</div>
<!-- Header End -->
<div class="container-fluid" style="width:90%">

    
				<div class="selectionTestDiv offsetBot40"><!-- Poll Section Start -->
					<h1 class="heading" style="text-align: center;"><span>मतचाचणी</span></h1>
					<div class="poll">
						<p><?php echo isset($pollData['question']) ? $pollData['question'] : '' ?></p>
						<ul class="list-unstyled">
							<li>
								<label><?php echo isset($pollData['option_a']) ? $pollData['option_a'] : '' ?></label>
								<button type="button" class="btn btn-sm btn-success" onClick="submitVote(<?php echo $pollData['id']?>,'cnt_a')">Vote</button>
								<div class="progress">
									<div class="progress-bar progress-bar-success" style="width:20%"><?php echo round($pollData['cnt_a']/($pollData['cnt_a']+$pollData['cnt_b']+$pollData['cnt_c']+$pollData['cnt_d'])*100,2)?>%</div>
								</div>
							</li>
							<li>
								<label><?php echo isset($pollData['option_b']) ? $pollData['option_b'] : '' ?></label>
								<button type="button" class="btn btn-sm btn-danger" onClick="submitVote(<?php echo $pollData['id']?>,'cnt_b')">Vote</button>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" style="width:20%"><?php echo round($pollData['cnt_b']/($pollData['cnt_a']+$pollData['cnt_b']+$pollData['cnt_c']+$pollData['cnt_d'])*100,2)?>%</div>
								</div>
							</li>
							<li>
								<label><?php echo isset($pollData['option_c']) ? $pollData['option_c'] : '' ?></label>
								<button type="button" class="btn btn-sm btn-warning" onClick="submitVote(<?php echo $pollData['id']?>,'cnt_c')">Vote</button>
								<div class="progress">
									<div class="progress-bar progress-bar-warning" style="width:20%"><?php echo round($pollData['cnt_c']/($pollData['cnt_a']+$pollData['cnt_b']+$pollData['cnt_c']+$pollData['cnt_d'])*100,2)?>%</div>
								</div>
							</li>
							<li>
								<label ><?php echo isset($pollData['option_d']) ? $pollData['option_d'] : '' ?></label>
								<button type="button" class="btn btn-sm btn-info" onClick="submitVote(<?php echo $pollData['id']?>,'cnt_d')">Vote</button>
								<div class="progress">
									<div class="progress-bar progress-bar-info" style="width:20%"><?php echo round($pollData['cnt_d']/($pollData['cnt_a']+$pollData['cnt_b']+$pollData['cnt_c']+$pollData['cnt_d'])*100,2)?>%</div>
								</div>
							</li>
						</ul>
						<span class="voteCount"><?php echo $pollData['cnt_a']+$pollData['cnt_b']+$pollData['cnt_c']+$pollData['cnt_d'] ?> votes</span>
					</div>
				</div><!-- Poll Section End -->
				
				
</div>
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
<script src="<?php echo base_url()?>js/jquery-1.10.2.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url()?>js/website/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/website/owl.carousel.min.js"></script>

<script src="<?php echo base_url()?>js/custome1.js?v=557"></script>
<script>
 var pcbPath = "<?php echo base_url('') ?>";
            var pcbImagePath = "<?php echo $this->config->item('pcbImagePath')?>";
</script>
<script>
$(document).ready(function(){
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


function submitVote(pollid,option){
if(localStorage.getItem(pollid)==null){
  localStorage.setItem(pollid,true);
  $.ajax({
 type: "POST",
 url: pcbPath + 'Website/savePollVote',
 data: {option: option, id: pollid},
 cache: false,
 success: function(data){
    //$("#resultarea").text(data);
/* $scope.countA=(parseInt(data[0].cnt_a)/parseInt(data[0].total))*100,
$scope.countB=(parseInt(data[0].cnt_b)/parseInt(data[0].total))*100,
$scope.countC=(parseInt(data[0].cnt_c)/parseInt(data[0].total))*100,
$scope.countD=(parseInt(data[0].cnt_d)/parseInt(data[0].total))*100,
       $scope.total=data[0].total;*/
alert("Your vote submited successfuly")
 }
});
  }else{
  alert("You already submited your vote")
  }

}
</script>

</body>
</html>