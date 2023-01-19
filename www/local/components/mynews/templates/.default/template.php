<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
?>
<?  if (count($arResult['ELEMENTS'])) {?>
<ul>
    <? foreach($arResult['ELEMENTS'] as $arItem) {?>
        <li>
        <a href="<?=$arItem['DETAIL_URL']?>">
            <p><b><?=$arItem["NAME"]?></b></p>
        </a>
        <p><?=GetMessage('CATEGORY')?>
            <a href="<?=$arItem["SECTION_URL"]?>">
                <?=$arItem["SECTION_NAME"]?>
            </a>
        </p>
        <p><?=$arItem["PREVIEW_TEXT"]?></p>
        </li>
    <? } ?>
</ul>
<? } ?>
<br>
<b><?=GetMessage("NAVY")?></b><br>
	<?echo $arResult["NAV_STRING"]?>

<? foreach ($arResult as $arItem) { ?>
    <a href="<?=$arItem['DETAIL_URL']?>"><?=$arItem['DETAIL_URL']?></a><br>
<? } ?>
