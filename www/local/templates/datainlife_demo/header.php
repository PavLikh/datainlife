<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="shortcut icon" href="https://datainlife.ru/layout/favicon.ico">
<?$APPLICATION->ShowHead();?>
<link href="<?=SITE_TEMPLATE_PATH?>/common.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/colors.css" type="text/css" rel="stylesheet" />

	<!--[if lte IE 6]>
	<style type="text/css">
		
		#banner-overlay { 
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/overlay.png', sizingMethod = 'crop'); 
		}
		
		div.product-overlay {
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/product-overlay.png', sizingMethod = 'crop');
		}
		
	</style>
	<![endif]-->

	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
	<header>
		<?$APPLICATION->ShowPanel();?>
        <div id="logo" onclick="slowScroll('#top')">
            <a href="https://datainlife.ru/" class="logo2">Data<span class="logo_span">inlife</span></a></div>    
        </div>
    </header>
	<div id="top">
		<div class="gr">
			<div class="gr_dotted"></div>
			<div class="gr_7"></div>
			<div class="gr_8"></div>
			<div class="gr_9"></div>
			<h2>Test assignment</h2>
		</div>
    </div>
	<div id="page-wrapper">	
	
		<!-- <div id="header">
	
		</div>  -->
	<!-- </div> -->
		
		<div id="content">
		
			<div id="workarea">
				<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>