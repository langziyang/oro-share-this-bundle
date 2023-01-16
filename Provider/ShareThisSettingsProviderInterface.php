<?php

namespace Jinber\Bundle\ShareThisBundle\Provider;

use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\WebsiteBundle\Entity\Website;

interface ShareThisSettingsProviderInterface
{
    public function getShareThisSettings():array;

    public function getShareThisSetting($identifier);
}