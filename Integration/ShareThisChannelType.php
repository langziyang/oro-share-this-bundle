<?php

namespace Jinber\Bundle\ShareThisBundle\Integration;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

class ShareThisChannelType implements ChannelInterface,IconAwareIntegrationInterface
{
    const TYPE='jinber_share_this';
    /**
     * 后台设置时返回模块的名称
     * @return string
     */
    public function getLabel()
    {
        return 'jinber.share_this.channel_type.label';
    }

    public function getIcon()
    {
        return 'bundles/sharethis/img/share.png';
    }
}