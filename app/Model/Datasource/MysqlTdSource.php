<?php
/**
 * MySQL layer for DBO with Triple DES password encryption
 *
 */

App::uses('Mysql', 'Model/Datasource/Database');
App::uses('TripleDES', 'Lib');

class MysqlTdSource extends Mysql {

	public function connect() {

		// Triple DES and Base64 encoded password
		if (isset($this->config['password']))
			$this->config['password'] = TripleDES::decryptBase64( $this->config['password'] );

		parent::connect();
	}
}