<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Партнеры и предложения");
?>
<?php $APPLICATION->IncludeComponent('extyl:page.main', '') ?>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
