<?php
/**
 * Template part for displaying posts category "Bibliotheque" ("Library") (EN).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */
include '../dhamma_bibliotheque_categories.php';

$post_id = get_the_ID();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="library-item">
		<div class="library-header">
			<?php	the_title( '<h2 class="library-title" itemprop="headline"><a href="/library-item?item=' . $post_id . '" rel="bookmark">', '</a></h2>' ); ?>
		</div>
		<div class="library-desc">
			<div class="library-desc-category">
				<span class="library-desc-heading">Category: </span>
				<span><?php echo get_bibliotheque_categoy_name_en( get_the_terms( $post->id, 'bibliotheque_category' )[0]->term_id ); ?></span>
			</div>
			<div class="library-desc-author">
				<span class="library-desc-heading">Author: </span>
				<span><?php echo get_post_meta( $post_id, 'author', true ); ?></span>
			</div>
			<div class="library-desc-editor">
				<span class="library-desc-heading">Editor: </span>
				<span><?php echo get_post_meta( $post_id, 'editor', true ); ?></span>
			</div>
			<div class="library-desc-year">
				<span class="library-desc-heading">Year (Original Edition): </span>
				<span><?php echo get_post_meta( $post_id, 'yearoriginal', true ); ?></span>
				<span> • </span>
				<span class="library-desc-heading">Year (Current Edition): </span>
				<span><?php echo get_post_meta( $post_id, 'yearcurrent', true ); ?></span>
			</div>
		</div>
	</div>
</div><!-- #post-## -->
