<?php

use ProcityDev\PhpDataAnalyser\DataAnalyser;

require_once realpath(__DIR__ . './../../vendor/autoload.php');

$data = new DataAnalyser('../utils/users.json', 'json');
$users = $data->print();

$avatars = [
    'avatar1.png',
    'avatar2.png',
    'avatar3.png',
    'avatar4.png',
    'avatar5.png',
    'avatar6.png',
    'avatar7.png',
    'avatar8.png',
];

$currentAvatar = 0;
// $savedUsers = [];
foreach ($users as $key => $user) {
    if ($currentAvatar > (count($avatars) - 1)) {
        $currentAvatar = 0;
    }

    $users[$key]['avatar'] = 'http://localhost/fake_blog_api/images/avatars/' . $avatars[$currentAvatar];
    $currentAvatar++;
}

