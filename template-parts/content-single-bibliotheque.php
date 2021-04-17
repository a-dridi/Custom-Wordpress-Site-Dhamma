<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */
$post_id  = get_the_ID();
$post_uri = $_SERVER['HTTP_REFERER'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    echo $post_uri;

	if ( is_single() ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="post-thumbnail">';
				is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'business-one-page-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'business-one-page-full', array( 'itemprop' => 'image' ) );
			echo ' </div>';
		}
	} else {
		?>
    <a href="<?php the_permalink(); ?>" class="post-thumbnail">
        <?php
				if ( has_post_thumbnail() ) {
					is_active_sidebar( 'right-sidebar' ) ? the_post_thumbnail( 'business-one-page-cat-blog', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'business-one-page-full', array( 'itemprop' => 'image' ) );
				} else {
					is_active_sidebar( 'right-sidebar' ) ? business_one_page_get_fallback_svg( 'business-one-page-cat-blog', array( 'itemprop' => 'image' ) ) : business_one_page_get_fallback_svg( 'business-one-page-full', array( 'itemprop' => 'image' ) );
				}
				?>
    </a>
    <?php
	}
	?>

    <div class="text-holder">
        <header class="entry-header">
            <?php
			if ( 'post' === get_post_type() ) :
				?>
            <div class="entry-meta">
                <?php business_one_page_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
			endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
        </header><!-- .entry-header -->

        <div class="entry-content" itemprop="text">

            <div class="library-desc">
                <div class="library-desc-category">
                    <span class="library-desc-heading">
                        <?php
							if ( strpos( $post_uri, 'fr' ) ) {
								echo 'Catégorie:';
							} elseif ( strpos( $post_uri, 'nl' ) ) {
								echo 'Categorie:';
							} else {
								echo 'Category:';
							}
							?>
                    </span>
                    <span><?php echo get_the_terms( $post->id, 'bibliotheque_category' )[0]->name; ?></span>
                </div>
                <div class="library-desc-author">
                    <span class="library-desc-heading">
                        <?php
                                if ( strpos( $post_uri, 'fr' ) ) {
                                    echo 'Auteur:';
                                } elseif ( strpos( $post_uri, 'nl' ) ) {
                                    echo 'Auteur:';
                                } else {
                                    echo 'Author:';
                                }
                                ?>
                    </span>
                    <span><?php echo get_post_meta( $post_id, 'author', true ); ?></span>
                </div>
                <div class="library-desc-year">
                    <span class="library-desc-heading">
                        <?php
                                if ( strpos( $post_uri, 'fr' ) ) {
                                    echo 'Année:';
                                } elseif ( strpos( $post_uri, 'nl' ) ) {
                                    echo 'Jaar:';
                                } else {
                                    echo 'Year:';
                                }
                                ?>
                    </span>
                    <span><?php echo get_post_meta( $post_id, 'year', true ); ?></span>
                </div>
            </div>
            <?php
			if ( is_single() ) {
				the_content(
					sprintf(
					/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'business-one-page' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					)
				);
			} else {
				$format = get_post_format();
				if ( false === $format ) {
					the_excerpt();
					?>
            <a href="<?php the_permalink(); ?>"
                class="btn-readmore"><?php esc_html_e( 'Read More', 'business-one-page' ); ?></a>
            <?php
				} else {
					the_content();
				}
			}
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-one-page' ),
						'after'  => '</div>',
					)
				);
				?>
        </div><!-- .entry-content -->

        <?php if ( is_single() ) { ?>
        <footer class="entry-footer">
            <?php business_one_page_entry_footer(); ?>
        </footer><!-- .entry-footer -->



        <?php } ?>
    </div><!-- .text-holder -->

</article><!-- #post-## -->