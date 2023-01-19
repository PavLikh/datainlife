<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

// $arProperty_LNS = array();
// $rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
// while ($arr=$rsProp->Fetch())
// {
// 	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
// 	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S")))
// 	{
// 		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
// 	}
// }

// $arSectProperty_LNS = array();
// $arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION");
// foreach($arUserFields as $FIELD_NAME=>$arUserField)
// 	if($arUserField["USER_TYPE"]["BASE_TYPE"]=="string")
// 		$arSectProperty_LNS[$FIELD_NAME] = $arUserField["LIST_COLUMN_LABEL"]? $arUserField["LIST_COLUMN_LABEL"]: $FIELD_NAME;

// $arAscDesc = array(
// 	"asc" => GetMessage("IBLOCK_SORT_ASC"),
// 	"desc" => GetMessage("IBLOCK_SORT_DESC"),
// );

// $arUGroupsEx = Array();
// $dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
// while($arUGroups = $dbUGroups -> Fetch())
// {
// 	$arUGroupsEx[$arUGroups["ID"]] = $arUGroups["NAME"];
// }

$arComponentParameters = array(
	"PARAMETERS" => array(
		// "AJAX_MODE" => array(),

		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => Array("NAME" => GetMessage("SECTION_ID_DESC")),
			"ELEMENT_ID" => Array("NAME" => GetMessage("ELEMENT_ID_DESC")),
				
			//Добавили переменные
			//"PARAM1" => Array("NAME" => GetMessage("PARAM1")),
			//"PARAM2" => Array("NAME" => GetMessage("PARAM2")),
			//"PARAM3" => Array("NAME" => GetMessage("PARAM3")),
			//"PARAM4" => Array("NAME" => GetMessage("PARAM4")),
				
				
		),
		"SEF_MODE" => Array(
			// "sections_top" => array(
			// 	"NAME" => GetMessage("SECTIONS_TOP_PAGE"),
			// 	"DEFAULT" => "",
			// 	"VARIABLES" => array(),
			// ),
			"section" => array(
				"NAME" => GetMessage("SECTION_PAGE"),
				"DEFAULT" => "#SECTION_ID#/",
				"VARIABLES" => array("SECTION_ID"),
			),
			"detail" => array(
				"NAME" => GetMessage("DETAIL_PAGE"),
				"DEFAULT" => "#SECTION_ID#/#ELEMENT_ID#/",
				"VARIABLES" => array("ELEMENT_ID", "SECTION_ID"),
			),
				
			//добавили новую страницу
			//"exampage" => array(
					//"NAME" => GetMessage("EXAM_PAGE"),
					//DEFAULT
					//VARIABLES
			//),				
		),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_ID"),
			"TYPE" => "LIST",
			// "ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => "1",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),

		// "MY_IBLOCK_ID" => array(
		// 	"PARENT" => "BASE",
		// 	"NAME" => GetMessage("MY_IBLOCK_ID"),
		// 	"TYPE" => "STRING",
		// 	"DEFAULT" => "1",
		// ),
		"MY_SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MY_SECTION_ID"),
			"TYPE" => "STRING",
		),
		"COUNT_ELEMS" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("COUNT_ELEMS"),
			"TYPE" => "STRING",
			"DEFAULT" => "20",
		),
		"MY_TEST_PARAM" => array(
			"PARENT" => "BASE",
			// "NAME" => GetMessage("TEST_PARAM"),
			"NAME" => "FF TEST",
			"TYPE" => "LIST",
			"VALUES" => $arCurrentValues,
			"REFRESH" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
	),
);

// CIBlockParameters::AddPagerSettings(
// 	$arComponentParameters,
// 	GetMessage("T_IBLOCK_DESC_PAGER_PHOTO"), //$pager_title
// 	true, //$bDescNumbering
// 	true, //$bShowAllParam
// 	true, //$bBaseLink
// 	$arCurrentValues["PAGER_BASE_LINK_ENABLE"]==="Y" //$bBaseLinkEnabled
// );

// CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);




// $arTemplateParameters = array(
// 	"DISPLAY_DATE" => Array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
// 		"TYPE" => "CHECKBOX",
// 		"DEFAULT" => "Y",
// 	),
// 	"DISPLAY_PICTURE" => Array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
// 		"TYPE" => "CHECKBOX",
// 		"DEFAULT" => "Y",
// 	),
// 	"DISPLAY_PREVIEW_TEXT" => Array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
// 		"TYPE" => "CHECKBOX",
// 		"DEFAULT" => "Y",
// 	),
// 	"SPECIALDATE" => Array(
// 		"NAME" => GetMessage("SPECIALDATE"),
// 		"TYPE" => "CHECKBOX",
// 		"DEFAULT" => "Y",
// 	),
// 	"ID_IBLOCK_CANONICAL" => Array(
// 		"NAME" => GetMessage("ID_IBLOCK_CANONICAL"),
// 		"TYPE" => "STRING",
// 	),
// 	"USE_SHARE" => Array(
// 		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_USE_SHARE"),
// 		"TYPE" => "CHECKBOX",
// 		"MULTIPLE" => "N",
// 		"VALUE" => "Y",
// 		"DEFAULT" =>"N",
// 		"REFRESH"=> "Y",
// 	),
// );
?>
