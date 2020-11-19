<?php
    /*
    Plugin Name: Syncline E-commerce
    Plugin URI: 
    description: To add, edit and delete products
    Version: 1.0
    Author: Sami
    Author URI: 
    License: GPL2
    */


    // register_activation_hook( __FILE__, 'db_install' );
    // // register_activation_hook( __FILE__, 'add_initial_data' );
    // function db_install() {
    //     global $wpdb;
    //     $table_name = $wpdb->prefix . 'products';
    //     $pf_parts_db_version = '1.0.0';
    //     $charset_collate = $wpdb->get_charset_collate();
    
    //     if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
    
    //         $sql = "CREATE TABLE $table_name (
    //                         id mediumint(9) NOT NULL AUTO_INCREMENT,
    //                         title varchar(30) NOT NULL,
    //                         product_description varchar(200) NOT NULL,
    //                         image_url varchar(100) NOT NULL,
    //                         sale_price varchar(9) NOT NULL,
    //                         regular_price varchar(9) NOT NULL,
    //                         PRIMARY KEY  (id)
    //                         ) $charset_collate;";
    
    //         require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //         dbDelta( $sql );
    //         add_option( 'pf_parts_db_version', $pf_parts_db_version );
    //     }
    // }

// function add_initial_data() {
// 	global $wpdb;
	
// 	$title = 'Shoes';
//     $description = 'Congratulations, you just completed the installation!';
//     $image = 'https://www.pngarts.com/files/2/Shoes-Transparent-Background-PNG.png';
//     $sale_price = '100.00';
//     $regular_price = '75.00';
	
// 	$table_name = $wpdb->prefix . 'products';
	
// 	$wpdb->insert( 
// 		$table_name, 
// 		array( 
// 			'title' => $title, 
// 			'product_description' => $description, 
//             'image_url' => $image,
//             'sale_price' => $sale_price,
//             'regular_price' => $regular_price,
// 		) 
// 	);
// }


// add_action( 'rest_api_init', function () {
//     register_rest_route( 'restos/v1', '/all', array(
//         'methods' => 'GET',
//         'callback' => 'handle_get_all',
//         'permission_callback' => function () {
//             return current_user_can( 'edit_others_posts' );
//         }
//     ) );
// } );

// add_action( 'rest_api_init', function () {
//     register_rest_route( 'syncline-ecommerce/v1', '/products', array(
//         'methods' => 'GET',
//         'callback' => 'handle_get_all',
//     ) );
// } );

// function handle_get_all( $data ) {
//     global $wpdb;
//     $query = "SELECT * FROM `syncline_products`";
//     $list = $wpdb->get_results($query);
//     return $list;
// }

add_action( 'init', 'product_custom' );
add_filter( 'post_updated_messages', 'product_messages' );

function product_custom() {
    $labels = array(
        'name'               => 'Products',
        'singular_name'      => 'Product',
        'menu_name'          => 'Products',
        'name_admin_bar'     => 'Products',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Product',
        'new_item'           => 'New Product',
        'edit_item'          => 'Edit Product',
        'view_item'          => 'View Product',
        'all_items'          => 'All Product',
        'search_items'       => 'Search Products',
        'parent_item_colon'  => 'Parent Product:',
        'not_found'          => 'No products found.',
        'not_found_in_trash' => 'No product found in Trash.',
        'set_featured_image' => 'Set product Image',
        'featured_image'     => 'Product Image'
    );

    $args = array( 
        'public'      => true, 
        'labels'      => $labels,
        'rewrite'       => array( 'slug' => 'product' ),
        'has_archive'   => true,
        'menu_position' => 20,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'show_in_rest'  => true,
    );
        register_post_type( 'product', $args );
}

function product_messages( $messages ) {
    $post = get_post();

    $messages['recipe'] = array(
        0  => '',
        1  => 'Product updated.',
        2  => 'Custom field updated.',
        3  => 'Custom field deleted.',
        4  => 'Product updated.',
        5  => isset( $_GET['revision'] ) ? sprintf( 'Product restored to revision from %s',wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => 'Product published.',
        7  => 'Product saved.',
        8  => 'Product submitted.',
        9  => sprintf(
            'Product scheduled for: <strong>%1$s</strong>.',
            date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) )
        ),
        10 => 'Product draft updated.'
    );

    return $messages;
}
add_action('rest_api_init', 'register_rest_images' );
function register_rest_images(){
    register_rest_field( array('post'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}
?>