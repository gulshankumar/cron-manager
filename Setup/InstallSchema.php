<?php

/**
 * This file is part of GulshanDev_CronManager Module
 * 
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface {

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;

        $installer->startSetup();
        $flashSaleTableName = $installer->getTable('cron_schedule_jobs');
        if ($installer->getConnection()->isTableExists($flashSaleTableName) != true) {
            $table = $installer->getConnection()
                    ->newTable($installer->getTable($flashSaleTableName))
                    ->addColumn(
                            'row_id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'ID'
                    )
                    ->addColumn(
                            'job_code', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => ''], 'Job Code'
                    )
                    ->addColumn(
                            'job_group', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => ''], 'Job Group'
                    )
                    ->addColumn(
                            'cron_expression', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => ''], 'Cron Expression'
                    )
                    ->addColumn(
                            'status', Table::TYPE_INTEGER, 2, ['nullable' => false, 'default' => 1], 'Cron Status'
                    )
                    ->addColumn(
                            'updated_at', Table::TYPE_DATETIME, null, ['nullable' => true], 'Udated At'
                    )
                    ->addIndex('job_code', ['job_code'])
                    ->setComment('Installed cron jobs');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }

}
