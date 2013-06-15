<?php

/**
 * @category   Itmyprofession
 * @package    Itmyprofession_Subcategory
 * @author     itmyprofession@gmail.com
 * @website    
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Itmyprofession_Subcategory_Block_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar
{

    public function getPagerHtml()
    {
        $pagerBlock = $this->getLayout()->createBlock('page/html_pager');

        if ($pagerBlock instanceof Varien_Object) {
            $pagerBlock->setAvailableLimit($this->getAvailableLimit());

            $pagerBlock->setUseContainer(false)
                    ->setShowPerPage(false)
                    ->setShowAmounts(false)
                    ->setLimitVarName($this->getLimitVarName())
                    ->setLimit($this->getLimit())
                    ->setCollection($this->getCollection());

            return $pagerBlock->toHtml();
        }
        return '';
    }

}