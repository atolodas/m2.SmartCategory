<?php
/**
 * Copyright © 2011-2017 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\SmartCategory\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Config\Model\Config\Source\Yesno;

/**
 * Attribute prepare observer
 */
class AttributePrepareObserver implements ObserverInterface
{
    /**
     * @var Yesno
     */
    protected $_yesNo;

    /**
     * @param Yesno $yesNo
     */
    public function __construct(
        Yesno $yesNo
    ) {
        $this->_yesNo = $yesNo;
    }
    	 	
    /**
     * Handler for attribute prepare event
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
		$form = $observer->getEvent()->getForm();
		$yesnoSource = $this->_yesNo->toOptionArray();
		$fieldset = $form->getElement('front_fieldset'); 
		
        if ($fieldset) {
			$fieldset->addField(
				'is_used_for_smart_rules',
				'select',
				[
					'name' => 'is_used_for_smart_rules',
					'label' => __('Use for Smart Category Rule'),
					'title' => __('Use for Smart Category Rule'),
					'values' => $yesnoSource,
				],
				'is_used_for_promo_rules'
			);
        }
        return $this;
    }
}  
