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

$arComponentParameters = array(
	"PARAMETERS" => array(
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
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
	),
);

?>
