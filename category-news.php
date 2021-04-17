<?php
/**
 * The template for displaying category "news" (EN).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */

get_header(); ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	   
		<h1 class="main-title">
				<?php
					single_term_title();
				?>
		</h1>	

		<?php
		if ( is_active_sidebar( 'above-page-container-widget' ) ) :
			?>
						<div id="dhamma-page-above-widget-area-container" class="dhamma-page-container-above-widget-area widget-area" role="complementary">
			<?php dynamic_sidebar( 'above-page-container-widget' ); ?>
						</div>

				<?php endif; ?>	

			<?php
			// Display page content of news page
			$post   = get_post( 3721 );
			$output = apply_filters( 'the_content', $post->post_content );
			?>

			<?php echo $output; ?>

			<?php
			wp_reset_query();
			?>
						
		<br>
		<div class="news-content">

		<?php
		if ( have_posts() ) :
			?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-news', get_post_format() );

			endwhile;

			the_posts_pagination(
				array(
					'prev_text'          => __( 'Prev', 'business-one-page' ),
					'next_text'          => __( 'Next', 'business-one-page' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'business-one-page' ) . ' </span>',
				)
			);

		else :

			get_template_part( 'template-parts/content-news', 'none' );

		endif;
		?>
		</div>
		<?php
		if ( is_active_sidebar( 'below-page-container-widget' ) ) :
			?>
						<div id="dhamma-page-below-widget-area-container" class="dhamma-page-container-below-widget-area widget-area" role="complementary">
				  <?php dynamic_sidebar( 'below-page-container-widget' ); ?>
						</div>
			
			<?php endif; ?>		


		</main><!-- #main -->
	</div><!-- #primary -->
			
<?php
get_sidebar();
get_footer();
