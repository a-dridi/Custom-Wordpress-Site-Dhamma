<?php
/**
 * Template part for displaying posts category "Bibliotheque" ("Library") (NL).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */
require '../dhamma_bibliotheque_categories.php';

$post_id = get_the_ID();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="library-item">
		<div class="library-header">
			<?php	the_title( '<h2 class="library-title" itemprop="headline"><a href="/nl/bibliotheek-item?item=' . $post_id . '" rel="bookmark">', '</a></h2>' ); ?>
		</div>
		<div class="library-desc">
			<div class="library-desc-category">
				<span class="library-desc-heading">Categorie: </span>
				<span><?php echo get_bibliotheque_categoy_name_nl( get_the_terms( $post->id, 'bibliotheque_category' )[0]->term_id ); ?></span>
			</div>
			<div class="library-desc-author">
				<span class="library-desc-heading">Auteur: </span>
				<span><?php echo get_post_meta( $post_id, 'author', true ); ?></span>
			</div>
			<div class="library-desc-editor">
				<span class="library-desc-heading">Editor: </span>
				<span><?php echo get_post_meta( $post_id, 'editor', true ); ?></span>
			</div>
			<div class="library-desc-year">
				<span class="library-desc-heading">Jaar (Original Edition): </span>
				<span><?php echo get_post_meta( $post_id, 'yearoriginal', true ); ?></span>
				<span> • </span>
				<span class="library-desc-heading">Jaar (Huidig Edition): </span>
				<span><?php echo get_post_meta( $post_id, 'yearcurrent', true ); ?></span>
			</div>
		</div>
	</div>
</div><!-- #post-## -->
