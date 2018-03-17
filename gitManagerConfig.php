<?php
ini_set ( 'display_errors', 1 );

error_reporting ( E_ALL );
class GitSettings {
	public static $_gitRepoPath = "/opt/git/";
	public static $_gitClonesPath = "/var/www/html/git/";
	public static $_gitClonePrefix = "ssh://user@something/";

	public static $_adminEmails = array("email1@something.com");
}

?>
