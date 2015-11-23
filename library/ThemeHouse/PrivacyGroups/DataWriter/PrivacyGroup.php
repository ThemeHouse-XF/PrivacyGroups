<?php

/**
 * Data writer for privacy groups
 */
class ThemeHouse_PrivacyGroups_DataWriter_PrivacyGroup extends XenForo_DataWriter
{

    /**
     * Constant for extra data that holds the value for the phrase
     * for the title of this canned observation.
     *
     * This value is required on inserts.
     *
     * @var string
     */
    const DATA_TITLE = 'title';

    /**
     * Title of the phrase that will be created when a call to set the
     * existing data fails (when the data doesn't exist).
     *
     * @var string
     */
    protected $_existingDataErrorPhrase = 'th_requested_privacy_group_not_found_privacygroups';

    /**
     * Gets the fields that are defined for the table.
     * See parent for explanation.
     *
     * @return array
     */
    protected function _getFields()
    {
        return array(
            'xf_privacy_group' => array(
                'privacy_group_id' => array(
                    'type' => self::TYPE_UINT, /* END 'type' */
                    'autoIncrement' => true, /* END 'autoIncrement' */
                ), /* END 'privacy_group_id' */
                'active' => array(
                    'type' => self::TYPE_UINT, /* END 'type' */
                    'default' => 1, /* END 'default' */
                ), /* END 'active' */
                'user_criteria' => array(
                    'type' => self::TYPE_UNKNOWN, /* END 'type' */
                    'required' => true, /* END 'required' */
                    'verification' => array(
                        '$this',
                        '_verifyCriteria'
                    ), /* END 'verification' */
                ), /* END 'user_criteria' */
                'privacy_options' => array(
                    'type' => self::TYPE_UNKNOWN, /* END 'type' */
                    'required' => true, /* END 'required' */
                    'verification' => array(
                        '$this',
                        '_verifyPrivacyOptions'
                    ), /* END 'verification' */
                    'requiredError' => 'th_please_select_at_least_one_privacy_option_privacygroups', /* END 'requiredError' */
                ), /* END 'privacy_options' */
            ), /* END 'xf_privacy_group' */
        );
    } /* END _getFields */

    /**
     * Gets the actual existing data out of data that was passed in.
     * See parent for explanation.
     *
     * @param mixed
     *
     * @return array false
     */
    protected function _getExistingData($data)
    {
        if (!$id = $this->_getExistingPrimaryKey($data)) {
            return false;
        }

        return array(
            'xf_privacy_group' => $this->_getPrivacyGroupModel()->getPrivacyGroupById($id)
        );
    } /* END _getExistingData */

    /**
     * Gets SQL condition to update the existing record.
     *
     * @return string
     */
    protected function _getUpdateCondition($tableName)
    {
        return 'privacy_group_id = ' . $this->_db->quote($this->getExisting('privacy_group_id'));
    } /* END _getUpdateCondition */

    /**
     * Pre-save handling.
     */
    protected function _preSave()
    {
        $phrase = $this->getExtraData(self::DATA_TITLE);
        if ($phrase !== null && strlen($phrase) == 0) {
            $this->error(new XenForo_Phrase('please_enter_valid_title'), 'title');
        }
    } /* END _preSave */

    /**
     * Post-save handling.
     */
    protected function _postSave()
    {
        $titlePhrase = $this->getExtraData(self::DATA_TITLE);
        if ($titlePhrase !== null) {
            $this->_insertOrUpdateMasterPhrase('privacy_group_title_' . $this->get('privacy_group_id'), $titlePhrase);
        }
    } /* END _postSave */

    /**
     * Post-delete handling.
     */
    protected function _postDelete()
    {
        $this->_deleteMasterPhrase('privacy_group_title_' . $this->get('privacy_group_id'));
    } /* END _postDelete */

    /**
     * Verifies that the criteria is valid and formats is correctly.
     * Expected input format: [] with children: [rule] => name, [data] => info
     *
     * @param array|string $criteria Criteria array or serialize string; see
     * above for format. Modified by ref.
     *
     * @return boolean
     */
    protected function _verifyCriteria(&$criteria)
    {
        $criteriaFiltered = XenForo_Helper_Criteria::prepareCriteriaForSave($criteria);
        $criteria = serialize($criteriaFiltered);

        if (!$criteriaFiltered) {
            $this->error(new XenForo_Phrase('please_select_criteria_that_must_be_met'), 'user_criteria');
            return false;
        } else {
            return true;
        }
    } /* END _verifyCriteria */

    /**
     * Verifies the privacy options.
     *
     * @param array|string $privacyOptions Array or comma-delimited list
     *
     * @return boolean
     */
    protected function _verifyPrivacyOptions(&$privacyOptions)
    {
        if (!is_array($privacyOptions)) {
            if ($privacyOptions === '') {
                return true;
            }
            $privacyOptions = preg_split('#,\s*#', $privacyOptions);
        }

        if (!$privacyOptions) {
            $privacyOptions = '';
            return true;
        }

        $privacyOptions = array_unique($privacyOptions);
        sort($privacyOptions, SORT_ASC);
        $privacyOptions = implode(',', $privacyOptions);

        return true;
    } /* END _verifyPrivacyOptions */

    /**
     *
     * @return ThemeHouse_PrivacyGroups_Model_PrivacyGroup
     */
    protected function _getPrivacyGroupModel()
    {
        return $this->getModelFromCache('ThemeHouse_PrivacyGroups_Model_PrivacyGroup');
    } /* END _getPrivacyGroupModel */
}