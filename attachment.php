<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */

get_header(); ?>

<div class="row">
	<section id="blog" class="span7">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'twentyten' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">
				<?php
					/* translators: %s - title of parent post */
					printf( __( '<span>«</span> %s', 'twentyten' ), get_the_title( $post->post_parent ) );
				?>
			</a></p>
			<h1><?php the_title(); ?></h1>
			<?php
				printf( __('Published %2$s', 'twentyten'),
				'meta-prep meta-prep-entry-date',
				sprintf( '<abbr title="%1$s">%2$s</abbr>',
				esc_attr( get_the_time() ),
				get_the_date()
				));
				if ( wp_attachment_is_image() ) {
					echo ' | ';
					$metadata = wp_get_attachment_metadata();
					printf( __( 'Full size: %s pixels', 'twentyten'),
					sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
					wp_get_attachment_url(),
					esc_attr( __('Link to full-size image', 'twentyten') ),
					$metadata['width'],
					$metadata['height']));
				}
				?>
			<?php // .entry-meta ?>
		<?php if ( wp_attachment_is_image() ) :
			$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
			foreach ( $attachments as $k => $attachment ) {
			if ( $attachment->ID == $post->ID )
			break;
			}
			$k++;
			// If there is more than 1 image attachment in a gallery
			if ( count( $attachments ) > 1 ) {
			if ( isset( $attachments[ $k ] ) )
				// get the URL of the next image attachment
				$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
			else
			// or get the URL of the first image attachment
				$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID ); }
			else {
			// or, if there's only 1 image attachment, get the URL of the image
				$next_attachment_url = wp_get_attachment_url();
			}
		?>
		<p><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
			<?php
			$attachment_size = apply_filters( 'twentyten_attachment_size', 900 );
			echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
			?>
		</a></p>
	</section><!--end blog-->

<?php include ('sidebar-blog.php'); ?>

<?php comments_template( '', true ); ?>
</div><!--end row-->

<?php include ('sidebar-footer.php'); ?>

<?php get_footer(); ?>
