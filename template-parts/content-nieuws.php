<?php
/**
 * Template part for displaying news posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



	<div class="text-holder">
		<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) :
				?>
			<div class="entry-meta">
				<?php business_one_page_posted_on(); ?>
			</div><!-- .entry-meta -->
				<?php
			endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			} else {
				the_title( '<h2 itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->

		<div class="entry-content" itemprop="text">
			<div class="news-date">
				<span class="dashicons dashicons-clock"></span> <?php echo get_the_date(); ?>
			</div>
			<?php
			if ( is_single() ) {
				the_content(
					sprintf(
					/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'business-one-page' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					)
				);
			} else {
				$format = get_post_format();
				if ( false === $format ) {
					the_excerpt();
					?>
			<a href="<?php the_permalink(); ?>" class="btn-readmore news-readmore"><?php esc_html_e( 'Lees meer', 'business-one-page' ); ?></a>
					<?php
				} else {
					the_content();
				}
			}
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-one-page' ),
						'after'  => '</div>',
					)
				);
				?>
		</div><!-- .entry-content -->

		<?php if ( is_single() ) { ?>
		<footer class="entry-footer">
			<?php business_one_page_entry_footer(); ?>
		</footer><!-- .entry-footer -->



		<?php } ?>
	</div><!-- .text-holder -->

</article><!-- #post-## -->
