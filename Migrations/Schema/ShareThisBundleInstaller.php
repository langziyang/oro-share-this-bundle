<?php

namespace Jinber\Bundle\ShareThisBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class ShareThisBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createOroIntegrationTransportTable($schema);
    }



    /**
     * Create oro_integration_transport table
     *
     * @param Schema $schema
     */
    protected function createOroIntegrationTransportTable(Schema $schema)
    {
        $table = $schema->createTable('oro_integration_transport');
        $table->addColumn('share_this_property_id', 'string', ['notnull' => false, 'length' => 24]);
        $table->addColumn('share_this_display_inline', 'boolean', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
    }
}