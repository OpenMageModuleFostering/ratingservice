<?php
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('ratingservice/siteconnect'))
    ->addColumn(
        'id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'auto_increment' => true,
        ),
        'Entity Id'
    )
    ->addColumn('site', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(), 'Site')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_TINYINT, 1, array(
        'nullable' => false,
        'default' => 1,
    ), 'Status')
    ->addColumn('created_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Create date/time');

$installer->getConnection()->createTable($table);

$installer->endSetup();

?>
