<?php

use Mailjet\Resources;

require_once(__DIR__ . 'vendor/autoload.php');

define('API_USER', '024b324d9d8a487382c5f5cdf57e1be8');
define('API_LOGIN', 'e3c98213337c312568470af4e1992fe0');

$mj = new \Mailjet\Client(API_USER, API_LOGIN, true, ['version' => 'v3.1']);

if (empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['topic']) && !empty($_POST['message'])) {
    $lname = htmlspecialchars($_POST['lname']);
    $fname = htmlspecialchars($_POST['fname']);
    $email = htmlspecialchars($_POST['email']);
    $topic = htmlspecialchars($_POST['topic']);
    $message = htmlspecialchars($_POST['message']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "$email",
                        'Name' => "Mail contact"
                    ],
                    'To' => [
                        [
                            'Email' => "alexandremathieu1706@gmail.com",
                            'Name' => "Mail contact"
                        ]
                    ],
                    'Subject' => "Your email flight plan!",
                    'TextPart' => "$lname, $fname, $email, $topic, $message",
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
        echo "Email envoyé avec succés";
    } else {
        echo "email non valide";
    }
} 