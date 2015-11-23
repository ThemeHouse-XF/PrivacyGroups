<?php

/**
 *
 * @see XenForo_DataWriter_User
 */
class ThemeHouse_PrivacyGroups_Extend_XenForo_DataWriter_User extends XFCP_ThemeHouse_PrivacyGroups_Extend_XenForo_DataWriter_User
{

    /**
     *
     * @see XenForo_DataWriter_User::_getFields()
     */
    protected function _getFields()
    {
        $fields = parent::_getFields();

        $fields['xf_user_privacy'] = array_merge($fields['xf_user_privacy'],
            array(
                'allow_view_profile_group' => array(
                    'type' => self::TYPE_UINT,
                    'default' => 0
                ),
                'allow_post_profile_group' => array(
                    'type' => self::TYPE_UINT,
                    'default' => 0
                ),
                'allow_send_personal_conversation_group' => array(
                    'type' => self::TYPE_UINT,
                    'default' => 0
                ),
                'allow_view_identities_group' => array(
                    'type' => self::TYPE_UINT,
                    'default' => 0
                ),
                'allow_receive_news_feed_group' => array(
                    'type' => self::TYPE_UINT,
                    'default' => 0
                ),
                'allow_view_blog_group' => array(
                    'type' => self::TYPE_UINT,
                    'default' => 0
                )
            ));

        return $fields;
    } /* END _getFields */

    /**
     *
     * @see XenForo_DataWriter_User::_verifyPrivacyChoice()
     */
    protected function _verifyPrivacyChoice(&$choice, $dw, $fieldName)
    {
        if (is_numeric($choice)) {
            $this->set($fieldName . '_group', $choice);
            $choice = 'group';
            return true;
        } else {
            $this->set($fieldName . '_group', 0);
            return parent::_verifyPrivacyChoice($choice, $dw, $fieldName);
        }
    } /* END _verifyPrivacyChoice */
}