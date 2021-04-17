<?php
/**
 * Template part for displaying posts category "Bibliotheque" ("Library") (FR).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */
$post_id = get_the_ID();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="library-item">
		<div class="library-header">
		<?php	the_title( '<h2 class="library-title" itemprop="headline"><a href="/fr/bibliotheque-item?item=' . $post_id . '" rel="bookmark">', '</a></h2>' ); ?>
		</div>
		<div class="library-desc">
			<div class="library-desc-category">
				<span class="library-desc-heading">Catégorie: </span>
				<span><?php echo get_the_terms( $post->id, 'bibliotheque_category' )[0]->name; ?></span>
			</div>
			<div class="library-desc-author">
				<span class="library-desc-heading">Auteur/e: </span>
				<span><?php echo get_post_meta( $post_id, 'author', true ); ?></span>
			</div>
			<div class="library-desc-editor">
				<span class="library-desc-heading">Editeur: </span>
				<span><?php echo get_post_meta( $post_id, 'editor', true ); ?></span>
			</div>
			<div class="library-desc-year">
				<span class="library-desc-heading">An (Édition originelle): </span>
				<span><?php echo get_post_meta( $post_id, 'yearoriginal', true ); ?></span>
				<span> • </span>
				<span class="library-desc-heading">An (Présente édition): </span>
				<span><?php echo get_post_meta( $post_id, 'yearcurrent', true ); ?></span>
			</div>
		</div>
	</div>
</div><!-- #post-## -->
