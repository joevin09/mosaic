<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <!--[if lt IE 9]>
           <link rel="stylesheet" type="text/css" href="<{assets('css/style_ie.css')}>">
    <![endif]-->
    <head>
        <meta charset="utf-8">

        <title><{block name="page-title"}><{/block}><{if $this->router->fetch_class() != "home"}> | <{/if}>
            <{config_item('site_name')}><{if config_item('site_baseline')}> - <{config_item('site_baseline')}><{/if}></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--vendors-->
        <link href="<{assets('css/main.css')}>?<{$smarty.now}>" rel="stylesheet" />
        <link href="<{assets('vendor/fontawesome/css/font-awesome.min.css')}>" rel="stylesheet" type="text/css"/>
        <link rel="icon" type="image/png" href="<{assets('img/favicon.png')}>" />
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif|Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]>
          <script src="<{assets('js/vendor/html5shiv.js')}>"></script>
                     <script src="<{assets('js/vendor/respond.min.js')}>"></script>
        <![endif]-->
        <script type='text/javascript' src='<{assets('vendor/modernizr/modernizr.js')}>'></script>


    <{block name="css"}><{/block}>
    <{if $smarty.get.canvas == '_dhtml'}>
        <link rel="stylesheet" href="<{assets('css/dhtml.css')}>" />
    <{/if}>

    <{if $member->town != "" && $member->agency_name != ""}>
       <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>    
    <{/if}>
    <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
</head>
<body class="page-<{strtolower($this->router->fetch_class())}>-<{$this->router->fetch_method()}> lang-fr <{strtolower($this->router->fetch_class())}>page">
