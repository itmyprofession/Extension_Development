<?php

/**
 * @category   Itmyprofession
 * @package    Itmyprofession_Subcategory
 * @author     itmyprofession@gmail.com
 * @website    
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Itmyprofession_Subcategory_Block_Collection extends Mage_Core_Block_Template
{

    public function __construct()
    {
        $parentCategoryId = Mage::app()->getStore()->getRootCategoryId();
        if ($this->getRequest()->getParam('categoryId', false))
            $parentCategoryId = $this->getRequest()->getParam('categoryId');
        //echo $this->getData('category_id');die;
        $collection = Mage::getModel('catalog/category')->getCollection()
                ->addFieldToFilter('parent_id', $parentCategoryId)
                ->addIsActiveFilter()
                ->addNameToResult()
                ->addUrlRewriteToResult();

        $this->setCollection($collection);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $parentId = Mage::app()->getStore()->getRootCategoryId();

        if ($this->getRequest()->getParam('categoryId', false)) {
            $parentId = $this->getRequest()->getParam('categoryId');
        }

        $category = Mage::getModel('catalog/category')->load($parentId);

        if ($headBlock = $this->getLayout()->getBlock('head')) {
            if ($title = $category->getMetaTitle()) {
                $headBlock->setTitle($title);
            }
            if ($description = $category->getMetaDescription()) {
                $headBlock->setDescription($description);
            }
            if ($keywords = $category->getMetaKeywords()) {
                $headBlock->setKeyWords($keywords);
            }
        }

        $this->setTitle($category->getName());

        $toolbar = $this->getToolbarBlock();

        $collection = $this->getCollection();

        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }

        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }

        if ($sort = $this->getDefaultDirection()) {
            $toolbar->setDefaultDirection($dir);
        }

        $toolbar->setCollection($collection);
        $this->setChild('toolbar', $toolbar);
        $this->getCollection()->load();
        return $this;
    }

    public function getDefaultDirection()
    {
        return 'asc';
    }

    public function getAvailableOrders()
    {
        return array('name' => 'Name', 'position' => 'Position', 'children_count' => '');
    }
    
    public function getSortBy(){
        return 'name';
    }
    
    public function getToolbarBlock()
    {
        $block = $this->getLayout()->createBlock('subcategory/toolbar', microtime());
        return $block;
    }
    
    public function getMode(){
        return $this->getChild('toolbar')->getCurrentMode();
    }
    
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }

}