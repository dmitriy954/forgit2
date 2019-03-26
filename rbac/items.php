<?php
return [
    'viewAdmin' => [
        'type' => 2,
        'description' => 'View post',
    ],
    'adm' => [
        'type' => 1,
        'children' => [
            'viewAdmin',
        ],
    ],
];
