<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>


<?php foreach($arResult['ITEMS'] as $item):?>
<ul>
    <li><b>IP:</b> <?= $item['UF_IP']?></li>
    <li><b>URL:</b> <?= $item['UF_URL']?></li>
    <li><b>DATE:</b> <?= $item['UF_DATE']->format('d-m-Y H:i:s')?></li>
    <li><b>REFERRER:</b> <?= $item['UF_REFERRER']?></li>
</ul>
<?php endforeach; ?>
