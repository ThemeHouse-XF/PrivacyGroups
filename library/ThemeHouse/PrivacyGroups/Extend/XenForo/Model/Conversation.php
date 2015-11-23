<?php

/**
 *
 * @see XenForo_Model_Conversation
 */
class ThemeHouse_PrivacyGroups_Extend_XenForo_Model_Conversation extends XFCP_ThemeHouse_PrivacyGroups_Extend_XenForo_Model_Conversation
{

    /**
     *
     * @see XenForo_Model_Conversation::canStartConversationWithUser()
     */
    public function canStartConversationWithUser(array $user, &$errorPhraseKey = '', array $viewingUser = null)
    {
        $user = ThemeHouse_PrivacyGroups_Helper_PrivacyGroup::updatePrivacyRequirement($user,
            'allow_send_personal_conversation');

        return parent::canStartConversationWithUser($user, $errorPhraseKey, $viewingUser);
    } /* END canStartConversationWithUser */
}