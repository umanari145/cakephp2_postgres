<?php
class AddPref extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_pref';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'pref' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
					'pref_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50),
					'indexes' => array(
						'PRIMARY' => array('unique' => true, 'column' => 'id'),
					),
					'tableParameters' => array(),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'pref'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
