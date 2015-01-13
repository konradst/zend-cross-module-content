<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Chart2\Controller\Chart2' => 'Chart2\Controller\Chart2Controller',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'chart2' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/chart2[/][:action]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                     ),
                     'defaults' => array(
                         'controller' => 'Chart2\Controller\Chart2',
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