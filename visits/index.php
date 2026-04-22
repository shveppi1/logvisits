<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Визиты");
?>


<?php
$APPLICATION->IncludeComponent(
    "mahaonapp:visitors",
    "",
    []
);
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
