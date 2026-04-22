<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class VisitorsComponent extends CBitrixComponent
{
    /**
     * Подготовка параметров компонента
     */
    public function onPrepareComponentParams($arParams) : array
    {

        $arParams['CACHE_TIME'] = 3600; // 1 час по умолчанию

        return $arParams;
    }

    /**
     * Выполнение компонента
     */
    public function executeComponent() : void
    {
        $this->setVisits();
        $this->includeComponentTemplate();
    }

    /**
     * Установка данных в шаблон
     */
    protected function setVisits() : void
    {
        Loader::includeModule('highloadblock');

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
