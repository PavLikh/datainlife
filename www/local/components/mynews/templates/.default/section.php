<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?  if (count($arResult['ELEMENTS'])) {?>
	<h4><?=$arResult["CUR_SECTION_NAME"]?></h4>
	<ul>
    <? foreach($arResult['ELEMENTS'] as $arItem) {?>
        <li>
        <a href="<?=$arItem['DETAIL_URL']?>">
            <p><b><?=$arItem["NAME"]?></b></p>
        </a> 
        <p><?=$arItem["PREVIEW_TEXT"]?></p>
        </li>
    <? } ?>
</ul>
<? } ?>
<br>

<?if($arResult['NAV_STRING']) {?>
    <b><?=GetMessage("NAVY")?></b><br>
<?}?>

<?echo $arResult["NAV_STRING"]?>

<?if ($arResult["SET_SECT"] != 'Y') {?>
<p><a href="<?=$APPLICATION->GetCurDir()?>">&larr; <?=GetMessage('SHOW_ALL')?></a></p>
<? } ?>