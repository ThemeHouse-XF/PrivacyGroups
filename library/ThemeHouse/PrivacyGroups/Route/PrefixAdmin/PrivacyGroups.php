<?php

/**
 * Route prefix handler for privacy groups in the admin control panel.
 */
class ThemeHouse_PrivacyGroups_Route_PrefixAdmin_PrivacyGroups implements XenForo_Route_Interface
{

    /**
     * Match a specific route for an already matched prefix.
     *
     * @see XenForo_Route_Interface::match()
     */
    public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
    {
        $action = $router->resolveActionWithIntegerParam($routePath, $request, 'privacy_group_id');
        return $router->getRouteMatch('ThemeHouse_PrivacyGroups_ControllerAdmin_PrivacyGroup', $action,
            'thPrivacyGroups');
    } /* END match */

    /**
     * Method to build a link to the specified page/action with the provided
     * data and params.
     *
     * @see XenForo_Route_BuilderInterface
     */
    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        return XenForo_Link::buildBasicLinkWithIntegerParam($outputPrefix, $action, $extension, $data,
            'privacy_group_id', 'title');
    } /* END buildLink */
}