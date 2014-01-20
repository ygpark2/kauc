<?php

class KML
{
	private $error = array();

	function __construct()
	{
		// $script = array_pop(explode('/',$_SERVER['PHP_SELF']));

		$library_directory = substr(__FILE__,0,strrpos(__FILE__,'/'));
		foreach(glob($library_directory . '/Kml/kml_*.php') as $file) {
			require_once($file);
		}
	}
}