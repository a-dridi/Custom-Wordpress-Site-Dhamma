<?php
/**
 * Template Name: Bibliotheque-Category-NL
 * Template to display posts in a GET requested bibliotheque category in the Bibliotheque section
 */

require_once 'dhamma_bibliotheque_categories.php';
$cat_referer_uri    = $_SERVER['HTTP_REFERER'];
$requested_category = $_GET['cat'];

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<header class="page-header">
			<h1 class="main-title">
				<?php
					echo get_bibliotheque_categoy_name_nl( $requested_category );
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

		<div class="bibliotheque-navbar">
		<?php require_once 'dhamma_nl_bibliotheque_categories_menu.php'; ?>
		</div>
		<br>

		<form action="/nl/bibliotheque-zoeken" method="get">
			<div class="bibliotheque-search">
				<div>
					<span class="bibliotheque-search-box-heading">Zoek naar: </span><input type="text"
						name="svalue" id="svalue"><br>
				</div>
				<div>
					<select name="stype" id="stype">
						<option value="title">Titel</option>
						<option value="category">Categorie</option>
						<option value="author">Auteur</option>
					</select>
				</div>
				<div>
					<input type="submit" value="Zoeken op" class="bibliotheque-search-button">
				</div>
			</div>
		</form>

		<?php
		$paged                  = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';
		$args                   = array(
			'nopaging'       => false,
			'paged'          => $paged,
			'posts_per_page' => '10',
			'post_type'      => 'bibliotheque',
			'tax_query'      => array(
				array(
					'taxonomy' => 'bibliotheque_category',
					'field'    => 'term',
					'terms'    => $requested_category,
				),
			),
		);
			$bibliotheque_query = new WP_Query( $args );

		if ( $bibliotheque_query->have_posts() ) :

			/* Start the Loop */
			while ( $bibliotheque_query->have_posts() ) :
				$bibliotheque_query->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-bibliotheek', get_post_format() );

				endwhile;

			$GLOBALS['wp_query']->max_num_pages = $bibliotheque_query->max_num_pages;
			the_posts_pagination(
				array(
					'mid_size'           => 1,
					'prev_text'          => __( '< Terug', 'green' ),
					'next_text'          => __( '> Volgende', 'green' ),
					'screen_reader_text' => __( 'Posts navigation' ),
				)
			);

		else :

			echo '<h3>Geen items gevonden!</h3>';

		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
