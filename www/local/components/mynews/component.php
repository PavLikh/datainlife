<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("IBLOCK_MODULE_NONE"));
	return;
}

if(!isset($arParams["IBLOCK_ID"]))
{
	ShowError(GetMessage("IBLOCK_ID_NONE"));
	return;
}

if (!isset($arParams["CACHE_TIME"]) )
	$arParams["CACHE_TIME"] = 36000000;

$arParams["CACHE_TIME"] = intval($arParams["CACHE_TIME"]);

$arParams['IBLOCK_ID'] = intval(trim($arParams['IBLOCK_ID']));
$arParams['MY_SECTION_ID'] = (!empty($arParams['MY_SECTION_ID']) ? (int)$arParams['MY_SECTION_ID'] : "");
$arParams['COUNT_ELEMS'] = (isset($arParams['COUNT_ELEMS']) ? (int)$arParams['COUNT_ELEMS'] : "");

$arNavigation = CDBResult::GetNavParams($arNavParams);

if (!empty($arParams['MY_SECTION_ID'])) {
	$componentPage = "section";
	$section_id = $arParams['MY_SECTION_ID'];
	$arResult["SET_SECT"] = 'Y';
}

if(isset($_REQUEST["ELEMENT_ID"]) && intval($_REQUEST["ELEMENT_ID"]) > 0) {
	$componentPage = "detail";
	$elementId = $_REQUEST["ELEMENT_ID"];
} elseif(isset($_REQUEST["SECTION_ID"]) && intval($_REQUEST["SECTION_ID"]) > 0) {
	$componentPage = "section";
	$section_id = $_REQUEST["SECTION_ID"];
}

if ($this->StartResultCache(false, [$section_id, $componentPage, $arNavigation, $elementId])) {

	//iblock sections
	$arFilterSect = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y"
	);
	$arSortSect = array (
		"NAME" => "ASC"
	);
	$arSelectSect = array (
		"ID",
		"IBLOCK_ID",
		"NAME",
	);
	
	$arSections = array();
	$rsSections = CIBlockSection::GetList($arSortSect, $arFilterSect, false, $arSelectSect, false);
	while($arSection = $rsSections->GetNext())
	{
		$arSections[$arSection["ID"]] = $arSection;
	}
	
	if (isset($section_id)) {
		$arResult['CUR_SECTION_NAME'] = $arSections[$section_id]['NAME'];
	}

	//iblock elements
	$arSortElems = array (
		"NAME" => "ASC"
	);
	$arFilterElems = array (
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"IBLOCK_SECTION_ID" => (isset($section_id) ? (int)$section_id : ""),
	);
	$arNavStartParams = array (
		"nPageSize" => $arParams['COUNT_ELEMS']
	);
	$arSelectElems = array (
		"ID",
		"IBLOCK_ID",
		"SECTION_ID",
		"NAME",
		"IBLOCK_SECTION_ID",
		"PREVIEW_TEXT",
		"DETAIL_PAGE_URL"
	);
		
	$arNews = array();
	$rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, $arNavStartParams, $arSelectElems);
	while($arElement = $rsElements->GetNext())
	{
		$arNews[$arElement['ID']] = $arElement;
		$arNews[$arElement['ID']]['DETAIL_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPage())."?"."ELEMENT_ID=".$arElement['ID'];
	}

	$arResult["NAV_STRING"] = $rsElements->GetPageNavString("Странички");
	foreach ($arNews as $id => $arNew) {
		foreach ($arSections as $arSect) {
			if ($arNew["IBLOCK_SECTION_ID"] == $arSect["ID"]) {
				$arNews[$id]["SECTION_NAME"] = $arSect["NAME"];
				$arNews[$id]['SECTION_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPage())."?"."SECTION_ID=".$arSect["ID"];
			}
		}
	}

	$arResult["ELEMENTS"] = $arNews;
	$this->IncludeComponentTemplate($componentPage);
}

?>