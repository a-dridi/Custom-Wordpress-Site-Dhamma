<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business_One_Page
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		if ( is_active_sidebar( 'above-page-container-widget' ) ) :
			?>
		<div id="dhamma-page-above-widget-area-container" class="dhamma-page-container-above-widget-area widget-area"
			role="complementary">
			<?php dynamic_sidebar( 'above-page-container-widget' ); ?>
		</div>

		<?php endif; ?>

		<?php
		while ( have_posts() ) :
			the_post();
			$post_id = get_the_ID();
			get_template_part( 'template-parts/content', get_post_format() );

			?>

		<div class="library-desc">
			<div class="library-desc-category">
				<span class="library-desc-heading">Category | Catégorie | Categorie: </span>
				<span><?php echo get_the_terms( $post->id, 'bibliotheque_category' )[0]->name; ?></span>
			</div>
			<div class="library-desc-author">
				<span class="library-desc-heading">Author | Auteur | Schrijver: </span>
				<span><?php echo get_post_meta( $post_id, 'author', true ); ?></span>
			</div>
			<div class="library-desc-editor">
				<span class="library-desc-heading">Editor | Editeur | Editor: </span>
				<span><?php echo get_post_meta( $post_id, 'editor', true ); ?></span>
			</div>
			<div class="library-desc-year">
				<span class="library-desc-heading">Year | An | Jaar (Original Edition): </span>
				<span><?php echo get_post_meta( $post_id, 'yearoriginal', true ); ?></span>
				<span> • </span>
				<span class="library-desc-heading">Year | An | Jaar (Current/Present Edition): </span>
				<span><?php echo get_post_meta( $post_id, 'yearcurrent', true ); ?></span>
			</div>
		</div>

			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
				endif;

			$exclude_categories = ! empty( get_theme_mod( 'business_one_page_exclude_cat' ) ) ? get_theme_mod( 'business_one_page_exclude_cat' ) : '';

			the_post_navigation( array( 'excluded_terms' => $exclude_categories ) );

			endwhile; // End of the loop.
		?>

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
