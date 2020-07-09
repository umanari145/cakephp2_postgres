<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $persons = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'person_name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'sex' => array('type' => 'smallinteger', 'null' => true, 'default' => null),
		'birth_day' => array('type' => 'date', 'null' => true, 'default' => null),
		'zip' => array('type' => 'string', 'null' => true, 'length' => 7),
		'address_code' => array('type' => 'string', 'null' => true, 'length' => 15),
		'address1' => array('type' => 'string', 'null' => true, 'length' => 100),
		'address2' => array('type' => 'string', 'null' => true, 'length' => 100),
		'contact' => array('type' => 'smallinteger', 'null' => true, 'default' => null),
		'email' => array('type' => 'string', 'null' => true, 'length' => 200),
		'tel' => array('type' => 'string', 'null' => true, 'length' => 15),
		'delivery_zip' => array('type' => 'string', 'null' => true, 'length' => 7),
		'delivery_address1' => array('type' => 'string', 'null' => true, 'length' => 100),
		'delivery_address2' => array('type' => 'string', 'null' => true, 'length' => 100),
		'traffic' => array('type' => 'text', 'null' => true, 'default' => null),
		'contents' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => 1073741824),
		'created_at' => array('type' => 'datetime', 'null' => false, 'default' => 'now()'),
		'updated_at' => array('type' => 'datetime', 'null' => false, 'default' => 'now()'),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $pref = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'pref_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $schema_migrations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'class' => array('type' => 'string', 'null' => false, 'default' => null),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

}
