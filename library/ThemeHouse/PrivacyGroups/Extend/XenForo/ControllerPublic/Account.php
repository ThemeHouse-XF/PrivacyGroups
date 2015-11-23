<?php

/**
 *
 * @see XenForo_ControllerPublic_Account
 */
class ThemeHouse_PrivacyGroups_Extend_XenForo_ControllerPublic_Account extends XFCP_ThemeHouse_PrivacyGroups_Extend_XenForo_ControllerPublic_Account
{

    /**
     *
     * @see XenForo_ControllerPublic_Account::actionPrivacy()
     */
    public function actionPrivacy()
    {
        $response = parent::actionPrivacy();

        if ($response instanceof XenForo_ControllerResponse_View) {
            /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
            $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

            $response->subView->params['privacyOptions'] = $privacyGroupModel->getPrivacyOptions();

            $response->subView->params['privacyGroups'] = $privacyGroupModel->preparePrivacyGroups(
                $privacyGroupModel->getPrivacyGroups());
        }

        return $response;
    } /* END actionPrivacy */

    /**
     *
     * @see XenForo_ControllerPublic_Account::actionPrivacySave()
     */
    public function actionPrivacySave()
    {
        if (ThemeHouse_Listener_ControllerPreDispatch::isAddOnEnabled('xfa_blogs')) {
            try {
                $userId = XenForo_Visitor::getUserId();
                $allowViewBlog = $this->_input->filterSingle('allow_view_blog', XenForo_Input::STRING);
                $allowViewBlogGroup = 0;

                if (is_numeric($allowViewBlog)) {
                    $allowViewBlogGroup = $allowViewBlog;
                    $this->_request->setParam('allow_view_blog', 'group');
                }

                // save the privacy settings
                if ($userId) {
                    $db = XenForo_Application::getDb();
                    $db->query("UPDATE xf_user_privacy SET allow_view_blog_group = ? WHERE user_id = ?",
                        array(
                            $allowViewBlogGroup,
                            $userId
                        ));
                }
            } catch (Exception $ex) {
                XenForo_Error::logException($ex, false);
            }
        }

        return parent::actionPrivacySave();
    } /* END actionPrivacySave */
}