<?php

namespace Jinber\Bundle\ShareThisBundle\Integration;

use Jinber\Bundle\ShareThisBundle\Entity\ShareThisSettings;
use Jinber\Bundle\ShareThisBundle\Form\Type\ShareThisSettingsType;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;

class ShareThisTransport implements TransportInterface
{
    public function init(Transport $transportEntity)
    {

    }

    public function getLabel()
    {
        return 'jinbder.share_this.settings.transport.label';
    }

    public function getSettingsFormType()
    {
        return ShareThisSettingsType::class;
    }

    public function getSettingsEntityFQCN()
    {
        return ShareThisSettings::class;
    }
}