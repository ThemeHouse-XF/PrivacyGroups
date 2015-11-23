<?php

class ThemeHouse_PrivacyGroups_Listener_TemplatePostRender extends ThemeHouse_Listener_TemplatePostRender
{

    protected function _getTemplates()
    {
        return array(
            'account_privacy',
            'option_list',
            'sonnb_xengallery_account_privacy'
        );
    } /* END ThemeHouse_PrivacyGroups_Listener_TemplatePostRender::_getTemplates() */

    public static function templatePostRender($templateName, &$content, array &$containerData,
        XenForo_Template_Abstract $template)
    {
        $templatePostRender = new ThemeHouse_PrivacyGroups_Listener_TemplatePostRender($templateName, $content,
            $containerData, $template);
        list ($content, $containerData) = $templatePostRender->run();
    } /* END templatePostRender */

    protected function _accountPrivacy()
    {
        $viewParams = $this->_fetchViewParams();

        foreach ($viewParams['privacyOptions'] as $privacyOption) {
            $viewParams['privacyOption'] = $privacyOption['value'];
            $pattern = '#(<select name="' . $privacyOption['value'] . '"[^>]*>.*)(</select>)#Us';
            $replacement = '${1}' . $this->_render('th_privacy_option_privacygroups', $viewParams) . '${2}';
            $this->_patternReplace($pattern, $replacement);
        }
    } /* END _accountPrivacy */

    protected function _optionList()
    {
        $viewParams = $this->_fetchViewParams();

        /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
        $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

        $viewParams['privacyOptions'] = $privacyGroupModel->getPrivacyOptions();

        $viewParams['privacyGroups'] = $privacyGroupModel->preparePrivacyGroups($privacyGroupModel->getPrivacyGroups());
        foreach ($viewParams['privacyOptions'] as $privacyOption) {
            $viewParams['privacyOption'] = $privacyOption['value'];
            if (isset($privacyOption['option']) && isset($viewParams['preparedOptions'][$privacyOption['option']])) {
                $viewParams['privacyOptionValue'] = $viewParams['preparedOptions'][$privacyOption['option']]['option_value'];
                $pattern = '#(<select name="options\[' . $privacyOption['option'] . '\]"[^>]*>.*)(</select>)#Us';
                $replacement = '${1}' . $this->_render('th_privacy_option_privacygroups', $viewParams) . '${2}';
                $this->_patternReplace($pattern, $replacement);
            }
        }
    } /* END _optionList */

    protected function _sonnbXengalleryAccountPrivacy()
    {
        $viewParams = $this->_fetchViewParams();

        /* @var $privacyGroupModel ThemeHouse_PrivacyGroups_Model_PrivacyGroup */
        $privacyGroupModel = $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');

        $viewParams['privacyOptions'] = $privacyGroupModel->getPrivacyOptions();

        $viewParams['privacyGroups'] = $privacyGroupModel->preparePrivacyGroups($privacyGroupModel->getPrivacyGroups());

        foreach ($viewParams['privacyOptions'] as $privacyOption) {
            $viewParams['privacyOption'] = $privacyOption['value'];
            $pattern = '#(<select name="' . $privacyOption['value'] . '"[^>]*>.*)(</select>)#Us';
            $replacement = '${1}' . $this->_render('th_xengallery_privacy_option_privacygroups', $viewParams) .
                 '${2}';
            $this->_patternReplace($pattern, $replacement);
        }
    } /* END _sonnbXengalleryAccountPrivacy */ /* END _accountPrivacy */
}