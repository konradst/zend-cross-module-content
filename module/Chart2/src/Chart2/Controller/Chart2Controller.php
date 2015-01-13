<?php
namespace Chart2\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Summary  
 */
class Chart2Controller extends AbstractActionController
{
   
   /**
    * Description
    * @var object 
    */
   private $_chart_type;
   
   /**
    * Description
    * @var object 
    */
   private $_width = 400;
   
   /**
    * Description
    * @var int 
    */
   private $_height = 400;
   
   /**
    * Description
    * @var int 
    */
   private $_offset_x = 10;
   
   /**
    * Description
    * @var int 
    */
   
   private $_offset_y = 10;
   /**
    * Description
    * @var int 
    */
   private $_x_axis_min = -190;
   
   /**
    * Description
    * @var int 
    */
   private $_x_axis_max = 190;
   
   /**
    * Description
    * @var int 
    */
   private $_y_axis_min = -190;
   
   /**
    * Description
    * @var int 
    */
   private $_y_axis_max = 190;
   
   /**
    * Description
    * @var int 
    */
   private $_d = 1;
   
   /**
    * Description
    * @var int 
    */
   private $_scale_factor = 15;
   
   /**
    * Description
    * @var string 
    */
   private $_bg_color = array(210,255,210);
   
   /**
    * Description
    * @var object
    */
   private $_fg_color = array(50,50,0);
   
   /**
    * Description
    * @var object 
    */
   private $_x_axis_color = array(0,0,100);
   
   /**
    * Description
    * @var object 
    */
   private $_y_axis_color = array(100,0,0);
   
   /**
    * Description
    * @var object 
    */
   private $_x_center;
   
   /**
    * Description
    * @var object
    */
   private $_y_center;
   
   /**
    * Description
    * @var object 
    */
   private $_img;
   
   /**
    * Summary
    * @return object  Description
    */
   private function _draw_new()
   {
      $this->_img = imagecreate($this->_width, $this->_height);
      $this->_x_center = $this->_offset_x - $this->_x_axis_min;
      $this->_y_center = $this->_offset_y - $this->_y_axis_min;
      return $this;
   }
   
   /**
    * Summary
    * @return object  Description
    */
   private function _draw_background()
   {
      imagefill($this->_img, 0, 0, imagecolorallocate($this->_img, $this->_bg_color[0], $this->_bg_color[1], $this->_bg_color[2]));
      return $this;
   }
   
   /**
    * Summary
    * @return object  Description
    */
   private function _draw_axis()
   {
      imageline($this->_img, $this->_offset_x, $this->_y_center, $this->_offset_x+abs($this->_x_axis_min)+$this->_x_axis_max, $this->_y_center, imagecolorallocate($this->_img, $this->_x_axis_color[0], $this->_x_axis_color[1], $this->_x_axis_color[2]));
      imageline($this->_img, $this->_x_center, $this->_offset_y, $this->_x_center, $this->_offset_y+abs($this->_y_axis_max)+$this->_y_axis_max, imagecolorallocate($this->_img, $this->_y_axis_color[0], $this->_y_axis_color[1], $this->_y_axis_color[2]));
      return $this;
   }
   
   /**
    * Summary
    * @return object  Description
    */
   private function _draw_abs()
   {
      $fg_color = imagecolorallocate($this->_img, $this->_fg_color[0], $this->_fg_color[1], $this->_fg_color[2]);
      
      for($x = $this->_x_axis_min; $x <= $this->_x_axis_max; $x+=$this->_d) {
         $y = abs($x);
         $xx = $x + $this->_x_center;
         $yy = -$y + $this->_y_center;
         imagesetpixel($this->_img ,$xx ,$yy ,$fg_color);
      }
      return $this;
   }
   
   /**
    * Summary
    * @return object  Description
    */
   private function _draw_sin()
   {
      $fg_color = imagecolorallocate($this->_img, $this->_fg_color[0], $this->_fg_color[1], $this->_fg_color[2]);
      
      $scale = (abs($this->_x_axis_min) + $this->_x_axis_max) / $this->_scale_factor;
      for($x = $this->_x_axis_min/$scale; $x <= $this->_x_axis_max/$scale; $x+=$this->_d/$scale) {
         $y = sin($x);
         $xx = $scale*$x + $this->_x_center;
         $yy = -$scale*$y + $this->_y_center;
         imagesetpixel($this->_img ,$xx ,$yy ,$fg_color);
      }
      return $this;
   }
   
   /**
    * Summary
    * @return object  Description
    */
   private function _draw_render() {
      header('Content-type: image/jpeg');
      imagejpeg($this->_img);
      imagedestroy($this->_img);
      return $this;
   }
   
   /**
    * Summary
    * @return object  Description
    */
   public function drawAction()
   {
      try
      {
         $type = $this->params()->fromQuery('type_radio'); 
         $this->_draw_new()
            ->_draw_background()
            ->_draw_axis()
            ->{"_draw_$type"}()
            ->_draw_render();
      }
      catch(Exception $e)
      {
         echo $e->getMessage();
      }
   }
}