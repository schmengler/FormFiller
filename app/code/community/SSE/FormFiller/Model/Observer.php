<?php
/**
 * This file is part of SSE_FormFiller for Magento.
 *
 * @license http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @author Fabian Schmengler <fabian@schmengler-se.de>
 * @category SSE
 * @package SSE_FormFiller
 * @copyright Copyright (c) 2014 Schmengler Software Engineering (http://www.schmengler-se.de/)
 */

/**
 * Observer Model
 * @package SSE_FormFiller
 */
class SSE_FormFiller_Model_Observer extends Mage_Core_Model_Abstract
{

    /**
     * Add form filler button to form if applicable
     * 
     * @see event core_block_abstract_to_html_after
     * @return 
     */
    public function addFormFiller(Varien_Event_Observer $observer)
    {
        if ($this->_shouldAddFormFiller($observer->getBlock())) {
        	$html = $observer->getTransport()->getHtml();
        	$html = preg_replace('#<form[^>]*>#', '$0' . $this->_getButtonHtml(), $html);
        	$observer->getTransport()->setHtml($html);
        }
    }

    /**
     * Returns true if form filler button should be added to given block
     * 
     * @param Mage_Core_Block_Abstract $block
     * @return boolean
     */
    protected function _shouldAddFormFiller(Mage_Core_Block_Abstract $block)
    {
    	if (! Mage::getStoreConfig('dev/formfiller/enabled') ||
    		(Mage::getStoreConfig('dev/formfiller/only_in_developer_mode') && ! Mage::getIsDeveloperMode())
		) {
    		return false;
    	}
    	foreach ($this->_getSupportedBlocks() as $supportedBlockClass) {
    		if ($block instanceof $supportedBlockClass) {
    			return true;
    		}
    	}
    	return false;
    }
    /**
     * Returns block classes where form filler button can be added
     * 
     * @return string[]
     */
    protected function _getSupportedBlocks()
    {
    	return array('Mage_Checkout_Block_Onepage_Billing', 'Mage_Checkout_Block_Onepage_Shipping');
    }
    /**
     * Returns HTML for form filler button
     * 
     * @return string
     */
    protected function _getButtonHtml()
    {
    	$helper = Mage::helper('sse_formfiller');
        return '<button class="button btn btn-default button-formfiller" type="button" onclick="formFiller.fill(this.form)"><span><span>' .
    		$helper->__('Fill form with random data') .
    		'</span></span></button>';
    }
}