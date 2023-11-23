<?php

return [
    'title' => 'Text',
    'category' => 'General',
    'icon' => 'fa fa-paragraph',
    "settings" => [
        "title" => [
            "type" => "String",
            "label" => "Title",
            "value" => "",
        ],
        "descript" => [
            "type" => "richTextEditor",
            "label" => "Text",
            "value" => "",
        ],
        "align" => [
            "type" => "select",
            "label" => "Align",
            "value" => "",
            "options" => [
                ['id' => "left", 'name' => "Left"],
                ['id' => "center", 'name' => "Center"],
                ['id' => "right", 'name' => "Right"],
            ]
        ]
    ],
];
