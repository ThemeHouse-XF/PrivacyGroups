<?php

/**
 * Controller to manage user group privacy groups.
 */
class ThemeHouse_PrivacyGroups_ControllerAdmin_PrivacyGroup extends XenForo_ControllerAdmin_Abstract
{

    protected function _preDispatch($action)
    {
        $this->assertAdminPermission('privacyGroup');
    } /* END _preDispatch */

    /**
     * Displays a list of privacy groups.
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionIndex()
    {
        $viewParams = array(
            'privacyGroups' => $this->_getPrivacyGroupModel()->preparePrivacyGroups(
                $this->_getPrivacyGroupModel()
                    ->getPrivacyGroups())
        );
        return $this->responseView('ThemeHouse_PrivacyGroups_ViewAdmin_PrivacyGroup_List',
            'th_privacy_group_list_privacygroups', $viewParams);
    } /* END actionIndex */

    /**
     * Gets the add/edit form response for a privacy group.
     *
     * @param array $privacyGroup
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    protected function _getPrivacyGroupAddEditResponse(array $privacyGroup)
    {
        $viewParams = array(
            'privacyGroup' => $privacyGroup,
            'userCriteria' => XenForo_Helper_Criteria::prepareCriteriaForSelection($privacyGroup['user_criteria']),
            'userCriteriaData' => XenForo_Helper_Criteria::getDataForUserCriteriaSelection(),
            'privacyOptions' => $this->_getPrivacyGroupModel()->getPrivacyOptions($privacyGroup['privacy_options'])
        );

        return $this->responseView('ThemeHouse_PrivacyGroups_ViewAdmin_PrivacyGroup_Edit',
            'th_privacy_group_edit_privacygroups', $viewParams);
    } /* END _getPrivacyGroupAddEditResponse */

    /**
     * Displays a form to add a new privacy group.
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionAdd()
    {
        return $this->_getPrivacyGroupAddEditResponse(
            array(
                'title' => '',
                'active' => 1,
                'user_criteria' => array(),
                'privacy_options' => array()
            ));
    } /* END actionAdd */

    /**
     * Displays a form to edit an existing privacy group.
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionEdit()
    {
        $privacyGroupId = $this->_input->filterSingle('privacy_group_id', XenForo_Input::UINT);
        $privacyGroup = $this->_getPrivacyGroupModel()->preparePrivacyGroup(
            $this->_getPrivacyGroupOrError($privacyGroupId));

        return $this->_getPrivacyGroupAddEditResponse($privacyGroup);
    } /* END actionEdit */

    /**
     * Saves a privacy group.
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionSave()
    {
        $this->_assertPostOnly();

        $privacyGroupId = $this->_input->filterSingle('privacy_group_id', XenForo_Input::UINT);

        $dwInput = $this->_input->filter(
            array(
                'active' => XenForo_Input::UINT,
                'privacy_options' => array(
                    XenForo_Input::STRING,
                    'array' => true
                ),
                'user_criteria' => XenForo_Input::ARRAY_SIMPLE
            ));

        $dw = XenForo_DataWriter::create('ThemeHouse_PrivacyGroups_DataWriter_PrivacyGroup');
        if ($privacyGroupId) {
            $dw->setExistingData($privacyGroupId);
        }
        $dw->setExtraData(ThemeHouse_PrivacyGroups_DataWriter_PrivacyGroup::DATA_TITLE,
            $this->_input->filterSingle('title', XenForo_Input::STRING));
        $dw->bulkSet($dwInput);
        $dw->save();

        return $this->responseRedirect(XenForo_ControllerResponse_Redirect::SUCCESS,
            XenForo_Link::buildAdminLink('privacy-groups') . $this->getLastHash($dw->get('privacy_group_id')));
    } /* END actionSave */

    /**
     * Deletes a privacy_group.
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionDelete()
    {
        if ($this->isConfirmedPost()) {
            return $this->_deleteData('ThemeHouse_PrivacyGroups_DataWriter_PrivacyGroup', 'privacy_group_id',
                XenForo_Link::buildAdminLink('privacy-groups'));
        } else {
            $privacyGroupId = $this->_input->filterSingle('privacy_group_id', XenForo_Input::UINT);
            $privacyGroup = $this->_getPrivacyGroupOrError($privacyGroupId);

            $viewParams = array(
                'privacy_group' => $privacyGroup
            );

            return $this->responseView('ThemeHouse_PrivacyGroups_ViewAdmin_PrivacyGroup_Delete',
                'th_privacy_group_delete_privacygroups', $viewParams);
        }
    } /* END actionDelete */

    /**
     * Selectively enables or disables specified privacy groups
     *
     * @return XenForo_ControllerResponse_Abstract
     */
    public function actionToggle()
    {
        return $this->_getToggleResponse($this->_getPrivacyGroupModel()
            ->getPrivacyGroups(), 'ThemeHouse_PrivacyGroups_DataWriter_PrivacyGroup', 'privacy-groups');
    } /* END actionToggle */

    /**
     * Gets the specified privacy_group or throws an exception.
     *
     * @param string $id
     *
     * @return array
     */
    protected function _getPrivacyGroupOrError($id)
    {
        return $this->getRecordOrError($id, $this->_getPrivacyGroupModel(), 'getPrivacyGroupById',
            'th_requested_privacy_group_not_found_privacygroups');
    } /* END _getPrivacyGroupOrError */

    /**
     *
     * @return ThemeHouse_PrivacyGroups_Model_PrivacyGroup
     */
    protected function _getPrivacyGroupModel()
    {
        return $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');
    } /* END _getPrivacyGroupModel */
}