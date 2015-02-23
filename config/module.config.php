<?php

namespace Zf2mail;

return array(
    'controllers' => array(
        'invokables' => array(
            'Zf2mail\Controller\Emailers' => 'Zf2mail\Controller\EmailersController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'emailers' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/emailers',
                    'defaults' => array(
                        'controller' => 'Zf2mail\Controller\Emailers',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                ),
            ),
        ),
    ),
    'zf2mail_config' => array(
        'sendmail' => true,
        'fromEmail'  => 'donotreply@yourdomain.com',
        'fromName'   => 'Your Domain Name',
        'adminEmail' => 'admin@yourdomain.com',
    )
);
