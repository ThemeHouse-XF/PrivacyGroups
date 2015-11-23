<?php

/**
 *
 * @see XenForo_Model_User
 */
class ThemeHouse_PrivacyGroups_Extend_XenForo_Model_UserProfile extends XFCP_ThemeHouse_PrivacyGroups_Extend_XenForo_Model_UserProfile
{

    /**
     *
     * @see XenForo_Model_User::canStartUserWithUser()
     */
    public function canViewFullUserProfile(array $user, &$errorPhraseKey = '', array $viewingUser = null)
    {
        $user = ThemeHouse_PrivacyGroups_Helper_PrivacyGroup::updatePrivacyRequirement($user, 'allow_view_profile');

        return parent::canViewFullUserProfile($user, $errorPhraseKey, $viewingUser);
    } /* END canViewFullUserProfile */

    /**
     *
     * @see XenForo_Model_User::canPostOnProfile()
     */
    public function canPostOnProfile(array $user, &$errorPhraseKey = '', array $viewingUser = null)
    {
        $user = ThemeHouse_PrivacyGroups_Helper_PrivacyGroup::updatePrivacyRequirement($user, 'allow_post_profile');

        return parent::canPostOnProfile($user, $errorPhraseKey, $viewingUser);
    } /* END canPostOnProfile */

    /**
     *
     * @see XenForo_Model_User::canPostOnProfile()
     */
    public function canViewRecentActivity(array $user, &$errorPhraseKey = '', array $viewingUser = null)
    {
        $user = ThemeHouse_PrivacyGroups_Helper_PrivacyGroup::updatePrivacyRequirement($user, 'allow_receive_news_feed');

        return parent::canViewRecentActivity($user, $errorPhraseKey, $viewingUser);
    } /* END canViewRecentActivity */

    /**
     *
     * @see XenForo_Model_User::canPostOnProfile()
     */
    public function canViewIdentities(array $user, &$errorPhraseKey = '', array $viewingUser = null)
    {
        $user = ThemeHouse_PrivacyGroups_Helper_PrivacyGroup::updatePrivacyRequirement($user, 'allow_view_identities');

        return parent::canViewIdentities($user, $errorPhraseKey, $viewingUser);
    } /* END canViewIdentities */
}