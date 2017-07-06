<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Mobile3
 * @version    3.0.1
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Mobile3_Block_Checkout_Cart extends Mage_Checkout_Block_Cart
{
    protected function _construct()
    {
        parent::_construct();
        $this->_addMinimumAmountNotice();
    }

    protected function _addMinimumAmountNotice()
    {
        if ($this->getQuote()->getItemsCount() &&  ! $this->getQuote()->validateMinimumAmount()) {
            $minimumAmount = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())
                ->toCurrency(Mage::getStoreConfig('sales/minimum_order/amount'))
            ;
            $messageText = Mage::getStoreConfig('sales/minimum_order/description')
                ? Mage::getStoreConfig('sales/minimum_order/description')
                : $this->__('Minimum order amount is %s', $minimumAmount)
            ;
            $notice = Mage::getSingleton('core/message')->notice($messageText);
            Mage::getSingleton('checkout/session')->addUniqueMessages($notice);
        }
    }
}