<?php
namespace ProductsReport;

use ProductsReport\Model\ProductReportRow;
use ProductsReport\Model\ProductReportRowTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'ProductsReport\Model\ProductReportRowTable' =>  function($sm) {
                    $tableGateway = $sm->get('ProductReportRowTableGateway');
                    $table = new ProductReportRowTable($tableGateway);
                    return $table;
                },
                'ProductReportRowTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new ProductReportRow());
                    return new TableGateway('products', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}