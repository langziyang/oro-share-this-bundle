<?php

namespace Jinber\Bundle\ShareThisBundle\Layout\Extension;

use Jinber\Bundle\ShareThisBundle\Provider\ShareThisSettingsProviderInterface;
use Oro\Component\Layout\ContextConfiguratorInterface;
use Oro\Component\Layout\ContextInterface;

class ShareThisContextConfigurator implements ContextConfiguratorInterface
{
    private ShareThisSettingsProviderInterface $settingsProvider;

    public function __construct(ShareThisSettingsProviderInterface $settingsProvider)
    {
        $this->settingsProvider = $settingsProvider;
    }

    public function configureContext(ContextInterface $context)
    {
        if ($property_id = $this->settingsProvider->getShareThisSetting('property_id')) {
            $context->getResolver()->setDefault('share_this_script', '');
            $context->getResolver()->setDefault('share_this_display_inline', false);
            $context->set('share_this_script', 'https://platform-api.sharethis.com/js/sharethis.js#property=' .
                $property_id . '&product=sticky-share-buttons');
            $context->set('share_this_display_inline',$this->settingsProvider->getShareThisSetting('display_inline'));
        }
    }
}