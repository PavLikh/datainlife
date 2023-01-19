<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<h3>Template.php</h3>
<pre>
<?
print_r($arResult);
?>
<?
$sTemplate = $arResult["URL_TEMPLATES"]['detail'];
$sUrl = $arResult['FOLDER']
?>
</pre>
<?  if (count($arResult['ELEMENTS'])) {?>
<ul>
    <? foreach($arResult['ELEMENTS'] as $arItem) {?>
        <li>
        <a href="<?=$arItem['DETAIL_URL']?>">
            <p><b><?=$arItem["NAME"]?></b></p>
        </a>
        <p>Категория: 
            <a href="<?=$arItem["SECTION_URL"]?>">
                <?=$arItem["SECTION_NAME"]?></p>
            </a>
        <p><?=$arItem["PREVIEW_TEXT"]?></p>
        </li>
    <? } ?>
</ul>
<? } ?>


<b><?=GetMessage("NAVY")?></b>
	<?echo $arResult["NAV_STRING"]?>



<? foreach ($arResult as $arItem) { ?>
<!-- htmlspecialcharsbx($APPLICATION->GetCurPage())."?"."ELEMENT_ID"."=1 -->
    <a href="<?=$arItem['DETAIL_URL']?>"><?=$arItem['DETAIL_URL']?></a><br>
<? } ?>
<?
// echo '<pre>';
// print_r($_REQUEST);
?>