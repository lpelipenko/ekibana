<?php
// module/Ekibana/config/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'Ekibana\Controller\Ekibana' => 'Ekibana\Controller\EkibanaController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'login' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'Ekibana\Controller\User',
                        'action'     => 'login',
                    ),
                ),
            ),
            'signup' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/signup',
                    'defaults' => array(
                        'controller' => 'Ekibana\Controller\User',
                        'action'     => 'signup',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ekibana' => __DIR__ . '/../view',
        ),
    ),
);