<?php
namespace Chart2\Form;

 use Zend\Form\Form;

 class Chart2Form extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('chart2');
         $this->add(array(
            'name' => 'type_radio',
            'type' => 'Radio',
            'options' => array(
                'label' => 'The things from "Chart2" module (including this text) are neither loaded with JavaScript nor defined in the "Application" module. The "Application" Controller calls the definition of the Form that is located in the "Chart2" module. The "Application" index.phtml view calls the partial view that is also located in the "Chart2" module. The views, controllers, models and forms of both modules are independent of each other. You will see that when you comment out "Chart2" in application.config.php line 11.',
                'value_options' => array(
                  'abs' => 'abs()',
                  'sin' => 'sin()',
                )
            ),
            'attributes' => array(
               'value' => 'abs'
            )
         ));
     }
 }