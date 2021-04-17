<?php
/**
 * Template Name: BibliothequeSection
 *
 * The template for bibliotheque section
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<header class="page-header">
			<h1 class="main-title">
				<?php
					single_term_title();
				?>
			</h1>
		</header><!-- .page-header -->

		<ul class="bibliotheque-submenu">
			<?php
			$args       = array( 'child_of' => 729 );
			$categories = get_categories( $args );
			foreach ( $categories as $category ) {
				echo '<li> <a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a> </li>';
			}
			?>
		</ul>

		<form action="/bibliotheque-search" method="post">
			<div class="bibliotheque-search">
				<div>
					<span class="bibliotheque-search-box-heading">Search for: </span><input type="text" name="searchedvalue" id="searchedvalue"><br>
				</div>
				<div>
					<select name="searchtype" id="searchtype">
						<option value="title">Title</option>
						<option value="category">Category</option>
						<option value="author">Author</option>
					</select>
				</div>
				<div>
					<input type="submit" value="Search" class="bibliotheque-search-button">
				</div>
			</div>
		</form>

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
				get_template_part( 'template-parts/content-bibliotheque', get_post_format() );

			endwhile;

			the_posts_pagination(
				array(
					'type'      => 'list',
					'prev_text' => __( 'Prev', 'business-one-page' ),
					'next_text' => __( 'Next', 'business-one-page' ),
				)
			);

		else :

			echo '<h3>No item found!</h3>';

		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
