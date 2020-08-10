<?php

use Phinx\Migration\AbstractMigration;

class CreateSampleTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
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
        $sql =<<<EOF
CREATE TABLE persons (
    id  SERIAL PRIMARY KEY,
    person_name varchar(50) DEFAULT '',
    sex smallint DEFAULT NULL,
    birth_day date DEFAULT NULL,
    zip varchar(7)  DEFAULT '',
    address_code varchar(15) DEFAULT '',
    address1 varchar(100) DEFAULT '',
    address2 varchar(100) DEFAULT '',
    contact smallint DEFAULT NULL,
    email varchar(200) DEFAULT '',
    tel varchar(15) DEFAULT '',
    delivery_zip varchar(7) DEFAULT '',
    delivery_address1 varchar(100) DEFAULT '',
    delivery_address2 varchar(100) DEFAULT '',
    traffic text DEFAULT NULL,
    contents text,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    );
    
    
    INSERT INTO persons (person_name, sex) VALUES 
    ('山田太郎',1);
    INSERT INTO persons (person_name, sex) VALUES 
    ('山田花子',2);
EOF;

        $this->execute($sql);

    }
}
