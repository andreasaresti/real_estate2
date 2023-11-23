<?php


$settings["question1"] =  [
    "type" => "string",
    "label" => "Question 1",
    "value" => "Question 1"
];
$settings["answer1"] =  [
    "type" => "string",
    "label" => "Answer 1",
    "value" => "Answer 1"
];



for ($i = 2; $i < 11; $i++) {

    $settings["question" . $i] =  [
        "type" => "string",
        "label" => "Question " . $i,
        "value" => ""
    ];
    $settings["answer" . $i] =  [
        "type" => "string",
        "label" => "Answer " . $i,
        "value" => " "
    ];
}

return [
    'title' => 'FAQ',
    'category' => 'General',
    'icon' => 'fa fa-question-circle',
    "settings" => $settings
];
