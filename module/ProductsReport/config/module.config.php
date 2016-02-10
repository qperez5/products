<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ProductsReport\Controller\ProductsReport' => 'ProductsReport\Controller\ProductsReportController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'report' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/report[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'ProductsReport\Controller\ProductsReport',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);