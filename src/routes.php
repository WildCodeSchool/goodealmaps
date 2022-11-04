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
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
];
