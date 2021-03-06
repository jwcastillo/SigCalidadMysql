
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

/**
 * LDAP Settings
 *
 */
$config['LDAP']['server'] = '';
$config['LDAP']['port'] = '';
$config['LDAP']['user'] = '';
// Triple DES and Base64 encoded password
$config['LDAP']['password'] = '';
//$config['LDAP']['password'] = '';
// Base DN for searching under
$config['LDAP']['base_dn'] = '';
// This is an LDAP filter that will be used to look up user objects by username.
// %USERNAME% will be replaced by the username entered by the user.
// Therefore, you can do things like proxyAddresses lookup to find
// a user by any of their email addresses.
$config['LDAP']['user_filter'] = "(&(objectClass=User) (sAMAccountName=%USERNAME%))";
$config['LDAP']['user_wide_filter'] = "(& (objectClass=User) (| (sAMAccountName=%USERNAME%*) (givenName=%USERNAME%*) (sn=%USERNAME%*) ) )";
// Form fields - we're expecting a username and password,
// but the form data might call them e.g. 'email' and 'password'
$config['LDAP']['form_fields'] = array ('username' => 'username', 'password' => 'password');
// LDAP fields to retrieve by default
$config['LDAP']['ldap_attribs'] = array ('samaccountname','givenname', 'sn', 'mail', 'department');
// Database model for users
$config['LDAP']['db_model'] = "User";
// LDAP filter to look up for group membership
$config['LDAP']['group_filter'] = "(&(objectCategory=User) (memberOf=CN=%GROUPNAME%, OU=Grupos Comunes,". $config['LDAP']['base_dn'] ."))";
