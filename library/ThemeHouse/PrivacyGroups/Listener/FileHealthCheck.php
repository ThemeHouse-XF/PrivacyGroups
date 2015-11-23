<?php

class ThemeHouse_PrivacyGroups_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/PrivacyGroups/ControllerAdmin/PrivacyGroup.php' => 'c70a558d4d66fca81a601d37fa787341',
                'library/ThemeHouse/PrivacyGroups/DataWriter/PrivacyGroup.php' => 'edba1a5c3f37a2d3f697500ce4ee3049',
                'library/ThemeHouse/PrivacyGroups/Extend/sonnb/XenGallery/Model/Album.php' => '370bff4e47969d959015207ce4f4fa48',
                'library/ThemeHouse/PrivacyGroups/Extend/sonnb/XenGallery/Model/Photo.php' => 'e9db6b92548b91ca3514236f298bca2a',
                'library/ThemeHouse/PrivacyGroups/Extend/sonnb/XenGallery/Model/Tag.php' => '9a88425faadde02e6be410ab68dd4d7e',
                'library/ThemeHouse/PrivacyGroups/Extend/XenForo/ControllerPublic/Account.php' => 'a44ca010043afee01e17b1b1a1df70e8',
                'library/ThemeHouse/PrivacyGroups/Extend/XenForo/DataWriter/User.php' => '6ae0011077d59b207a81ca517a69f6f9',
                'library/ThemeHouse/PrivacyGroups/Extend/XenForo/Model/Conversation.php' => '9ecb8c4e580d840c4cb9c700c4454a3a',
                'library/ThemeHouse/PrivacyGroups/Extend/XenForo/Model/User.php' => 'c6dbaed6774af4900e8680f857beca11',
                'library/ThemeHouse/PrivacyGroups/Extend/XenForo/Model/UserProfile.php' => 'fddea43b9cdbaab6ccf4b0471381a805',
                'library/ThemeHouse/PrivacyGroups/Extend/XfAddOns/Blogs/Model/Blog.php' => '21fbff19a17e214e9640b3e8f6c5de5f',
                'library/ThemeHouse/PrivacyGroups/Helper/PrivacyGroup.php' => 'ffe63ba418d7e9507e954c5e16962e7c',
                'library/ThemeHouse/PrivacyGroups/Install/Controller.php' => 'ed8b186949b67e8987a1cc487c7d29d8',
                'library/ThemeHouse/PrivacyGroups/Listener/LoadClass.php' => '6e49d2070f996d74e9e64d42d451671d',
                'library/ThemeHouse/PrivacyGroups/Listener/TemplatePostRender.php' => '099bfd7ba461aaeabf2d452889641d77',
                'library/ThemeHouse/PrivacyGroups/Model/PrivacyGroup.php' => '8260e157111aa3e8bb2f64f7f3a6f895',
                'library/ThemeHouse/PrivacyGroups/Route/PrefixAdmin/PrivacyGroups.php' => '7a45171974eaf45771597b95099ab637',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
                'library/ThemeHouse/Listener/Template.php' => '0aa5e8aabb255d39cf01d671f9df0091',
                'library/ThemeHouse/Listener/Template/20150106.php' => '8d42b3b2d856af9e33b69a2ce1034442',
                'library/ThemeHouse/Listener/TemplatePostRender.php' => 'b6da98a55074e4cde833abf576bc7b5d',
                'library/ThemeHouse/Listener/TemplatePostRender/20150106.php' => 'efccbb2b2340656d1776af01c25d9382',
            ));
    }
}