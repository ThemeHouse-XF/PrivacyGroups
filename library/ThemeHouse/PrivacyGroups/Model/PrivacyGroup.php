<?php

/**
 * Model for privacy groups.
 */
class ThemeHouse_PrivacyGroups_Model_PrivacyGroup extends XenForo_Model
{

    /**
     * Gets a privacy group by its ID.
     *
     * @param integer $id
     *
     * @return array false
     */
    public function getPrivacyGroupById($id)
    {
        return $this->_getDb()->fetchRow('
			SELECT *
			FROM xf_privacy_group
			WHERE privacy_group_id = ?
		', $id);
    } /* END getPrivacyGroupById */

    /**
     * Gets privacy groups matching the specified conditions.
     *
     * @param array $conditions
     *
     * @return array [privacy group id] => info
     */
    public function getPrivacyGroups(array $conditions = array())
    {
        $sqlConditions = array();

        if (isset($conditions['active'])) {
            $sqlConditions[] = 'privacy_group.active = ' . ($conditions['active'] ? 1 : 0);
        }

        $whereClause = $this->getConditionsForClause($sqlConditions);

        return $this->fetchAllKeyed(
            '
			SELECT privacy_group.*
			FROM xf_privacy_group AS privacy_group
			WHERE ' . $whereClause . '
			ORDER BY privacy_group.privacy_group_id
		', 'privacy_group_id');
    } /* END getPrivacyGroups */

    public function preparePrivacyGroup(array $privacyGroup)
    {
        $privacyGroup['title'] = new XenForo_Phrase('privacy_group_title_' . $privacyGroup['privacy_group_id']);

        if ($privacyGroup['privacy_options']) {
            $privacyGroup['privacy_options'] = explode(',', $privacyGroup['privacy_options']);
        }

        return $privacyGroup;
    } /* END preparePrivacyGroup */

    public function preparePrivacyGroups(array $privacyGroups)
    {
        foreach ($privacyGroups as &$privacyGroup) {
            $privacyGroup = $this->preparePrivacyGroup($privacyGroup);
        }

        return $privacyGroups;
    } /* END preparePrivacyGroups */

    public function getPrivacyOptions($selected = array())
    {
        $privacyOptions = array(
            array(
                'label' => new XenForo_Phrase('view_your_details_on_your_profile_page'),
                'selected' => in_array('allow_view_profile', $selected),
                'value' => 'allow_view_profile'
            ),
            array(
                'label' => new XenForo_Phrase('post_messages_on_your_profile_page'),
                'selected' => in_array('allow_post_profile', $selected),
                'value' => 'allow_post_profile'
            ),
            array(
                'label' => new XenForo_Phrase('start_conversations_with_you'),
                'selected' => in_array('allow_send_personal_conversation', $selected),
                'value' => 'allow_send_personal_conversation'
            ),
            array(
                'label' => new XenForo_Phrase('view_your_identities'),
                'selected' => in_array('allow_view_identities', $selected),
                'value' => 'allow_view_identities'
            ),
            array(
                'label' => new XenForo_Phrase('receive_your_news_feed'),
                'selected' => in_array('allow_receive_news_feed', $selected),
                'value' => 'allow_receive_news_feed'
            )
        );

        if (ThemeHouse_Listener_ControllerPreDispatch::isAddOnEnabled('xfa_blogs')) {
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('xfa_blogs_permission_view_your_blog'),
                'selected' => in_array('allow_view_blog', $selected),
                'value' => 'allow_view_blog'
            );
        }

        if (ThemeHouse_Listener_ControllerPreDispatch::isAddOnEnabled('sonnb_xengallery')) {
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('sonnb_xengallery_album_default_privacy') . ' - ' .
                     new XenForo_Phrase('sonnb_xengallery_default_who_can_view'),
                    'selected' => in_array('album_allow_view', $selected),
                    'value' => 'album_allow_view',
                    'option' => 'sonnbXG_albumPrivacyView'
            );
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('sonnb_xengallery_album_default_privacy') . ' - ' .
                     new XenForo_Phrase('sonnb_xengallery_default_who_can_comment'),
                    'selected' => in_array('album_allow_comment', $selected),
                    'value' => 'album_allow_comment',
                    'option' => 'sonnbXG_albumPrivacyComment'
            );
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('sonnb_xengallery_album_default_privacy') . ' - ' .
                     new XenForo_Phrase('sonnb_xengallery_default_who_can_download_original_photo'),
                    'selected' => in_array('album_allow_download', $selected),
                    'value' => 'album_allow_download',
                    'option' => 'sonnbXG_albumPrivacyDownload'
            );
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('sonnb_xengallery_album_default_privacy') . ' - ' .
                     new XenForo_Phrase('sonnb_xengallery_default_who_can_add_photo'),
                    'selected' => in_array('album_allow_add_photo', $selected),
                    'value' => 'album_allow_add_photo',
                    'option' => 'sonnbXG_albumPrivacyAdd'
            );
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('sonnb_xengallery_photo_default_privacy') . ' - ' .
                     new XenForo_Phrase('sonnb_xengallery_default_who_can_view'),
                    'selected' => in_array('photo_allow_view', $selected),
                    'value' => 'photo_allow_view',
                    'option' => 'sonnbXG_photoPrivacyView'
            );
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('sonnb_xengallery_photo_default_privacy') . ' - ' .
                     new XenForo_Phrase('sonnb_xengallery_default_who_can_comment'),
                    'selected' => in_array('photo_allow_comment', $selected),
                    'value' => 'photo_allow_comment',
                    'option' => 'sonnbXG_photoPrivacyComment'
            );
            $privacyOptions[] = array(
                'label' => new XenForo_Phrase('sonnb_xengallery_tagging_settings') . ' - ' .
                     new XenForo_Phrase('sonnb_xengallery_who_can_tag_you'),
                    'selected' => in_array('allow_tagging', $selected),
                    'value' => 'allow_tagging'
            );
        }

        return $privacyOptions;
    } /* END getPrivacyOptions */
}