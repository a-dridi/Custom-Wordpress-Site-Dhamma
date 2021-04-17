<?php
/**
 * Template Name: Bibliotheque-Search-FR
 * Load search results for Bibliotheque section
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<?php
			$args                      = '';
			$bibliotheque_search_query = '';
			$searched_value            = sanitize_text_field( $_GET['svalue'] );
			$paged                     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';

			echo '<h5> <a href="/fr/bibliotheque/"> <span class="search-back-button-icon"><</span> <span>Retour</a></span></h5>';
			echo '<h1 class="entry-title">Résultats de la recherche: ' . $searched_value . '</h1>';
			if ( $_GET['stype'] === 'author' ) {
				$args = array(
					'nopaging'       => false,
					'paged'          => $paged,
					'posts_per_page' => '10',
					'post_type'      => 'bibliotheque',
					'meta_key'       => 'author',
					'meta_value'     => $searched_value,
					'meta_compare'   => 'LIKE',
				);
			} elseif ( $_GET['stype'] === 'title' ) {
				$args = array(
					'nopaging'       => false,
					'paged'          => $paged,
					'posts_per_page' => '10',
					'post_type'      => 'bibliotheque',
					's'              => $searched_value,
				);
			} elseif ( $_GET['stype'] === 'category' ) {
				$args = array(
					'nopaging'       => false,
					'paged'          => $paged,
					'posts_per_page' => '10',
					'post_type'      => 'bibliotheque',
					'tax_query'      => array(
						array(
							'taxonomy' => 'bibliotheque_category',
							'field'    => 'slug',
							'terms'    => '%' . $searched_value . '%',
						),
					),
				);
			}

			$bibliotheque_search_query = new WP_Query( $args );
			// Display search results in loop
			if ( $bibliotheque_search_query->have_posts() ) {
				echo '<ol class="library-search-results">';
				if ( $paged == 1 ) {
					$counter = 1;
				} elseif ( $paged == 2 ) {
					$counter = 11;
				} else {
					$counter = $paged * 10 + 1;
				}
				while ( $bibliotheque_search_query->have_posts() ) {
					$bibliotheque_search_query->the_post();
					$post_id = ( get_the_ID() );
					echo '<li><span class="library-search-counter">' . $counter . '. </span> <a href="' . esc_url( get_permalink() ) . '" >' . get_the_title() . '</a><br>';
					echo get_the_terms( $post_id, 'bibliotheque_category' )[0]->name . '  •  ' . get_post_meta( $post_id, 'author', true );
					echo '</li>';
					$counter += 1;
				}
				echo '</ol>';
				echo '<br>';
				echo $bibliotheque_search_query->found_posts . ' résultat(s) trouvé(s). ';
				$GLOBALS['wp_query']->max_num_pages = $bibliotheque_search_query->max_num_pages;
				the_posts_pagination(
					array(
						'mid_size'           => 1,
						'prev_text'          => __( '< Retour', 'green' ),
						'next_text'          => __( '> Suivant', 'green' ),
						'screen_reader_text' => __( 'Posts navigation' ),
					)
				);
			} else {
				 echo '<br><h4>Aucun résultat de recherche trouvé. </h4>';
			}

			/* Restore original Post Data */
			wp_reset_postdata();

			?>

		</main><!-- #main -->
	</div><!-- #primary -->
			
<?php

get_sidebar();
get_footer();

