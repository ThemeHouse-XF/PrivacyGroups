<?php

class ThemeHouse_PrivacyGroups_Extend_XfAddOns_Blogs_Model_Blog extends XFCP_ThemeHouse_PrivacyGroups_Extend_XfAddOns_Blogs_Model_Blog
{

    /**
     * Check if the user is authorized to view the blog, per the privacy
     * permissions
     * @param array $blog blog contents
     */
    protected function allowedByPrivacyOptions(array $blog, array $blogPermissions)
    {
        $visitorUserId = XenForo_Visitor::getUserId();
        if ($blog['user_id'] == $visitorUserId) {
            return parent::allowedByPrivacyOptions($blog, $blogPermissions);
        }

        if ($blogPermissions['xfa_blogs_bypass_privacy']) {
            return parent::allowedByPrivacyOptions($blog, $blogPermissions);
        }

        if (empty($blog['allow_view_blog'])) {
            return parent::allowedByPrivacyOptions($blog, $blogPermissions);
        }

        if ($blog['allow_view_blog'] != 'group') {
            return parent::allowedByPrivacyOptions($blog, $blogPermissions);
        }

        if (empty($blog['allow_view_blog_group'])) {
            return true;
        }

        /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
        $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

        $privacyGroup = $privacyGroupModel->getPrivacyGroupById($blog['allow_view_blog_group']);

        if (!$privacyGroup) {
            return true;
        }

        return XenForo_Helper_Criteria::userMatchesCriteria($privacyGroup['user_criteria'], true);
    } /* END allowedByPrivacyOptions */

    protected function getSelectOptions($fetchOptions)
    {
        $select = parent::getSelectOptions($fetchOptions);

        if (!isset($fetchOptions['join'])) {
            return '';
        }
        if ($fetchOptions['join'] & self::JOIN_PRIVACY) {
            $select .= ',user_privacy.allow_view_blog_group';
        }

        return $select;
    } /* END getSelectOptions */
}