<?php
require_once './autoloader.php';

use Zend\Mail\Message;
use Zend\Mail\Transport;
use Zend\Di\Di;
use Zend\Di\Config as DiConfig;
$diConfig = array('instance' => array(
    'Zend\Mail\Transport\FileOptions' => array(
        'parameters' => array(
            'path' => __DIR__,
        )
    ),
    'Zend\Mail\Transport\File' => array(
        'injections' => array(
            'Zend\Mail\Transport\FileOptions'
        )
    ),
    'Zend\Mail\Transport\SmtpOptions' => array(
        'parameters' => array(
            'name'              => 'sendgrid',
            'host'              => 'smtp.sendgrid.net',
            'port' => 25,
            'connectionClass'  => 'login',
            'connectionConfig' => array(
                'username' => 'allo.vince@gmail.com',
                'password' => 'password',
            ),
        )
    ),
    'Zend\Mail\Message' => array(
        'parameters' => array(
            'headers' => 'Zend\Mail\Headers',
            'Zend\Mail\Message::setTo:emailOrAddressList' => 'allo.vince@gmail.com',
            'Zend\Mail\Message::setTo:name' => 'EvaEngine',
            'Zend\Mail\Message::setFrom:emailOrAddressList' => 'info@evaengine.com',
            'Zend\Mail\Message::setFrom:name' => 'EvaEngine',
        )
    ),
    'Zend\Mail\Transport\Smtp' => array(
        'injections' => array(
            'Zend\Mail\Transport\SmtpOptions'
        )
    ),
));

$di = new Di();
$di->configure(new DiConfig($diConfig));

$transport = $di->get('Zend\Mail\Transport\Smtp');
$transport = $di->get('Zend\Mail\Transport\Sendmail');
//$transport = $di->get('Zend\Mail\Transport\File');
$message = $di->get('Zend\Mail\Message');
$message->setSubject("Mail Subject")
->setBody('Mail Content');
$transport->send($message);
