<?php


function websecuritytools_admin_template($layoutId) {
  $layoutfile = dirname(__FILE__).DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR.$layoutId.'.php';
  
  if (file_exists($layoutfile)) {
      require_once($layoutfile);
  } else {
      wp_die( __('Page layout not found.') );
  }
}
function websecuritytools_cleaner_url() {
    return "#";
}

function websecuritytools_add_admin_menu() {	
  add_management_page('Web Security Tools', 'WebSec Scan', 'manage_options', 'websecuritytools-admin-main-page', 'websecuritytools_admin_scanpage_page');  	
}

add_action('admin_menu', 'websecuritytools_add_admin_menu');

function websecuritytools_admin_main_page() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	websecuritytools_admin_template("main");  
}

function websecuritytools_admin_scanpage_page() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	websecuritytools_admin_template("scanpage");  
}
