<?php

/*
Plugin Name: ChillThemes Portfolio
Plugin URI: http://chillthemes.com/item/portfolio
Description: Enables a portfolio post type for use in any of our Chill Themes.
Version: 1.0
Author: ChillThemes
Author URI: http://chillthemes.com
Author Email: matt@chillthemes.com
License:

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/* Setup the plugin. */
add_action( 'plugins_loaded', 'chillthemes_portfolio_setup' );

/* Register plugin activation hook. */
register_activation_hook( __FILE__, 'chillthemes_portfolio_activation' );
	
/* Register plugin activation hook. */
register_deactivation_hook( __FILE__, 'chillthemes_portfolio_deactivation' );

/* Plugin setup function. */
function chillthemes_portfolio_setup() {

	/* Define the plugin version. */
	define( 'CHILLTHEMES_PORTFOLIO_VER', '1.0' );

	/* Get the plugin directory URI. */
	define( 'CHILLTHEMES_PORTFOLIO_URI', plugin_dir_url( __FILE__ ) );

	/* Load translations on the backend. */
	if ( is_admin() )
		load_plugin_textdomain( 'chillthemes-portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	/* Register the custom post type. */
	add_action( 'init', 'chillthemes_register_portfolio' );

	/* Register the custom taxonomy. */
	add_action( 'init', 'chillthemes_portfolio_taxonomies' );

	/* Filter the post type columns. */
	add_filter( 'manage_edit-portfolio_columns', 'chillthemes_portfolio_columns' );

	/* Add the post type column. */
	add_action( 'manage_posts_custom_column', 'chillthemes_portfolio_column' );

}

/* Do things on plugin activation. */
function chillthemes_portfolio_activation() {
	flush_rewrite_rules();
}

/* Do things on plugin deactivation. */
function chillthemes_portfolio_deactivation() {
	flush_rewrite_rules();
}

/* Register the post type. */
function chillthemes_register_portfolio() {

	/* Set the post type labels. */
	$portfolio_labels = array(
		'name'					=> __( 'Portfolio', 'ChillThemes' ),
		'singular_name'			=> __( 'Portfolio Item', 'ChillThemes' ),
		'all_items'				=> __( 'Portfolio Items', 'ChillThemes' ),
		'add_new_item'			=> __( 'Add New Portfolio Item', 'ChillThemes' ),
		'edit_item'				=> __( 'Edit Portfolio Item', 'ChillThemes' ),
		'new_item'				=> __( 'New Portfolio Item', 'ChillThemes' ),
		'view_item'				=> __( 'View Portfolio Item', 'ChillThemes' ),
		'search_items'			=> __( 'Search Portfolio', 'ChillThemes' ),
		'not_found'				=> __( 'No portfolio items found', 'ChillThemes' ),
		'not_found_in_trash'	=> __( 'No portfolio items in trash', 'ChillThemes' )
	);

	/* Define the post type arguments. */
	$portfolio_args = array(
		'can_export'		=> true,
		'capability_type'	=> 'post',
		'has_archive'		=> true,
		'labels'			=> $portfolio_labels,
		'menu_icon'			=> CHILLTHEMES_PORTFOLIO_URI . '/images/menu-icon.png',
		'public'			=> true,
		'query_var'			=> 'project',
		'rewrite'			=> array( 'slug' => 'portfolio/item', 'with_front' => false ),
		'supports'			=> array( 'comments', 'custom-fields', 'editor', 'excerpt', 'revisions', 'thumbnail', 'title' )
	);

	/* Register the post type. */
	register_post_type( apply_filters( 'chillthemes_portfolio', 'portfolio' ), apply_filters( 'chillthemes_portfolio_args', $portfolio_args ) );

}

/* Register the post type taxonomies. */
function chillthemes_portfolio_taxonomies() {

	/* Set the taxonomy labels. */
	$role_labels = array(
		'name'							=> __( 'Portfolio Roles', 'ChillThemes' ),
		'singular_name'					=> __( 'Role', 'ChillThemes' ),
		'search_items'					=> __( 'Search Roles', 'ChillThemes' ),
		'all_items'						=> __( 'All Roles', 'ChillThemes' ),
		'edit_item'						=> __( 'Edit Role', 'ChillThemes' ), 
		'update_item'					=> __( 'Update Role', 'ChillThemes' ),
		'add_new_item'					=> __( 'Add New Role', 'ChillThemes' ),
		'new_item_name'					=> __( 'New Role Name', 'ChillThemes' ),
		'parent_item'					=> null,
		'parent_item_colon'				=> null,
		'separate_items_with_commas'	=> __( 'Separate roles with commas. Roles are used to describe the type of services involved in a project. For example: wireframing, designing, and coding.', 'ChillThemes' ),
		'add_or_remove_items'			=> __( 'Add or remove roles', 'ChillThemes' ),
		'choose_from_most_used'			=> __( 'Choose from the most used roles', 'ChillThemes' ),	
		'menu_name'						=> __( 'Portfolio Roles', 'ChillThemes' )
	);

	/* Define the taxonomy arguments. */
	$role_args = array(
		'capabilities' => array(
			'manage_terms'		=> 'manage_categories',
			'edit_terms'		=> 'manage_categories',
			'delete_terms'		=> 'manage_categories',
			'assign_terms'		=> 'edit_posts'
		),
		'labels'				=> $role_labels,
		'public'				=> true,
		'rewrite'				=> array( 'slug' => 'role' ),
		'show_in_nav_menus'		=> false,
		'update_count_callback' => '_update_post_term_count'
	);

	/* Register the post type taxonomy. */
	register_taxonomy( apply_filters( 'chillthemes_portfolio_role_taxonomy', 'role' ), apply_filters( 'chillthemes_portfolio_project', 'portfolio' ), apply_filters( 'chillthemes_portfolio_role_taxonomy_args', $role_args ) );

	/* Set the taxonomy labels. */
	$type_labels = array(
		'name'							=> __( 'Portfolio Types', 'ChillThemes' ),
		'singular_name'					=> __( 'Type', 'ChillThemes' ),
		'search_items'					=> __( 'Search Types', 'ChillThemes' ),
		'all_items'						=> __( 'All Types', 'ChillThemes' ),
		'edit_item'						=> __( 'Edit Type', 'ChillThemes' ), 
		'update_item'					=> __( 'Update Type', 'ChillThemes' ),
		'add_new_item'					=> __( 'Add New Type', 'ChillThemes' ),
		'new_item_name'					=> __( 'New Type Name', 'ChillThemes' ),
		'parent_item'					=> null,
		'parent_item_colon'				=> null,
		'separate_items_with_commas'	=> __( 'Separate types with commas. Types are used to describe the project type. For example: residential, commercial, and government.', 'ChillThemes' ),
		'add_or_remove_items'			=> __( 'Add or remove types', 'ChillThemes' ),
		'choose_from_most_used'			=> __( 'Choose from the most used types', 'ChillThemes' ),	
		'menu_name'						=> __( 'Portfolio Types', 'ChillThemes' )
	);

	/* Define the taxonomy arguments. */
	$type_args = array(
		'capabilities' => array(
			'manage_terms'		=> 'manage_categories',
			'edit_terms'		=> 'manage_categories',
			'delete_terms'		=> 'manage_categories',
			'assign_terms'		=> 'edit_posts'
		),
		'labels'				=> $type_labels,
		'public'				=> true,
		'rewrite'				=> array( 'slug' => 'type' ),
		'show_in_nav_menus'		=> false,
		'update_count_callback' => '_update_post_term_count'
	);

	/* Register the post type taxonomy. */
	register_taxonomy( apply_filters( 'chillthemes_portfolio_type_taxonomy', 'type' ), apply_filters( 'chillthemes_portfolio_project', 'portfolio' ), apply_filters( 'chillthemes_portfolio_type_taxonomy_args', $type_args ) );

}

/* Filter the columns on the custom post type admin screen. */
function chillthemes_portfolio_columns( $columns ) {
	$columns = array(
		'cb'	=> '<input type="checkbox" />',
		'title'	=> __( 'Project Title', 'ChillThemes' ),
		'role'	=> __( 'Project Role', 'ChillThemes' ),
		'type'	=> __( 'Project Type', 'ChillThemes' ),
		'image'	=> __( 'Project Image', 'ChillThemes' )
	);
	return $columns;
}

/* Filter the data on the custom post type admin screen. */
function chillthemes_portfolio_column( $column ) {
	switch( $column ) {

		/* If displaying the 'Image' column. */
		case 'image' :
			$return = '<img src="' . the_post_thumbnail( array( 40, 40 ) ) . '" alt="' . get_the_title() . '" />';
		break;

		/* If displaying the 'Role' column. */
		case 'role' :

			/* Get the terms for the post. */
			$terms = get_the_terms( get_the_ID(), 'role' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$return = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$return[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => 'portfolio', 'portfolio-category' => $term->slug ), get_edit_post_link( get_the_ID() ) ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'portfolio-category', 'portfolio-category' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $return );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Role Assigned', 'ChillThemes' );
			}

		break;

		/* If displaying the 'Type' column. */
		case 'type' :

			/* Get the terms for the post. */
			$terms = get_the_terms( get_the_ID(), 'type' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$return = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$return[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => 'portfolio', 'portfolio-category' => $term->slug ), get_edit_post_link( get_the_ID() ) ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'portfolio-category', 'portfolio-category' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $return );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Type Assigned', 'ChillThemes' );
			}

		break;

		/* Just break out of the switch statement for everything else. */
		default : break;
	}
}

?>