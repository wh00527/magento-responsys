<?php
class Pas_Responsys_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_RESPONSYS_GENERAL_ISENABLED      = 'responsys/general/is_enabled';
    const XML_PATH_RESPONSYS_GENERAL_APIUSERNAME    = 'responsys/general/api_username';
    const XML_PATH_RESPONSYS_GENERAL_APIPASSWORD    = 'responsys/general/api_password';

    const ATTR_SYNC     = 'responsys_sync';
    const ATTR_WELCOME  = 'responsys_welcome';

    protected $_interactObjects = array(
        Pas_Responsys_Model_Api::INTERACT_MEMBER => array(
            'folder' => '!MasterData',
            'object' => 'METALICUS_LIST'
        ),
        Pas_Responsys_Model_Api::INTERACT_URL => array(
            'folder' => '_Programs',
            'object' => 'ME_PR_WelcomeSequence_PET'
        ),
        Pas_Responsys_Model_Api::INTERACT_WELCOME => array(
            'folder' => '_Programs',
            'object' => 'METALICUS_LIST'
        )
    );

    /**
     * Log Responsys message.
     *
     * @param string $message
     * @return $this
     */
    public function log($message)
    {
        Mage::log($message, null, 'responsys.log');
        return $this;
    }

    public function isEnabled()
    {
        return Mage::getStoreConfig(self::XML_PATH_RESPONSYS_GENERAL_ISENABLED);
    }

    public function getUsername()
    {
        return Mage::getStoreConfig(self::XML_PATH_RESPONSYS_GENERAL_APIUSERNAME);
    }

    public function getPassword()
    {
        return Mage::getStoreConfig(self::XML_PATH_RESPONSYS_GENERAL_APIPASSWORD);
    }

    public function getSyncAttribute()
    {
        return self::ATTR_SYNC;
    }

    public function getWelcomeAttribute()
    {
        return self::ATTR_WELCOME;
    }

    /**
     * Gets list of Responsys fields and their Magento equivalents.
     *
     * @return array
     */
    public function getResponsysMapping()
    {
        return array(
            'CUSTOMER_ID_'      => 'apparel21_person_id',
            'EMAIL_ADDRESS_'    => 'email',
            'FIRST_NAME'        => 'firstname',
            'LAST_NAME'         => 'lastname'
        );
    }

    public function getResponsysColumns()
    {
        return array_keys($this->getResponsysMapping());
    }

    public function getMagentoColumns()
    {
        return array_values($this->getResponsysMapping());
    }

    /**
     * Gets list of Responsys member defaults.
     *
     * @return array
     */
    public function getResponsysDefaults()
    {
        return array(
            'EMAIL_PERMISSION_STATUS_' => 'I'
        );
    }

    public function getResponsysKey()
    {
        return 'apparel21_person_id';
    }

    public function getInteractFolder($type)
    {
        if (isset($this->_interactObjects[$type])) {
            return $this->_interactObjects[$type]['folder'];
        }
        return false;
    }

    public function getInteractObject($type)
    {
        if (isset($this->_interactObjects[$type])) {
            return $this->_interactObjects[$type]['object'];
        }
        return false;
    }

    public function getWelcomeEvent()
    {
        return 'onlinesignup';
    }
}
