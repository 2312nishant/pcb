<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <title>PCB Todays news portal</title>


    <!-- Bootstrap core CSS     -->
    <link href="<?php include_url ('assets/css/bootstrap.min.css')?>" rel="stylesheet"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/lohitdevanagari.css"/>

    <!--  Fonts and icons
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">-->
    <link href="<?php include_url ('assets/css/themify-icons.css')?>" rel="stylesheet">

    <link href="<?php include_url ('assets/css/marquee.css')?>" rel="stylesheet">
    <link href="<?php include_url ('assets/css/style.css')?>" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php include_url ('assets/css/flexslider.css')?>" media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?php include_url ('assets/css/ui.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php include_url ('assets/css/fontello/fontello.css')?>" media="screen"/>

    <link href="<?php include_url ('assets/css/custom.css')?>" rel="stylesheet"/>

    <!--   Core JS Files   -->
    <script src="<?php include_url('assets/js/jquery-1.10.2.js')?>" type="text/javascript"></script>
    <script src="<?php include_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>




    <script src="<?php include_url ('lib/angular.js')?>"></script>
    <script src="<?php include_url ('lib/angular-route.min.js')?>"></script>

    <script src="<?php include_url ('lib/angular-resource.min.js')?>"></script>
    <script type="text/javascript" src="<?php include_url ('lib/ui-bootstrap-tpls.min.js')?>"></script>
    <!--<script src="lib2/angular-route.min.js" > </script>*/-->


    <script src="<?php include_url ('js/appFront.js')?>"></script>

    <script src="<?php include_url('js/custome.js')?>"></script>
    <script src="<?php include_url('js/ng-infinite-scroll.min.js')?>"></script>



    <style>
        .collapsed {
            cursor: pointer
        }
    </style>
</head>

<body ng-app='frontApp'>
<div class="container-fluid">
    <div class="main-panel">

        <div ng-include src="'<?php  echo base_url(); ?>pages/header.php'"> </div>

        <div class="content">
            <div class="container-fluid" style="padding:0">
                <!-- Main Content -->
                <div class="main-content " style="padding: 0;" ng-view>
                </div>

               <!-- <div class="col-md-4" ng-include="'pages/rightBar.html'" style="position:relative">


                </div>--->

            </div>
        </div>
        <!--<div footer-panel></div>
        </div>
         -->
        <div ng-include src="'<?php  echo base_url(); ?>pages/footer.html'" ng-show="delayLoad"> </div>

		<script>
			var pcbPath = "<?php echo base_url('') ?>";
			var pcbImagePath = "<?php echo $this->config->item('pcbImagePath')?>";
		</script>
        <script type="text/javascript" src="<?php echo include_url ('assets/js/flexslider-min.js')?>"></script>
        <script type="text/javascript" src="<?php echo include_url ('assets/js/carouFredSel.js')?>"></script>
        <script type="text/javascript" src="<?php echo include_url ('assets/js/ui.js')?>"></script>
        <script src="<?php include_url ('js/marquee.js')?>"></script>
        <script src="<?php include_url ('js/election/jquery.rwdImageMaps.min.js')?>"></script>
        <script src="<?php include_url ('js/election/jquery.maphilight.js')?>"></script>
        <script type="text/javascript">

            /*function getMobileOperatingSystem() {
             var userAgent = navigator.userAgent || navigator.vendor || window.opera;
             alert(/windows phone/i.test(userAgent))
             // Windows Phone must come first because its UA also contains "Android"
             if (/windows phone/i.test(userAgent)) {
             return "Windows Phone";
             }

             if (/android/i.test(userAgent)) {
             $('.android').css('display','none');
             }

             // iOS detection from: http://stackoverflow.com/a/9039885/177710
             if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
             $('.ios').css('display','none');
             // return "iOS";
             }

             return "unknown";
             }

             alert(getMobileOperatingSystem());*/


            $(document).ready(function () {





                //setInterval(setMarquee, 3000)

                !function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + "://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");


            });

            $(document).ready(function (e) {


            });

        </script>
</body>
</html>