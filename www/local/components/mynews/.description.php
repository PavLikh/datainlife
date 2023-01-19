<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("MYNEWS_COMP"),
	"DESCRIPTION" => GetMessage("IBLOCK_PHOTO_DESCRIPTION"),
	//"ICON" => "/images/photo.gif",
	"COMPLEX" => "Y",
	"PATH" => array(
		"ID" => "mycomp",
		"NAME" => GetMessage("MY_COMP"),
	),
);
?>