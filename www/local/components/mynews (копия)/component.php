<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// /** @var CBitrixComponent $this */
// /** @var array $arParams */
// /** @var array $arResult */
// /** @var string $componentPath */
// /** @var string $componentName */
// /** @var string $componentTemplate */
// /** @global CDatabase $DB */
// /** @global CUser $USER */
// /** @global CMain $APPLICATION */

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

// sef_mode

// "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
// "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],


$arDefaultUrlTemplates404 = array(
	"template" => "",
	"section" => "#SECTION_ID#/",
	"detail" => "#SECTION_ID#/#ELEMENT_ID#/",
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
	"SECTION_ID",
	"SECTION_CODE",
	"ELEMENT_ID",
	"ELEMENT_CODE",
);

if($arParams["SEF_MODE"] == "Y")
{
	$arVariables = array();

	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

	$engine = new CComponentEngine($this);
	if (CModule::IncludeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);

	$b404 = false;
	if(!$componentPage)
	{
		$componentPage = "template";
		$b404 = true;
	}

	if(
		$componentPage == "section"
		&& isset($arVariables["SECTION_ID"])
		&& intval($arVariables["SECTION_ID"])."" !== $arVariables["SECTION_ID"]
	)
		$b404 = true;

	if($b404 && CModule::IncludeModule('iblock'))
	{
		$folder404 = str_replace("\\", "/", $arParams["SEF_FOLDER"]);
		if ($folder404 != "/")
			$folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
		if (substr($folder404, -1) == "/")
			$folder404 .= "index.php";

		if ($folder404 != $APPLICATION->GetCurPage(true))
		{
			\Bitrix\Iblock\Component\Tools::process404(
				""
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SHOW_404"] === "Y")
				,$arParams["FILE_404"]
			);
		}
	}

	CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases,
	);
}
// ---sef_mode






echo '<pre>';
echo "TEST";
print_r($arParams);

echo '$arParams["IBLOCK_ID"] = ' .$arParams['IBLOCK_ID'] . "<br>";
echo '$arParams["MY_SECTION_ID"] = ' .$arParams['MY_SECTION_ID'] . "<br>";
echo '$arParams["COUNT_ELEMS"] = ' .$arParams['COUNT_ELEMS'] . "<br>";

$arNavigation = CDBResult::GetNavParams($arNavParams);

if(isset($_REQUEST["ELEMENT_ID"]) && intval($_REQUEST["ELEMENT_ID"]) > 0)
	$componentPage = "detail";
elseif(isset($_REQUEST["SECTION_ID"]) && intval($_REQUEST["SECTION_ID"]) > 0) {
	$componentPage = "section";
	$section_id = $_REQUEST["SECTION_ID"];
}

// if ($this->StartResultCache(false, [$section_id, $componentPage, $arNavigation])) {

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

	// echo '$section_id: ';
	// echo $section_id;
	// echo '<br>';
	// echo '$arSections<br>';
	// print_r($arSections);


		//iblock elements
		$arSortElems = array (
			"NAME" => "ASC"
		);
		$arFilterElems = array (
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ACTIVE" => "Y",
			// "IBLOCK_SECTION_ID" => $section_id,
			"IBLOCK_SECTION_ID" => (isset($section_id) ? (int)$section_id : ""),
		);
		$arNavStartParams = array (
			"nPageSize" => $arParams['COUNT_ELEMS']
			// "nPageSize" => 2
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
// $arResult['ELEM_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPage())."?"."ELEMENT_ID"."=1";
// $componentPage = "detail";
// echo '$arNews<br>';
// print_r($arNews);
// echo '$arSections<br>';
// print_r($arSections);
echo '</pre>';
	$this->IncludeComponentTemplate($componentPage);
// }

?>