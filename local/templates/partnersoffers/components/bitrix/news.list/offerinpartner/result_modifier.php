<?php
foreach ($arResult['ITEMS'] as &$item) {
//    $item['PREVIEW_PICTURE'] = \CFile::GetFileArray($item['PREVIEW_PICTURE']);
    if ($item['PREVIEW_PICTURE']) {
        $item['PREVIEW_PICTURE']['SRC'] = \CFile::GetFileSRC($item['PREVIEW_PICTURE']);
    } else {
        $item['PREVIEW_PICTURE']['SRC'] = '/dummy.jpg';
    }

//    $item['DETAIL_PICTURE'] = \CFile::GetFileArray($item['DETAIL_PICTURE']);
    if ($item['DETAIL_PICTURE']) {
        $item['DETAIL_PICTURE']['SRC'] = \CFile::GetFileSRC($item['DETAIL_PICTURE']);
    } else {
        $item['DETAIL_PICTURE']['SRC'] = '/dummy.jpg';
    }
}
