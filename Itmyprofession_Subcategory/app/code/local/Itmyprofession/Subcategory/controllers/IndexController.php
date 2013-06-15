<?php

/**
 * @category   Itmyprofession
 * @package    Itmyprofession_Subcategory
 * @author     itmyprofession@gmail.com
 * @website    
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Itmyprofession_SubCategory_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout()->renderLayout();
    }

}