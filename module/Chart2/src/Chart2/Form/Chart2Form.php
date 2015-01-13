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
               'label' => 'Rodzaj wykresu',
               'value_options' => array(
                  'abs' => 'wartość absolutna',
                  'sin' => 'sin',
               )
            ),
            'attributes' => array(
               'value' => 'abs'
            )
         ));
     }
 }