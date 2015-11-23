<?php

class ThemeHouse_PrivacyGroups_Extend_sonnb_XenGallery_Model_Album extends XFCP_ThemeHouse_PrivacyGroups_Extend_sonnb_XenGallery_Model_Album
{

    /**
     *
     * @see sonnb_XenGallery_Model_Album::passesPrivacyCheck()
     */
    public function passesPrivacyCheck(array $album, $type, $typeData, &$errorPhraseKey = '', array $viewingUser = null)
    {
        if (is_numeric($type)) {
            /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
            $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

            $privacyGroup = $privacyGroupModel->getPrivacyGroupById($type);

            if (!$privacyGroup) {
                return true;
            }

            return XenForo_Helper_Criteria::userMatchesCriteria($privacyGroup['user_criteria'], true, $viewingUser);
        }

        return parent::passesPrivacyCheck($album, $type, $typeData, $errorPhraseKey, $viewingUser);
    } /* END passesPrivacyCheck */
}