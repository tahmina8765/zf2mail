<?php

namespace Zf2mail;

use Zf2mail\Entity\Emailers;
use Zf2mail\Table\EmailersTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module {

    public function getAutoloaderConfig() {
        return array (
            'Zend\Loader\ClassMapAutoloader' => array (
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array (
                'namespaces' => array (
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );

    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';

    }

    public function getServiceConfig() {
        return array (
            'factories' => array ('Zf2mail\Table\EmailersTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table     = new EmailersTable($dbAdapter);
                    return $table;
                },
            ),
        );

    }

}
