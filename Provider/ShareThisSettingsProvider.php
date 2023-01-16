<?php

namespace Jinber\Bundle\ShareThisBundle\Provider;

use Doctrine\Persistence\ManagerRegistry;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\IntegrationBundle\Entity\Repository\ChannelRepository;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\WebsiteBundle\Entity\Website;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Jinber\Bundle\ShareThisBundle\Entity\ShareThisSettings;

class ShareThisSettingsProvider implements ShareThisSettingsProviderInterface
{

    private ManagerRegistry $registry;
    private ConfigManager $configManager;

    public function __construct(ManagerRegistry $registry, ConfigManager $configManager)
    {
        $this->registry = $registry;
        $this->configManager = $configManager;
    }

    public function getShareThisSettings():array
    {
        $configs = [];
        $settings = $this->getEnabledIntegrationSettings();

        foreach ($settings as $setting) {
            /**
             * @var $entity ShareThisSettings
             */
            $entity=$setting->getChannel()->getTransport();
            $config=[
                'property_id'=>$entity->getPropertyId(),
                'display_inline'=>$entity->getDisplayInline()
            ];
            $configs=$config;
        }
        return $configs;
        /*
        $integrationId = $this->configManager->get('jinber_share_this', false, false, $website);
        if ($integrationId === null) {
            return null;
        }
        $channel = $this->getChannelRepository()->getOrLoadById($integrationId);
        return $channel && $channel->isEnabled() ? $channel->getTransport() : null;
        */
    }

    public function getShareThisSetting($identifier)
    {
        $settings = $this->getShareThisSettings();
        if (false === array_key_exists($identifier, $settings)) {
            return null;
        }
        return $settings[$identifier];
    }

    private function getEnabledIntegrationSettings()
    {
        try {
            $repository = $this->registry
                ->getManagerForClass(ShareThisSettings::class)
                ->getRepository(ShareThisSettings::class);
            return $repository->getEnabledSettings();
        } catch (\UnexpectedValueException $e) {
            return [];
        }
    }

    private function getChannelRepository(): ChannelRepository
    {
        return $this->registry->getRepository(Channel::class);
    }


}