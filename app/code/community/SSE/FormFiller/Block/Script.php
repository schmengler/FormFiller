<?php
/**
 * This file is part of SSE_FormFiller for Magento.
 *
 * @license http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @author Fabian Schmengler <fabian@schmengler-se.de>
 * @category SSE
 * @package SSE_FormFiller
 * @copyright Copyright (c) 2015 Schmengler Software Engineering (http://www.schmengler-se.de/)
 */

/**
 * Block for dynamic script parameters in head
 *
 * @package SSE_FormFiller
 */
class SSE_FormFiller_Block_Script extends Mage_Core_Block_Template
{
    protected $_template = 'sse_formfiller/script.phtml';

    public function getDefaultPassword()
    {
        return Mage::getStoreConfig('dev/formfiller/default_password');
    }
}