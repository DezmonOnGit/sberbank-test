<?php return [
    'path' => 'iblock/sber_partners/properties/IS_ONLINE',
    'init' => [
        'iblock' => 'sber_partners',
        'property' => 'IS_ONLINE',
    ],
    'commit' => 'd075a16ca7ef79b206c724ceb5e3d056',
    'entity' => 'DbVersion\\EntityTypes\\Iblock\\Property\\Prop\\BasicL',
    'module' => 'iblock',
    'data' => [
        'IBLOCK_ID' => 'sber_partners',
        'NAME' => 'Онлайн',
        'ACTIVE' => 'Y',
        'SORT' => '500',
        'CODE' => 'IS_ONLINE',
        'DEFAULT_VALUE' => '',
        'PROPERTY_TYPE' => 'L',
        'ROW_COUNT' => '1',
        'COL_COUNT' => '30',
        'LIST_TYPE' => 'C',
        'MULTIPLE' => 'N',
        'XML_ID' => null,
        'FILE_TYPE' => '',
        'MULTIPLE_CNT' => '5',
        'LINK_IBLOCK_ID' => '0',
        'WITH_DESCRIPTION' => 'N',
        'SEARCHABLE' => 'N',
        'FILTRABLE' => 'N',
        'IS_REQUIRED' => 'N',
        'USER_TYPE' => null,
        'USER_TYPE_SETTINGS_LIST' => true,
        'USER_TYPE_SETTINGS' => true,
        'HINT' => '',
    ],
    'dependencies' => [
        0 => 'iblock/sber_partners/install',
    ],
    'additional' => [
        0 => 'iblock/sber_partners/properties/IS_ONLINE_enum',
    ],
];