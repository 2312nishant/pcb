<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="description"
          content="Pimpri Chinchwad Bulletin: Your best source for all latest news, breaking news happened in Pimpri Chinchwad,pimpri,Chinchwad,Political,Election, Poll,Bhosari, Pune, Maharashtra, India and National & International News. Checkout here top headlines, live news, current news, India news, sport news coverage, current affairs and keep yourself updated with latest happenings."/>
    <!-- Place this data between the <head> tags of your website -->
<title><?php echo isset($data['title']) ?  $data['title']: '' ?></title>
<meta name="description" content="<?php echo substr(htmlentities($data['description']),154);?>" />

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?php echo isset($data['title']) ?  $data['title']: '' ?>">
<meta itemprop="description" content="<?php echo substr(htmlentities($data['description']),154);?>">
<meta itemprop="image" content="<?php echo base_url()?>uploads/<?php echo $data['pcb_news_id']."/".$data['image']?>">

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@pcbtodaynews">
<meta name="twitter:title" content="<?php echo isset($data['title']) ?  $data['title']: '' ?>">
<meta name="twitter:description" content="<?php echo substr(htmlentities($data['description']),199);?>">
<meta name="twitter:creator" content="@pcbtodaynews">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="<?php echo base_url()?>uploads/<?php echo $data['pcb_news_id']."/".$data['image']?>">

<!-- Open Graph data -->
<meta property="og:title" content="<?php echo isset($data['title']) ?  $data['title']: '' ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php $_SERVER['QUERY_STRING'] ?>" />
<meta property="og:image" content="<?php echo base_url()?>uploads/<?php echo $data['pcb_news_id']."/".$data['image']?>" />
<meta property="og:description" content="<?php echo substr(htmlentities($data['description']),199);?>" />
<meta property="og:site_name" content="PCB Today" />
<meta property="article:published_time" content="<?php echo $data['created_date'];?>" />
<meta property="article:modified_time" content="<?php echo $data['created_date'];?>" />
<meta property="article:section" content="Article Section" />
<meta property="article:tag" content="<?php echo $data['tag'];?>" />
<meta property="fb:admins" content="472521466216581" />
<meta property="fb:app_id" content="472521466216581"/>		
<meta property="fb:pages" content="472521466216581" />
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
<?php $pcbPath = $this->config->item('pcbPath')?>
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
	<div class="col-xs-12 col-sm-12 col-md-12">
		<h1 style="font-size: 44px;line-height: 54px; margin-bottom: 5px;"><?php echo isset($data['title']) ?  $data['title']: '' ?></h1>
		<div class="ndDate"><i class="fa fa-calendar"></i> 6 June 2017</div>
		<div class="ndShare">
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=Facebook&utm_medium=social") ?>" target="_blank" class="ndShareBtn fb"><i class="fa fa-facebook"></i> <span>Facebook</span></a>
						<a href="https://plus.google.com/share?url=<?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=googleplus&utm_medium=social")?>" class="ndShareBtn gplus"><i class="fa fa-google-plus"></i> <span>Google</span></a>
						<a href="http://twitter.com/share?text=Hiring for <?php echo $data['title']?> <?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=twitter&utm_medium=social");?>" class="ndShareBtn lnkd"><i class="fa fa-linkedin"></i> <span>Linkedin</span></a>
						<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pcbPath."NewsDetail/".$data['id']."?utm_source=linkedin&utm_medium=social")?>"  target="_blank" class="ndShareBtn twt"><i class="fa fa-twitter"></i> <span>Twitter</span></a>
						<a href="#" class="ndShareBtn email"><i class="fa fa-envelope"></i> <span>Email</span></a>
					</div>
	



	</div>
	<div style="clear:both"></div>
    	<div class="col-xs-12 col-sm-12 col-md-8">
		<img style="width: 100%;margin-top: 5px;" src="<?php echo base_url()?>uploads/<?php echo $data['pcb_news_id']."/".$data['image']?>">
		<p style="line-height: 1.5;font-size: 18px;margin-top: 20px;text-align: justify;">
			<?php echo $data['description'];?>
		</p>
		
		<hr>
		
