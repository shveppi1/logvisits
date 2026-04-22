<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Data\Cache;

class VisitorsComponent extends CBitrixComponent
{
    /**
     * Подготовка параметров компонента
     */
    public function onPrepareComponentParams($arParams)
    {

        $arParams['CACHE_TIME'] = 3600; // 1 час по умолчанию

        return $arParams;
    }

    /**
     * Выполнение компонента
     */
    public function executeComponent()
    {
        $this->setVisits();
        $this->includeComponentTemplate();
    }

    /**
     * Установка даты в шаблон
     */
    protected function setVisits()
    {
        \Bitrix\Main\Loader::includeModule('highloadblock');

        $visits = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity('VISITORS')->getDataClass()::getList([
            'select' => ['*'],
            'order' => ['ID' => 'DESC'],
            'limit' => 30,
            'cache' => [
                'ttl' => $this->arParams['CACHE_TIME']
            ]
        ])->fetchAll();

        $this->arResult['ITEMS'] = $visits;
    }

}
