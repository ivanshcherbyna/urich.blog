<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
		<?php wp_head(); ?>
        <?php global $mytheme, $post;   ?>
	</head>
	<body <?php body_class(); ?>>

    <header>
        <nav class='header-navbar navbar navbar-default'>
            <div class="container">
                <div class="navbar-header">
                    <img src="<?= $mytheme['logo-header-img']['url'] ?>" alt="logo">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!empty($mytheme['menu-repeater-items'])): foreach ($mytheme['menu-repeater-items'] as $menuItem): ?>
                        <li role="presentation" class=""><a href="<?= $mytheme['menu-link'] ?>" role="button"><b><?= $menuItem['menu-title'] ?></b></a></li>
                        <?php endforeach;
                        endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
	<!-- wrapper -->



