<?php
if (!defined('_GNUBOARD_')) exit;

function na_db_set() {

	$engine = '';
	if(in_array(strtolower(G5_DB_ENGINE), array('innodb', 'myisam'))){
		$engine = 'ENGINE='.G5_DB_ENGINE;
	}

	$charset = 'CHARSET=utf8';
	if(G5_DB_CHARSET !== 'utf8'){
		 $charset = 'CHARACTER SET '.get_db_charset(G5_DB_CHARSET);
	}

	return $engine.' DEFAULT '.$charset;
}

?>