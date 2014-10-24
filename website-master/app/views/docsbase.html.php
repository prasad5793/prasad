<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <!--  Mobile viewport optimized: j.mp/bplateviewport -->
   	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    
   	<title>PPI Framework</title>
   	<meta name="description" content="ppi is an open source php meta-framework. we have taken the good bits from Symfony2, ZendFramework2 & Doctrine2 and combined them together to create a solid and very easy web application framework. ppi is fully PSR compliant. ppi can be considered the boilerplate of PHP frameworks">
    <meta name="keywords" content="ppi is an open source php meta-framework. we have taken the good bits from Symfony2, ZendFramework2 & Doctrine2 and combined them together to create a solid and very easy web application framework. ppi is fully PSR compliant. ppi can be considered the boilerplate of PHP frameworks">
   	<meta name="author" content="Paul Dragoonis">
    
    <meta property="og:title" content="PPI Framework: the php meta framework" />
    <meta property="og:site_name" content="PPI Framework: the php meta framework"/>
    <meta property="og:url" content="http://www.ppi.io"/>
    <meta property="og:type" content="website"> 
    <meta property="og:image" content="<?=$view['assets']->getUrl('images/opengraph.png');?>"/>
    
    <title><?php $view['slots']->output('title', 'PPI Skeleton Application') ?></title>
    
    <!-- CSS Stuff -->
    <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,700,700italic|Ubuntu+Mono' rel='stylesheet' type='text/css' />
    <link href="<?=$view['assets']->getUrl('css/libs/pygments.css');?>" rel="stylesheet">
    <link href="<?=$view['assets']->getUrl('css/libs/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=$view['assets']->getUrl('css/main.css');?>" rel="stylesheet">
    <link href="<?=$view['assets']->getUrl('css/docs.css');?>" rel="stylesheet">
    
    <!-- /CSS Stuff -->
    
    <!-- JS Head Stuff -->
    <script src="<?=$view['assets']->getUrl('js/libs/modernizr-2.5.3.min.js');?>"></script>
    <?php $view['slots']->output('include_js_head'); ?>
    <!-- /JS Head Stuff -->
    
    <script type="text/javascript">
        var ppi = {
            baseUrl: '<?=$view['assets']->getUrl('');?>'
        };
    </script>
    
</head>

<body class="docsbase">

    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6. -->
    <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

        <!-- Begin dynamic page output -->
        <?php $view['slots']->output('_content'); ?>
        <!-- End dynamic page output -->
    
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>-->
    <script>window.jQuery || document.write('<script src="<?=$view['assets']->getUrl('js/libs/jquery-1.8.0.min.js');?>"><\/script>')</script>
    
    <!-- JS Body Stuff -->
    <script type="text/javascript" src="<?=$view['assets']->getUrl('js/libs/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?=$view['assets']->getUrl('js/docs-child.js');?>"></script>
    <!-- /JS Body Stuff -->

</body>

</html>
