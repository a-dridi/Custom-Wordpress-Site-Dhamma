<?php
/**
 * Template Name: Bibliotheque-Post-EN
 * Template to display a post of bibliotheque section
 */

require_once 'dhamma_bibliotheque_categories.php';

$requested_item = $_GET['item'];

$args       = array(
	'p' => $requested_item,
);
$post_item  = get_post( $requested_item );
$post_title = get_post( $requested_item )->post_title;
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div class="bibliotheque-navbar">
			<?php require_once 'dhamma_en_bibliotheque_categories_menu.php'; ?>
		</div>
		<br>

		<header class="page-header">
			<h1 class="main-title">
				<?php
					echo ucfirst( $post_title );
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


		<?php
		if ( $post_item !== null && $post_item->post_type === 'bibliotheque' ) :
			?>

			<?php

			echo $post_item->post_content;

			?>
		<br><br>
		<div class="library-desc">
			<div class="library-desc-category">
				<span class="library-desc-heading">Category: </span>
				<span><?php echo get_the_terms( $requested_item, 'bibliotheque_category' )[0]->name; ?></span>
			</div>
			<div class="library-desc-author">
				<span class="library-desc-heading">Author: </span>
				<span><?php echo get_post_meta( $requested_item, 'author', true ); ?></span>
			</div>
			<div class="library-desc-editor">
				<span class="library-desc-heading">Editor: </span>
				<span><?php echo get_post_meta( $requested_item, 'editor', true ); ?></span>
			</div>
			<div class="library-desc-year">
				<span class="library-desc-heading">Year (Original Edition): </span>
				<span><?php echo get_post_meta( $requested_item, 'yearoriginal', true ); ?></span>
				<span> • </span>
				<span class="library-desc-heading">Year (Current/Present Edition): </span>
				<span><?php echo get_post_meta( $requested_item, 'yearcurrent', true ); ?></span>
			</div>
		</div>


			<?php

				// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
					endif;

				$exclude_categories = ! empty( get_theme_mod( 'business_one_page_exclude_cat' ) ) ? get_theme_mod( 'business_one_page_exclude_cat' ) : '';

				// the_post_navigation( array( 'excluded_terms' => $exclude_categories ) );

			?>

			<?php
	 else :
		 echo '<h3>Item does not exist!</h3>';
			?>

		<?php endif; ?>


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
