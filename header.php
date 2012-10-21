<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset=utf-8>
	
	<title><?php wp_title(''); ?></title>
	<!-- Google Chrome Frame for IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- mobile meta (hooray!) -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	
	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head -->
	
	<!-- HTML5 compatible with IE<9 -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	
	<!-- Pseudo selector for icons font -->
	<!--[if lte IE 7]><script src="lte-ie7.js"></script><![endif]-->
	
	<!-- if this is front-page -->
	<?php if ( is_front_page() ) :?>
	<?php endif; ?>
	
	<!-- if this is home-page (blog) -->
	<?php if ( is_home() ) :?>
	<?php endif; ?>
	
	<!-- if this is page template: page-custom-page.php -->
	<?php if ( is_page_template('page-custom-page.php') ) :?>
	<?php endif; ?>
		
	<!-- drop Google Analytics Here -->
	<!-- end analytics -->
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
	<header>
		<h2><?php bloginfo('name'); ?></h2>
	</header>
	
	<nav id="nav-main">
		<ul>
			<?php
				wp_list_pages( array(
				   'depth'        => 1,
				   'title_li'     => '')
				);
			?>
		</ul>
	</nav>
	
	<div id="breadcrumbs"><?php CM_breadcrumbs('/','You are here: '); ?> </div>
	
	<ul>		
		<li><span aria-hidden="true" data-icon="&#x23;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x25;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x21;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x22;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x26;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x27;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x28;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x29;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x2a;"></span> icon</li>
		<li><span aria-hidden="true" data-icon="&#x2b;"></span> icon</li>
	</ul>
	
	
	