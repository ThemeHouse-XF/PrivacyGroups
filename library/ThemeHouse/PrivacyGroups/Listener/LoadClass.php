<?php

class ThemeHouse_PrivacyGroups_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_PrivacyGroups' => array(
                'model' => array(
                    'sonnb_XenGallery_Model_Album',
                    'sonnb_XenGallery_Model_Photo',
                    'sonnb_XenGallery_Model_Tag',
                    'XenForo_Model_Conversation',
                    'XenForo_Model_User',
                    'XenForo_Model_UserProfile',
                    'XfAddOns_Blogs_Model_Blog'
                ), /* END 'model' */
                'datawriter' => array(
                    'XenForo_DataWriter_User'
                ), /* END 'datawriter' */
                'controller' => array(
                    'XenForo_ControllerPublic_Account'
                ), /* END 'controller' */
            ), /* END 'ThemeHouse_PrivacyGroups' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_PrivacyGroups_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    } /* END loadClassModel */

    public static function loadClassDataWriter($class, array &$extend)
    {
        $loadClassDataWriter = new ThemeHouse_PrivacyGroups_Listener_LoadClass($class, $extend, 'datawriter');
        $extend = $loadClassDataWriter->run();
    } /* END loadClassDataWriter */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_PrivacyGroups_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */
}