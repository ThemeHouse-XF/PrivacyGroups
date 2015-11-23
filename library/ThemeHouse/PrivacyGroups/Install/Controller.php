<?php

class ThemeHouse_PrivacyGroups_Install_Controller extends ThemeHouse_Install
{

    protected $_resourceManagerUrl = 'http://xenforo.com/community/resources/privacy-groups.1752/';

    protected function _getTables()
    {
        return array(
            'xf_privacy_group' => array(
                'privacy_group_id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY', /* END 'privacy_group_id' */
                'active' => 'TINYINT(4) NOT NULL DEFAULT 1', /* END 'active' */
                'user_criteria' => 'MEDIUMBLOB NOT NULL', /* END 'user_criteria' */
                'privacy_options' => 'MEDIUMBLOB NOT NULL', /* END 'privacy_options' */
            ), /* END 'xf_privacy_group' */
        );
    } /* END _getTables */

    protected function _getTableChanges()
    {
        return array(
            'xf_user_privacy' => array(
                'allow_view_profile_group' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0', /* END 'allow_view_profile_group' */
                'allow_post_profile_group' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0', /* END 'allow_post_profile_group' */
                'allow_send_personal_conversation_group' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0', /* END 'allow_send_personal_conversation_group' */
                'allow_view_identities_group' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0', /* END 'allow_view_identities_group' */
                'allow_receive_news_feed_group' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0', /* END 'allow_receive_news_feed_group' */
                'allow_view_blog_group' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0', /* END 'allow_receive_news_feed_group' */
            ), /* END 'xf_user_privacy' */
        );
    } /* END _getTableChanges */

    protected function _getEnumValues()
    {
        return array(
            'xf_user_privacy' => array(
                'allow_view_profile' => array(
                    'add' => array(
                        'group'
                    ), /* END 'add' */
                ), /* END 'allow_view_profile' */
                'allow_post_profile' => array(
                    'add' => array(
                        'group'
                    ), /* END 'add' */
                ), /* END 'allow_post_profile' */
                'allow_send_personal_conversation' => array(
                    'add' => array(
                        'group'
                    ), /* END 'add' */
                ), /* END 'allow_send_personal_conversation' */
                'allow_view_identities' => array(
                    'add' => array(
                        'group'
                    ), /* END 'add' */
                ), /* END 'allow_view_identities' */
                'allow_receive_news_feed' => array(
                    'add' => array(
                        'group'
                    ), /* END 'add' */
                ), /* END 'allow_receive_news_feed' */
                'allow_view_blog' => array(
                    'add' => array(
                        'group'
                    ), /* END 'add' */
                ), /* END 'allow_view_blog' */
            ), /* END 'xf_user_privacy' */
        );
    } /* END _getEnumValues */

    protected function _preUninstall()
    {
        $this->_deletePrivacyGroupPhrases();
    } /* END _preUninstall */

    protected function _deletePrivacyGroupPhrases()
    {
        /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
        $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

        /* @var $phraseModel XenForo_Model_Phrase */
        $phraseModel = $this->getModelFromCache('XenForo_Model_Phrase');

        $privacyGroups = $privacyGroupModel->getPrivacyGroups();

        $phraseTitles = array();
        foreach ($privacyGroups as $privacyGroupId => $privacyGroup) {
            $phraseTitles[] = 'privacy_group_title_' . $privacyGroupId;
        }

        if ($phraseTitles) {
            $phraseModel->deleteMasterPhrases($phraseTitles);
        }
    } /* END _deletePrivacyGroupPhrases */
}