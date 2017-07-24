﻿<!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>PCB Today Admin Portal</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php include_url ('plugins/bootstrap/css/bootstrap.css')?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php include_url ('plugins/node-waves/waves.css')?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php include_url ('plugins/animate-css/animate.css')?>" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="<?php include_url ('plugins/material-design-preloader/md-preloader.css')?>" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php include_url ('plugins/morrisjs/morris.css')?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php include_url ('css/style.css')?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php include_url ('css/themes/all-themes.css')?>" rel="stylesheet" />


     <!-- Bootstrap Select Css -->
    <link href="<?php include_url ('plugins/bootstrap-select/css/bootstrap-select.css')?>" rel="stylesheet" />


    <!-- Sweetalert Css -->
    <link href="<?php include_url ('plugins/sweetalert/sweetalert.css')?>" rel="stylesheet" />

    <!-- Include Editor style. -->
<link href="<?php include_url ('css/wysiwyg/froala_editor.min.css')?>" rel='stylesheet' type='text/css' />
<link href='<?php include_url ('css/wysiwyg/froala_style.min.css')?>" rel='stylesheet' type='text/css' />
 <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/code_view.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/colors.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/emoticons.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/image_manager.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/image.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/line_breaker.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/table.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/char_counter.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/video.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/fullscreen.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/file.css')?>">
  <link rel="stylesheet" href="<?php include_url ('css/wysiwyg/plugins/quick_insert.css')?>">


<style>
.show-placeholder{height:200px;}
</style>
</head>
<script>
    var pcbPath = "<?php echo base_url('') ?>";
</script>
<?php $this->load->config("pcb_config"); ?>

<script>

    var sub_ward = <?php  echo json_encode($this->config->item('sub_ward')); ?>;

</script>

<body class="theme-red" ng-app='adminApp'>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">PCB Today Admin Portal</a>
            </div>

        </div>
    </nav>
    <!-- #Top Bar header -->
    <div ng-include="'pages/admin_portal/header.php'" style="display:block">
        </div>
    <!-- end header -->

    <section class="content">
         <div ng-view style="display:block">
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?php include_url ('plugins/jquery/jquery.min.js')?>"></script>

     <script src="<?php include_url ('lib/angular.js')?>"></script>
    <script src="<?php include_url ('lib/angular-route.min.js')?>"></script>
    <script src="https://angular-file-upload.appspot.com/js/ng-file-upload.js"></script>

    <script src="<?php include_url ('js/appAdmin.js')?>"></script>
    <script src="<?php include_url ('js/pcbServices.js')?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php include_url ('plugins/bootstrap/js/bootstrap.js')?>"></script>



    <!-- Select Plugin Js -->
    <script src="<?php include_url ('plugins/bootstrap-select/js/bootstrap-select.js')?>"> </script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php include_url ('plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

	 <!-- Select Plugin Js -->
    <script src="<?php include_url ('plugins/bootstrap-select/js/bootstrap-select.js')?>"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="<?php include_url ('plugins/sweetalert/sweetalert.min.js')?>"></script>


    <!-- wysiwyg -->
  <script type='text/javascript' src='<?php include_url ('js/wysiwyg/froala_editor.min.js')?>'></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/align.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/char_counter.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/code_beautifier.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/code_view.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/colors.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/draggable.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/emoticons.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/entities.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/file.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/font_size.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/font_family.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/fullscreen.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/image.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/image_manager.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/line_breaker.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/inline_style.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/link.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/lists.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/paragraph_format.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/paragraph_style.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/quick_insert.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/quote.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/table.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/save.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/url.min.js')?>"></script>
  <script type="text/javascript" src="<?php include_url ('js/wysiwyg/plugins/video.min.js')?>"></script>


    <!-- Waves Effect Plugin Js -->
    <script src="<?php include_url ('plugins/node-waves/waves.js')?>"></script>

    <!-- Custom Js -->
    <script src="<?php include_url ('js/admin.js')?>"></script>

    <!-- Demo Js -->
    <script src="<?php include_url ('js/demo.js')?>"></script>


</body>

</html>