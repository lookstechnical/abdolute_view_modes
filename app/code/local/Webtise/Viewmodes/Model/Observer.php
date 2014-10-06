<?php class Webtise_Viewmodes_Model_Observer{
    /**
     * @param Varien_Event_Observer $observer
     */

    public function coreBlockAbstractToHtmlAfter(Varien_Event_Observer $observer){
        $transport = $observer->getTransport();
        $block = $observer->getBlock();


        if($block->getNameInLayout() != 'js.child1'){
            return;
        }

        Mage::log($block->getData(),7,'loggg.log',true);

        $html = $transport->getHtml();

        /*$new_output = Mage::getSingleton('core/layout')->createBlock('adminhtml/template')
            ->setTemplate('webtise/config/js.phtml')->toHtml();

        $html = $html.$new_output;*/

        $html = str_replace('perPageSelect = new perPageModel();','',$html);

        $transport->setHtml($html);

    }
}