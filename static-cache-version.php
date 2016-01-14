<?php
/*
Plugin Name: Static Cache File Version
Version: 1.0
Plugin URI: 
Description: Alters the urls for CSS and JS files to include the version number in it.  /file.css?v=123 -> /file.v-123.css requires rewrite rules. 
Author: Tryon Eggleston
*/

if( !is_admin() ){
	add_filter( 'script_loader_src', 'staticcache' );
	add_filter( 'style_loader_src', 'staticcache' );
}

function staticcache($src){

	if ( !preg_match("/". $_SERVER['HTTP_HOST'] ."/", $src) ) return $src;

	preg_match('/\?v(er)?=(.+)/i', $src, $v);

	if( $v ){
		$v = preg_replace("/\D/", "", $v[2]);

		$src = preg_replace('/(.css|.js|.php)(\?v(er)?=)(.+)/', ".v-" . $v . "$1", $src);
	}
	return $src;
}