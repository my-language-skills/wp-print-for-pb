<?php
/*
 * WordPress Plugin: WP-Print
 * Copyright (c) 2012 Lester "GaMerZ" Chan
 *
 * File Written By:
 * - Lester "GaMerZ" Chan
 * - http://lesterchan.net
 *
 * File Information:
 * - Printer Friendly Post/Page Template
 * - wp-content/plugins/wp-print/print-posts.php
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<!-- <meta name="Robots" content="noindex, nofollow" /> -->
		<link rel=”canonical” href=”<?php the_permalink(); ?>” /><!-- New Cannonical url /> -->
	<?php if(@file_exists(get_stylesheet_directory().'/print-css.css')): ?>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/print-css.css" type="text/css" media="screen, print" />
	<?php elseif(@file_exists(get_template_directory().'/print-css.css')): ?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/print-css.css" type="text/css" media="screen, print" />
	<?php else: ?>
		<link rel="stylesheet" href="<?php echo plugins_url('wp-print/print-css.css'); ?>" type="text/css" media="screen, print" />
	<?php endif; ?>
	<?php if ( is_rtl() ) : ?>
		<?php if(@file_exists(get_stylesheet_directory().'/print-css-rtl.css')): ?>
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/print-css-rtl.css" type="text/css" media="screen, print" />
		<?php else: ?>
			<link rel="stylesheet" href="<?php echo plugins_url('wp-print/print-css-rtl.css'); ?>" type="text/css" media="screen, print" />
		<?php endif; ?>
	<?php endif; ?>
	<link rel="canonical" href="<?php the_permalink(); ?>" />
</head>
<body>

<main role="main" class="center">

	<?php if (have_posts()): ?>

		<header class="entry-header">

			<span class="hat">
				<strong>
					- <?php bloginfo('name'); ?>
					-
					<span dir="ltr"><?php bloginfo('url')?></span>
					-
				</strong>
			</span>

			<?php while (have_posts()): the_post(); ?>

			<h1 class="entry-title">
				<!-- @ADDED: Titles are link to pages -->
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h1>
			<!-- @ADDED: Deleted all the information below the title: Posted by; Date; Comments -->
		</header>

		<?php if(print_can('thumbnail')): ?>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="thumbnail">
					<?php the_post_thumbnail('medium'); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="entry-content">

			<?php print_content(); ?>

		</div>

	<?php endwhile; ?>

	<!-- @ADDED: deleting comments -->


	<footer class="footer">
		<p>
			<?php _e('Article printed from', 'wp-print'); ?>
			<?php bloginfo('name'); ?>:

			<strong dir="ltr">
				<?php bloginfo('url'); ?>
			</strong>
		</p>

		<p>
			<?php _e('URL to article', 'wp-print'); ?>:
			<strong dir="ltr">
				<?php the_permalink(); ?>
			</strong>
		</p>

		<?php if(print_can('links')): ?>
			<p><?php print_links(); ?></p>
		<?php endif; ?>

		<p style="text-align: <?php echo ( is_rtl() ) ? 'left' : 'right'; ?>;" id="print-link">
			<a href="#Print" onclick="window.print(); return false;" title="<?php _e('Click here to print.', 'wp-print'); ?>">
				<?php _e('Click', 'wp-print'); ?>
				<?php _e('here', 'wp-print'); ?>
				<?php _e('to print.', 'wp-print'); ?>
			</a>
		</p>

		<?php else: ?>
			<p>
				<?php _e('No posts matched your criteria.', 'wp-print'); ?>
			</p>
		<?php endif; ?>

		<p style="text-align: center;">
		Copyright © 2020 <a href="https://books4languages.com/">Books4Languages</a>. All rights reserved.<br>
		Educators, <a href="https://books4languages.com/legal/">Some Rights Reserved.</a>
		</p>
	</footer>

</main>


</body>
</html>
