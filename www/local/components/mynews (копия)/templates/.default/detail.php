<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// /** @var array $arParams */
// /** @var array $arResult */
// /** @global CMain $APPLICATION */
// /** @global CUser $USER */
// /** @global CDatabase $DB */
// /** @var CBitrixComponentTemplate $this */
// /** @var string $templateName */
// /** @var string $templateFile */
// /** @var string $templateFolder */
// /** @var string $componentPath */
// /** @var CBitrixComponent $component */
// $this->setFrameMode(true);
?>
<!-- <h3>Detail.php</h3> -->
<?
// echo '<pre>';
// print_r($arParams);
// echo '</pre>';
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
Array(
	"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
),
false
);?>

<p><a href="<?=$APPLICATION->GetCurDir()?>">&larr; Ссылка назад</a></p>