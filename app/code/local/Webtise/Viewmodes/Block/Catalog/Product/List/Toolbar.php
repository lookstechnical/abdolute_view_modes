<?php  class Webtise_Viewmodes_Block_Catalog_Product_List_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar{
    /**
     * Init Toolbar
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_orderField  = Mage::getStoreConfig(
            Mage_Catalog_Model_Config::XML_PATH_LIST_DEFAULT_SORT_BY
        );

        $this->_availableOrder = $this->_getConfig()->getAttributeUsedForSortByArray();

        $avaliableModes = explode(',',Mage::getStoreConfig('catalog/frontend/list_mode'));

        foreach($avaliableModes as $avaliableMode){
            $this->_availableMode[$avaliableMode] = $avaliableMode;
        }

        $this->setTemplate('catalog/product/list/toolbar.phtml');
    }


    /**
     * Retrieve available limits for current view mode
     *
     * @return array
     */
    public function getAvailableLimit()
    {
        $currentMode = $this->getCurrentMode();
        if (in_array($currentMode, array('list', 'grid','grid2','grid3','grid4'))) {
            return $this->_getAvailableLimit($currentMode);
        } else {
            return $this->_defaultAvailableLimit;
        }
    }

    /**
     * Retrieve available limits for specified view mode
     *
     * @return array
     */
    protected function _getAvailableLimit($mode)
    {
        if (isset($this->_availableLimit[$mode])) {
            return $this->_availableLimit[$mode];
        }
        $perPageConfigKey = 'catalog/frontend/' . $mode . '_per_page_values';
        $perPageValues = (string)Mage::getStoreConfig($perPageConfigKey);
        $perPageValues = explode(',', $perPageValues);
        $perPageValues = array_combine($perPageValues, $perPageValues);
        if (Mage::getStoreConfigFlag('catalog/frontend/list_allow_all')) {
            return ($perPageValues + array('all'=>$this->__('All')));
        } else {
            return $perPageValues;
        }
    }
}