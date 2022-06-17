<?php
namespace Forever\Megamenu\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('forever_megamenu'))
            ->addColumn(
                'megamenu_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Megamenu ID'
            )
            ->addColumn('cat_id', Table::TYPE_TEXT, 255, ['nullable' => true], 'Cat Id')
            ->addColumn('top', Table::TYPE_TEXT, 255, ['nullable' => true], 'content top')
            ->addColumn('right', Table::TYPE_TEXT, 255, ['nullable' => true], 'content right')
            ->addColumn('bottom', Table::TYPE_TEXT, 255, ['nullable' => true], 'content bottom')
            ->addColumn('left', Table::TYPE_TEXT, 255, ['nullable' => true], 'content right')
            ->addColumn('stores', Table::TYPE_TEXT, 255, ['nullable' => true], 'Stores')
            ->addColumn('status', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Status')
            ->setComment('Forever Megamenu');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
