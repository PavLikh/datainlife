<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
Array(
	"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
	// "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	// "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DISPLAY_NAME" => "N",
),
false
);?>

<p><a href="<?=$APPLICATION->GetCurDir()?>">&larr; <?=GetMessage('BACK_LINK')?></a></p>