<?php

class Mgroup_RatingService_SendController extends Mage_Core_Controller_Front_Action
{
   public function indexAction ()
   {
      $url = Mage::helper("ratingservice")->getSiteUrl().'/companies/api_rate';
      $data = $this->getRequest()->getParams();

      $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($data)
          )
      );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      if ($result === FALSE) { /* Handle error */ }

      print_r($result);
   }

}



?>
