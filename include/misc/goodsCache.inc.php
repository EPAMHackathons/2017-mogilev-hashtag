<?php

function getCachedGoods()
{
    $cacheTTL = 60 * 60; //1hr

    $fname = getCachedGoodsFname();
    if (!file_exists($fname)) return [];
    $mtime = filemtime($fname);
    $ageSec = time() - $mtime;

    if ($ageSec < $cacheTTL) return unserialize(file_get_contents($fname));

    invalidateCachedGoods();
    return [];
}

function storeCachedGoods($goods)
{
    $fname = getCachedGoodsFname();
    file_put_contents($fname, serialize($goods));
}

function invalidateCachedGoods()
{
    $fname = getCachedGoodsFname();
    if (file_exists($fname)) unlink($fname);
}


function getCachedGoodsFname()
{
    return DOC_ROOT . "/tpl/tpl_c/cache/goods.ser";
}

?>