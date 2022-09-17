<?php

require_once '../vendor/autoload.php';



try {

// Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465))
        ->setUsername('')//Your mail
        ->setPassword('')//Your pass
        ->setEncryption('SSL')
    ;

// Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

// Create a message
// Create a message
    $message = (new Swift_Message('Wonderful Subject'))
        ->setFrom(['kirill.laikenen@yandex.ru' => 'John Doe'])
        ->setTo(['bonykirill@mail.ru', 'kirill.spainish.load.net@gmail.com' => 'A name'])
        ->setBody('Here is the message itself')
    ;

// Send the message
    $result = $mailer->send($message);
    var_dump(['res' => $result]);
} catch (Exception $e) {
    var_dump($e->getMessage());
    echo '<pre>' . print_r($e->getTrace(), 1);
}