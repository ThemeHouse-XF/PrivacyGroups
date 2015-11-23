<?php

/**
 *
 * @see XenForo_Model_User
 */
class ThemeHouse_PrivacyGroups_Extend_XenForo_Model_User extends XFCP_ThemeHouse_PrivacyGroups_Extend_XenForo_Model_User
{

    /**
     *
     * @see XenForo_Model_User::passesPrivacyCheck()
     */
    public function passesPrivacyCheck($privacyRequirement, array $user, array $viewingUser = null)
    {
        if (!parent::passesPrivacyCheck($privacyRequirement, $user, $viewingUser)) {
            return false;
        }

        $privacyRequirementParts = explode('_', $privacyRequirement);

        if (count($privacyRequirementParts) != 2) {
            return true;
        }

        list ($privacyRequirement, $privacyGroupId) = $privacyRequirementParts;

        if ($privacyRequirement != 'group') {
            return true;
        }

        /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
        $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

        $privacyGroup = $privacyGroupModel->getPrivacyGroupById($privacyGroupId);

        if (!$privacyGroup) {
            return true;
        }

        return XenForo_Helper_Criteria::userMatchesCriteria($privacyGroup['user_criteria'], true, $viewingUser);
    } /* END passesPrivacyCheck */
}