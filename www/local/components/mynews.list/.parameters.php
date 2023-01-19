<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("SORT" => "ASC"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}




$arComponentParameters = array(
	"PARAMETERS" => array(
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => "1",
		),
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SECTION_ID"),
			"TYPE" => "STRING",
		),
		"NEWS_COUNT" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("NEWS_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "20",
		),
		"TEST_PARAM" => array(

			"NAME" => GetMessage("TEST_PARAM"),
			"TYPE" => "LIST",
			"VALUES" => $arCurrentValues,
			"REFRESH" => "Y",
		),
	),
);