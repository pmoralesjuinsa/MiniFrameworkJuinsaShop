<?php

use Phinx\Migration\AbstractMigration;

class AttributesValuesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $users = $this->table('attributes_values');
        $users->addColumn('id_product_attribute', 'integer');
        $users->addColumn('id_product', 'integer');
        $users->addColumn('id_product_attribute_value', 'integer');
        $users->addColumn('created_at', 'datetime');
        $users->addColumn('updated_at', 'datetime', ['null' => true]);
        $users->addForeignKey('id_product_attribute', 'product_attributes', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']);
        $users->addForeignKey('id_product', 'products', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']);
        $users->addForeignKey('id_product_attribute_value', 'product_attribute_values', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION']);
        $users->create();
    }
}
