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
<h3>Section.php</h3>
<pre>
<?
// print_r($arResult);
?>
</pre>

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
<b><?=GetMessage("NAVY")?></b>
<?echo $arResult["NAV_STRING"]?>

<p><a href="<?=$APPLICATION->GetCurDir()?>">&larr; Показать все элементы</a></p>