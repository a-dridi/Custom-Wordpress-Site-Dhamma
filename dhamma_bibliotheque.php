<?php

/**
 * IMPLEMENTATION OF BIBLIOTHEQUE 1/3 - Post type
 */
function dhamma_setup_bibliotheque_post_type() {

	$labels = array(
		'name'               => _x( 'Bibliotheque', 'post type general name' ),
		'singular_name'      => _x( 'Bibliotheque', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Bibliotheque Item' ),
		'add_new_item'       => __( 'Add New' ),
		'edit_item'          => __( 'Edit Item' ),
		'new_item'           => __( 'New Item' ),
		'all_items'          => __( 'All Bibliotheque Items' ),
		'view_item'          => __( 'View Bibliotheque' ),
		'search_items'       => __( 'Search Bibliotheque' ),
		'not_found'          => __( 'No item found' ),
		'not_found_in_trash' => __( 'No item found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Bibliotheque',
	);

	// args - Settings for post type
	$args = array(
		'labels'               => $labels,
		'description'          => 'Book items and other media items that is available in the Bibliotheque (Library)',
		'public'               => true,
		'menu_position'        => 4,
		'menu_icon'            => 'dashicons-book',
		'supports'             => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'          => true,
		'register_meta_box_cb' => 'dhamma_setup_bibliotheque_post_fields',
		'taxonomies'           => array( 'bibliotheque_category' ),
	);

	register_post_type( 'bibliotheque', $args );
}
add_action( 'init', 'dhamma_setup_bibliotheque_post_type' );


/**
 * IMPLEMENTATION OF BIBLIOTHEQUE 2/3 - Categories for Post type
 */
function dhamma_setup_bibliotheque_taxonomy() {
	$labels = array(
		'name'              => _x( 'Bibliotheque Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Bibliotheque Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Bibliotheque Categories' ),
		'all_items'         => __( 'All Bibliotheque Categories' ),
		'parent_item'       => __( 'Parent Bibliotheque Category' ),
		'parent_item_colon' => __( 'Parent Bibliotheque Category:' ),
		'edit_item'         => __( 'Edit Bibliotheque Category' ),
		'update_item'       => __( 'Update Bibliotheque Category' ),
		'add_new_item'      => __( 'Add New Bibliotheque Category' ),
		'new_item_name'     => __( 'New Bibliotheque Category' ),
		'menu_name'         => __( ' Bibliotheque Categories' ),
	);

		// Options
		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
		);

		register_taxonomy( 'bibliotheque_category', 'bibliotheque', $args );
}
add_action( 'init', 'dhamma_setup_bibliotheque_taxonomy', 0 );

/**
 * Add bibliotheque categories filter to admin bibliotheque list.
 */
add_action(
	'restrict_manage_posts',
	function ( $post_type, $which ) {
		if ( 'top' === $which && 'bibliotheque' === $post_type ) {
			$taxonomy = 'bibliotheque_category';
			$tax      = get_taxonomy( $taxonomy );            // get taxonomy object/data
			$cat      = filter_input( INPUT_GET, $taxonomy ); // get selected category slug

			echo '<label class="screen-reader-text" for="bibliotheque_category">Filter by ' .
			esc_html( $tax->labels->singular_name ) . '</label>';

			wp_dropdown_categories(
				array(
					'show_option_all' => $tax->labels->all_items,
					'hide_empty'      => 0, // include categories that have no posts
					'hierarchical'    => $tax->hierarchical,
					'show_count'      => 0, // do not show the category's posts count
					'orderby'         => 'name',
					'selected'        => $cat,
					'taxonomy'        => $taxonomy,
					'name'            => $taxonomy,
					'value_field'     => 'slug',
				)
			);
		}
	},
	10,
	2
);

/**
 * IMPLEMENTATION OF BIBLIOTHEQUE 3/3 - Post special fields - Meta info for bibliotheque post. 2x Meta box and its HTML
 */

function dhamma_setup_bibliotheque_post_fields() {
	add_meta_box(
		'dhamma_bibliotheque_author',
		'Author / Auteur / Schrijver',
		'dhamma_bibliotheque_author',
		'bibliotheque',
		'side',
		'default'
	);

	add_meta_box(
		'dhamma_bibliotheque_editor',
		'Editor / Editeur / Redacteur',
		'dhamma_bibliotheque_editor',
		'bibliotheque',
		'side',
		'default'
	);

	add_meta_box(
		'dhamma_bibliotheque_yearoriginal',
		'Original Edition / Edition originale / Originele Editie',
		'dhamma_bibliotheque_yearoriginal',
		'bibliotheque',
		'side',
		'default'
	);

	add_meta_box(
		'dhamma_bibliotheque_yearcurrent',
		'Current edition / Edition actuelle / Huidige editie',
		'dhamma_bibliotheque_yearcurrent',
		'bibliotheque',
		'side',
		'default'
	);

}

function dhamma_bibliotheque_author() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'bibliotheque_fields' );
	$author = get_post_meta( $post->ID, 'author', true );

	echo '<input type="text" name="author" value="' . esc_textarea( $author ) . '" class="widefat">';
}

function dhamma_bibliotheque_editor() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'bibliotheque_fields' );
	$editor = get_post_meta( $post->ID, 'editor', true );

	echo '<input type="text" name="editor" value="' . esc_textarea( $editor ) . '" class="widefat">';
}

function dhamma_bibliotheque_yearoriginal() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'bibliotheque_fields' );
	$yearoriginal = get_post_meta( $post->ID, 'yearoriginal', true );

	echo '<input type="text" name="yearoriginal" value="' . esc_textarea( $yearoriginal ) . '" class="widefat">';
}

function dhamma_bibliotheque_yearcurrent() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'bibliotheque_fields' );
	$yearcurrent = get_post_meta( $post->ID, 'yearcurrent', true );

	echo '<input type="text" name="yearcurrent" value="' . esc_textarea( $yearcurrent ) . '" class="widefat">';
}


/**
 * Save values of a bibliotheque post meta box in the db
 */
function dhamma_save_bibliotheque_metabox( $post_id, $post ) {
	// Check Permission
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// Security check
	if ( ! isset( $_POST['author'] ) || ! wp_verify_nonce( $_POST['bibliotheque_fields'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// Sanitize input and get all meta values for bibliotheque post
	$bibliotheque_meta['author']       = esc_textarea( $_POST['author'] );
	$bibliotheque_meta['editor']       = esc_textarea( $_POST['editor'] );
	$bibliotheque_meta['yearoriginal'] = esc_textarea( $_POST['yearoriginal'] );
	$bibliotheque_meta['yearcurrent']  = esc_textarea( $_POST['yearcurrent'] );

	// Go to through all post meta fields and save them ("author", "year", etc.)
	foreach ( $bibliotheque_meta as $key => $value ) :

		if ( 'revision' === $post->post_type ) {
			return;
		}

		if ( get_post_meta( $post_id, $key, false ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value );
		}

		if ( ! $value ) {
			delete_post_meta( $post_id, $key );
		}

	endforeach;
}
add_action( 'save_post', 'dhamma_save_bibliotheque_metabox', 1, 2 );
