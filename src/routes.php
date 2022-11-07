<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)


return [
    '' => ['HomeController', 'index',],
    'about' => ['AboutController', 'index'],
    'contact' => ['ContactController', 'index'],
    'legal' => ['LegalController', 'index'],
    'home' => ['HomeController', 'index',],
    'announcements' => ['AnnouncementController', 'index',],
    'announcements/card' => ['AnnouncementController', 'selectCard', ['id']],
    'announcements/delete' => ['AnnouncementController', 'delete', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    '404' => ['ErrorController','index'],
];
/*
switch ($a) {
    case '': 
        ['HomeController', 'index',];
    break;
    case 'about': ['AboutController', 'index'];
    break;
    case 'contact': ['ContactController', 'index'];
    break;
    case 'legal': ['LegalController', 'index'];
    break;
    case 'home': ['HomeController', 'index',];
    break;
    case 'announcement': ['AnnouncementController', 'index',];
    break;
    case 'items/edit': ['ItemController', 'edit', ['id']];
    break;
    case 'items/show': ['ItemController', 'show', ['id']];
    break;
    case 'items/add': ['ItemController', 'add',];
    break;
    case 'items/delete': ['ItemController', 'delete',];
    break;
    case '404': ['ErrorController','index'];
    break;
    default: ['ErrorController','index'];
}*/