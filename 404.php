<?php

/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>
<?php get_header(); ?>

<div class="row">
	<section id="page" class="span7">
		<?php (have_posts()) ? (have_posts()) : the_post(); ?>
		<h1><?php _e('Page Not Found', 'twentyten'); ?></h1>
		<p><?php _e('We\'re so sorry, but the page you are looking for has either moved or does not exist. Maybe searching for something else will help.', 'twentyten'); ?></p>
		<?php get_search_form(); ?>
	</section><!--end page-->

	<?php include('sidebar-page.php'); ?>
</div><!--end row-->

<?php include('sidebar-footer.php'); ?>

<?php get_footer(); ?>