<?php

namespace Jinber\Bundle\ShareThisBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Jinber\Bundle\ShareThisBundle\Entity\ShareThisSettings;

class ShareThisSettingsRepository extends EntityRepository
{
    /**
     * @return ShareThisSettings[]
     */
    public function getEnabledSettings()
    {
        return $this->createQueryBuilder('settings')
            ->innerJoin('settings.channel', 'channel')
            ->andWhere('channel.enabled = true')
            ->getQuery()
            ->getResult();
    }
}