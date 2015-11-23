<?php

class ThemeHouse_PrivacyGroups_Helper_PrivacyGroup
{

    /**
     *
     * @param array $user
     * @param string $privacyRequirementName
     * @return array $user
     */
    public static function updatePrivacyRequirement(array $user, $privacyRequirementName)
    {
        if ($user[$privacyRequirementName] == 'group') {
            $user[$privacyRequirementName] = 'group_' . $user[$privacyRequirementName . '_group'];
        }

        return $user;
    } /* END updatePrivacyRequirement */
}