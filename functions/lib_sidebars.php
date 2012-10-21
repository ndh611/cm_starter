<?php
/*********************************************************************************
REGISTER MULTIPLE SIDEBARS
*********************************************************************************/

if ( function_exists('register_sidebars') ):

	//Primary Sidebar
	register_sidebar(array (
		'name'          => 'Primary Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	));

	//Secondary Sidebar
	register_sidebar(array (
		'name'          => 'Secondary Sidebar',
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	));
endif;
?>