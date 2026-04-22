<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\EventManager;

// Пролог
EventManager::getInstance()->addEventHandler(
    'main',
    'OnBeforeProlog',
    'OnBeforeProlog'
);


function OnBeforeProlog()
{
    storeVisit();
}


function storeVisit () : void
{

    // Получаем текущий URL
    $current_url = $_SERVER['REQUEST_URI'] ?? '';

    // Проверяем, нужно ли логировать
    if (!excludeLog($current_url)) {


        // Получаем информацию о посетителе
        $arFields = [
            'UF_IP' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown',
            'UF_URL' => $_SERVER['REQUEST_URI'] ?? 'Unknown',
            'UF_REFERRER' => $_SERVER['HTTP_REFERER'] ?? 'Direct',
        ];

        \Bitrix\Main\Loader::includeModule('highloadblock');
        \Bitrix\Highloadblock\HighloadBlockTable::compileEntity('VISITORS')->getDataClass()::add($arFields);
    }

}

// Функция проверки - нужно ли исключить текущий URL
function excludeLog($url) {

    // Список путей, которые не нужно логировать
    $excluded_paths = [
        '/bitrix/',
        '/upload/',
        '/ajax/'
    ];

    foreach ($excluded_paths as $path) {
        if (strpos($url, $path) !== false) {
            return true;
        }
    }
    return false;
}
