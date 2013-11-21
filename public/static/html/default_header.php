<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" content="">
    <?php if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) { ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?php } ?>
    <title>FabienO - Address Book</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link type="text/css" rel="stylesheet" href="static/css/normalize.min.css">
    <link type="text/css" rel="stylesheet" href="static/css/main.css">
    <link type="text/css" rel="stylesheet" media="only screen and (max-width: 730px)" href="static/css/mobile.css" />
    <link type="text/css" rel='stylesheet 'href='http://fonts.googleapis.com/css?family=Antic+Slab|Sintony'>

    <script type="text/javascript" src="http://codeorigin.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="static/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <div class="orange-bar"></div>

    <div class="grey-bar">
        <div class="container">
            <div id="header">
                <h1><?php echo isset($site_title) && $site_title != '' ? $site_title : 'Address Book'; ?></h1>
                <p><?php echo isset($page_title) && $page_title != '' ? $page_title : 'Page Title'; ?></p>
            </div>

            <div id="contact">
                <a href="<?php echo PATH_TO_PUBLIC; ?>">Home</a> |
                <a href="<?php echo PATH_TO_PUBLIC . '/manage-contacts'; ?>">Add new</a>
            </div>
        </div>
    </div>

    <div class="container">
