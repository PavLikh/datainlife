<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Создание, продвижение и поддержка сайтов");
?><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Создание адаптивных сайтов, интернет-магазинов на Битриксе, продвижение сайтов в поисковых системах");
$APPLICATION->SetTitle("Мой список новостей");
?><?$APPLICATION->IncludeComponent(
	"mynews", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"MY_COUNT_ELEMS" => "3",
		"MY_IBLOCK_ID" => "1",
		"MY_SECTION_ID" => "",
		"MY_TEST_PARAM" => "CACHE_TIME",
		"SEF_MODE" => "Y",
		"COUNT_ELEMS" => "2",
		"SEF_FOLDER" => "/mynewslist/"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>