<div class="relatedNewsSlider" ><!-- Related News Slider Start -->
						<h1 class="heading"><span>Related News</span></h1>
						<div id="relNewsSlider" class="owl-carousel owl-theme">

						<?php  if(isset($related_news)){ 
								foreach($related_news as $news){
							?>
							<div class="item">
								<div class="newsThumb">
									<div class="newsImg"><img src="<?php echo base_url()?>uploads/<?php echo $news['newsType_id']."/".$news['image']?>"><a href="<?php echo base_url()."NewsDetail/".$news['collection_id']; ?>" class="btn whtBtn">Read more</a></div>
									<div class="newsInfo">
										<div class="niTop clearfix">
											<div class="newsDate pull-left"><?php echo $news['created_date']?></div>
											<div class="rating pull-right"><img src="img/stars.png"></div>
										</div>
										<div class="newsTitle"><?php echo $news['title']?></div>
									</div>
								</div>
							</div>
							<?php }
							}?>
					
					
					
						</div>
					</div><!-- Related News Slider End -->
	
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="advtDiv offsetBot40"><!-- Advertisement Section Start -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div id="advtSlider" class="owl-carousel owl-theme">

							<?php  if(isset($ads)){ 
								foreach($ads as $ad){
							?>
							<div class="item"><img src="<?php echo base_url()?>uploads/<?php echo $ad['adv_type']."/".$ad['image']?>"></div>
						
							<?php }
							}?>
							</div>
						</div>
						
					</div>
				</div><!-- Advertisement Section End -->
			<div class="mostReadNewsDiv offsetBot40"><!-- Most Read News Start -->
					<h1 class="heading"><span>सर्वाधिक वाचलेल्या बातम्या</span></h1>
					<div class="mrnList">
						<ul class="list-unstyled clean">
						
						<?php  if(isset($top_news)){ 
								foreach($top_news as $news){
							?>
							<li class="clearfix">
								<div class="mrnInfo">
									<a href="<?php echo base_url()."NewsDetail/".$news['collection_id']; ?>" class="mrnTitle"><?php echo $news['title']?></a>
									<div class="mrnDate"><?php echo $news['created_date']?></div>
								</div>
								<div class="mrnImg"><a href="#"><img src="<?php echo base_url()?>uploads/<?php echo $news['newsType_id']."/".$news['image']?>"></a></div>
							</li>
							<?php }
							}?>
						</ul>
					</div>
				</div>
				<div class="advtDiv offsetBot40"><!-- Advertisement Section Start -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div id="advtSlider2" class="advtSlider2 owl-carousel owl-theme">
								<div class="item"><img src="<?php echo base_url()?>img/advt1.jpg"></div>
								<div class="item"><img src="<?php echo base_url()?>img/advt1.jpg"></div>
								<div class="item"><img src="<?php echo base_url()?>img/advt1.jpg"></div>
							</div>
						</div>
						
					</div>
				</div><!-- Advertisement Section End -->
		</div>
		<div style="clear:both"></div>
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

/* Related News Slider */
$("#relNewsSlider").owlCarousel({
	nav : true, 
	loop: true,
	margin:20,
	dots:false,
	mouseDrag:false,
	smartSpeed:1000,
	slideSpeed : 300,
	autoplay:true,
	navText: ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"],
	responsive:{
        0:{
            items:1
        },
		481:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
});

/* Advertisement Slider */
$("#advtSlider").owlCarousel({
	nav : false, 
	singleItem:true,
	items:1,
	loop: true,
	dots:false,
	mouseDrag:false,
	smartSpeed:1000,
	slideSpeed : 300,
	autoplay:true,
	navText: ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"]
});


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