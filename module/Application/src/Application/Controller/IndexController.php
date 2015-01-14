<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Chart2\Form\Chart2Form;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        if(class_exists('Chart2\Form\Chart2Form')) $chart_form = new Chart2Form();
        return new ViewModel(array(
            'chart_form'=>$chart_form
        ));
    }
}
