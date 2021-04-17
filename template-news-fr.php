<?php
/**
 * Template Name: News-FR
 * Template to display news page.
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<header class="page-header">
			<h1 class="main-title">
				<?php
					echo ucfirst( "Actualité" );
				?>
			</h1>
		</header><!-- .page-header -->

		<?php
		if ( is_active_sidebar( 'above-page-container-widget' ) ) :
			?>
		<div id="dhamma-page-above-widget-area-container" class="dhamma-page-container-above-widget-area widget-area"
			role="complementary">
			<?php dynamic_sidebar( 'above-page-container-widget' ); ?>
		</div>

		<?php endif; ?>
		<?php echo the_content(); ?>
		<br>

		<div class="news-content">

			<?php
					$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
					$args       = array(
						'nopaging'       => false,
						'paged'          => $paged,
						'posts_per_page' => '10',
						'post_type'      => 'post',
						'tax_query'      => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'term_id',
								'terms'    => 779,
							),
						),
					);
					$news_query = new WP_Query( $args );

					if ( $news_query->have_posts() ) :
						?>

						<?php
						/* Start the Loop */
						while ( $news_query->have_posts() ) :
							$news_query->the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-news', get_post_format() );
                            echo "<br><br>";
						endwhile;

						$GLOBALS['wp_query']->max_num_pages = $news_query->max_num_pages;
						the_posts_pagination(
							array(
								'mid_size'           => 1,
								'prev_text'          => __( '< Retour', 'green' ),
								'next_text'          => __( '> Suivant', 'green' ),
								'screen_reader_text' => __( 'Posts navigation' ),
							)
						);


		                else :

			            echo '<br>';

		                endif;
		                ?>
		</div>

		<?php
		if ( is_active_sidebar( 'below-page-container-widget' ) ) :
			?>
		<div id="dhamma-page-below-widget-area-container" class="dhamma-page-container-below-widget-area widget-area"
			role="complementary">
			<?php dynamic_sidebar( 'below-page-container-widget' ); ?>
		</div>

		<?php endif; ?>



	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
