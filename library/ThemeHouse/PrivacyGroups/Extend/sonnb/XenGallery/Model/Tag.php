<?php

class ThemeHouse_PrivacyGroups_Extend_sonnb_XenGallery_Model_Tag extends XFCP_ThemeHouse_PrivacyGroups_Extend_sonnb_XenGallery_Model_Tag
{
    public function canTagUser(array $user, &$errorPhraseKey = '', array $viewingUser = null)
{
    $this->standardizeViewingUserReference($viewingUser);

    if ($user['user_id'] == $viewingUser['user_id']) {
        return true;
    } /* END canTagUser */

    if (is_numeric($user['xengallery']['allow_tagging'])) {
        /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
        $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

        $privacyGroup = $privacyGroupModel->getPrivacyGroupById($user['xengallery']['allow_tagging']);

        if (!$privacyGroup) {
            return true;
        }

        return XenForo_Helper_Criteria::userMatchesCriteria($privacyGroup['user_criteria'], true, $viewingUser);
    }

    return parent::canTagUser($user, $errorPhraseKey, $viewingUser);
}
}