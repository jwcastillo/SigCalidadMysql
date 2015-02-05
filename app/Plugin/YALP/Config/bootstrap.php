<?php

/**
 * Yet Another LDAP Plugin
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, Jose Valecillos.
 * @link http://jvalecillos.net
 * @author Jose Valecillos <valecillosjg@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

	App::uses('CakeLog', 'Log');
	//App::uses('PhpReader', 'Configure');
	
	//Configure::load('ldap');

Configure::write('LDAP.server', 'ldap://tpr.bancaribe:3268/DC=bancaribe');
Configure::write('LDAP.port', '3268');
Configure::write('LDAP.user', 'BANCARIBE\bcsoapre');
// Triple DES and Base64 encoded password
Configure::write('LDAP.password', 'el9PHdm5M/oVQI1v4VgFow==');
//Configure::write('LDAP.password', 'Mqrs5246');
// Base DN for searching under
Configure::write('LDAP.base_dn', 'OU=BANCARIBE,DC=tpr,DC=bancaribe');
// This is an LDAP filter that will be used to look up user objects by username.
// %USERNAME% will be replaced by the username entered by the user.
// Therefore, you can do things like proxyAddresses lookup to find
// a user by any of their email addresses.
Configure::write('LDAP.user_filter', '(&(objectClass=User) (sAMAccountName=%USERNAME%))');
Configure::write('LDAP.user_wide_filter', '(& (objectClass=User) (| (sAMAccountName=%USERNAME%*) (givenName=%USERNAME%*) (sn=%USERNAME%*) ) )');
// Form fields - we're expecting a username and password,
// but the form data might call them e.g. 'email' and 'password'
Configure::write('LDAP.form_fields',  array('username' => 'username', 'password' => 'password'));
// LDAP fields to retrieve by default
Configure::write('LDAP.ldap_attribs', array('samaccountname','givenname', 'sn', 'mail', 'department'));
// Database model for users
Configure::write('LDAP.db_model', "User");
// LDAP filter to look up for group membership
Configure::write('LDAP.group_filter',  
	'(&(objectCategory=User) (memberOf=CN=%GROUPNAME%, OU=Grupos Comunes,'. Configure::read('LDAP.base_dn') . '))');
	
?>