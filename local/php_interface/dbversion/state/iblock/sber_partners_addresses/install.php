<?php return [
    'path' => 'iblock/sber_partners_addresses/install',
    'init' => [
        'iblock' => 'sber_partners_addresses',
    ],
    'commit' => 'a75529621ec74b42d0282207b03f8c3a',
    'entity' => 'DbVersion\\EntityTypes\\Iblock\\Iblock',
    'module' => 'iblock',
    'data' => [
        'IBLOCK_TYPE_ID' => 'partnersoffers',
        'LID' => 's1',
        'CODE' => 'sber_partners_addresses',
        'NAME' => 'Адреса партнёров',
        'ACTIVE' => 'Y',
        'SORT' => '500',
        'LIST_PAGE_URL' => '#SITE_DIR#/partnersoffers/index.php?ID=#IBLOCK_ID#',
        'DETAIL_PAGE_URL' => '#SITE_DIR#/partnersoffers/detail.php?ID=#ELEMENT_ID#',
        'SECTION_PAGE_URL' => '#SITE_DIR#/partnersoffers/list.php?SECTION_ID=#SECTION_ID#',
        'CANONICAL_PAGE_URL' => '',
        'PICTURE' => null,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'XML_ID' => null,
        'INDEX_ELEMENT' => 'Y',
        'INDEX_SECTION' => 'Y',
        'WORKFLOW' => 'N',
        'BIZPROC' => 'N',
        'SECTION_CHOOSER' => 'L',
        'LIST_MODE' => '',
        'RIGHTS_MODE' => 'S',
        'SECTION_PROPERTY' => 'N',
        'PROPERTY_INDEX' => 'N',
        'LAST_CONV_ELEMENT' => '0',
        'EDIT_FILE_BEFORE' => '',
        'EDIT_FILE_AFTER' => '',
        'GROUP_ID' => [
            1 => 'X',
        ],
    ],
    'dependencies' => [
        0 => 'iblocktype/partnersoffers',
        1 => 'user/group/1',
    ],
    'additional' => [
        0 => 'iblock/sber_partners_addresses/properties/PARTNER',
        1 => 'iblock/sber_partners_addresses/properties/CITY',
        2 => 'iblock/sber_partners_addresses/properties/ADDRESS',
        3 => 'iblock/sber_partners_addresses/properties/MAP',
    ],
];