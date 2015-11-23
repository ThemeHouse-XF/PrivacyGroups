<?php

class ThemeHouse_PrivacyGroups_Extend_sonnb_XenGallery_Model_Photo extends XFCP_ThemeHouse_PrivacyGroups_Extend_sonnb_XenGallery_Model_Photo
{

    /**
     *
     * @see sonnb_XenGallery_Model_Photo::passesPrivacyCheck()
     */
    public function passesPrivacyCheck(array $photo, $type, $typeData, &$errorPhraseKey = '', array $viewingUser = null)
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

        return parent::passesPrivacyCheck($photo, $type, $typeData, $errorPhraseKey, $viewingUser);
    } /* END passesPrivacyCheck */
}