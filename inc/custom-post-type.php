<?php
/**
* Listing Post Type
*/
if(!function_exists('buy_listing_post_type')){
	function buy_listing_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Buy a Business', 'Business' ),
			'singular_name'			=> esc_html__( 'Buy a Business', 'Business' ),
			'menu_name'				=> esc_html__( 'Buy a Business', 'Business' ),
			'parent_item_colon'		=> esc_html__( 'Parent Buy a Business', 'Business' ),
			'all_items'				=> esc_html__( 'All Business', 'Business' ),
			'view_item'				=> esc_html__( 'View Business', 'Business' ),
			'add_new_item'        	=> esc_html__( 'Add New Business', 'Business' ),
			'add_new'             	=> esc_html__( 'Add New Business', 'Business' ),
			'edit_item'           	=> esc_html__( 'Edit Business', 'Business' ),
			'update_item'         	=> esc_html__( 'Update Business', 'Business' ),
			'search_items'        	=> esc_html__( 'Search Business', 'Business' ),
			'not_found'           	=> esc_html__( 'No Business', 'Business' ),
			'not_found_in_trash'  	=> esc_html__( 'No Business in Trash', 'Business' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-editor-ul',
			'supports'			=> array('title', 'editor', 'comments', 'thumbnail', 'author'),
			//'taxonomies'        => array( 'post_tag' ),
		);

		register_post_type( 'buy', $args );
	}
}
add_action( 'init', 'buy_listing_post_type', 20 );


/**
* category taxonomy for listing post type
*/

if(!function_exists('business_category_taxonomies')){
	function business_category_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => esc_html__( 'Business Category', 'Business' ),
			'singular_name'     => esc_html__( 'Business Category', 'Business' ),
			'search_items'      => esc_html__( 'Search Business Category', 'Business' ),
			'all_items'         => esc_html__( 'All Business Category', 'Business' ),
			'parent_item'       => esc_html__( 'Parent Business Category', 'Business' ),
			'parent_item_colon' => esc_html__( 'Parent Business Business Category:', 'Business' ),
			'edit_item'         => esc_html__( 'Edit Business Category', 'Business' ),
			'update_item'       => esc_html__( 'Update Business Category', 'Business' ),
			'add_new_item'      => esc_html__( 'Add New Business Category', 'Business' ),
			'new_item_name'     => esc_html__( 'New Business Category Name', 'Business' ),
			'menu_name'         => esc_html__( 'Business Category', 'Business' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'business-category' ),
		);

		register_taxonomy( 'business-category', array( 'buy' ), $args );
	}
}
add_action( 'init', 'business_category_taxonomies', 30 );



/**
* Region taxonomy for listing post type
*/

if(!function_exists('business_type_taxonomies')){
	function business_type_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => esc_html__( 'Business Type', 'Business' ),
			'singular_name'     => esc_html__( 'Business Type', 'Business' ),
			'search_items'      => esc_html__( 'Search Business Type', 'Business' ),
			'all_items'         => esc_html__( 'All Business Type', 'Business' ),
			'parent_item'       => esc_html__( 'Parent Business Type', 'Business' ),
			'parent_item_colon' => esc_html__( 'Parent Business Type:', 'Business' ),
			'edit_item'         => esc_html__( 'Edit Business Type', 'Business' ),
			'update_item'       => esc_html__( 'Update Business Type', 'Business' ),
			'add_new_item'      => esc_html__( 'Add New Business Type', 'Business' ),
			'new_item_name'     => esc_html__( 'New Business Type Name', 'Business' ),
			'menu_name'         => esc_html__( 'Business Type', 'Business' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'region' ),
		);

		register_taxonomy( 'business-type', array( 'buy' ), $args );
	}
}

add_action( 'init', 'business_type_taxonomies', 30 );

if(!function_exists('business_feature_taxonomies')){
	function business_feature_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => esc_html__( 'Business feature', 'Business' ),
			'singular_name'     => esc_html__( 'Business feature', 'Business' ),
			'search_items'      => esc_html__( 'Search Business feature', 'Business' ),
			'all_items'         => esc_html__( 'All Business feature', 'Business' ),
			'parent_item'       => esc_html__( 'Parent Business feature', 'Business' ),
			'parent_item_colon' => esc_html__( 'Parent Business feature:', 'Business' ),
			'edit_item'         => esc_html__( 'Edit Business feature', 'Business' ),
			'update_item'       => esc_html__( 'Update Business feature', 'Business' ),
			'add_new_item'      => esc_html__( 'Add New Business feature', 'Business' ),
			'new_item_name'     => esc_html__( 'New Business feature Name', 'Business' ),
			'menu_name'         => esc_html__( 'Business feature', 'Business' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'region' ),
		);

		register_taxonomy( 'business-feature', array( 'buy' ), $args );
	}
}

add_action( 'init', 'business_feature_taxonomies', 30 );

/*****************Franchises Custom Post Type Start*******************/
if(!function_exists('franchise_listing_post_type')){
	function franchise_listing_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Business Franchise', 'Business' ),
			'singular_name'			=> esc_html__( 'Business Franchise', 'Business' ),
			'menu_name'				=> esc_html__( 'Business Franchise', 'Business' ),
			'parent_item_colon'		=> esc_html__( 'Parent Business Franchise', 'Business' ),
			'all_items'				=> esc_html__( 'All Franchise', 'Business' ),
			'view_item'				=> esc_html__( 'View Franchise', 'Business' ),
			'add_new_item'        	=> esc_html__( 'Add New Franchise', 'Business' ),
			'add_new'             	=> esc_html__( 'Add New Franchise', 'Business' ),
			'edit_item'           	=> esc_html__( 'Edit Franchise', 'Business' ),
			'update_item'         	=> esc_html__( 'Update Franchise', 'Business' ),
			'search_items'        	=> esc_html__( 'Search Franchise', 'Business' ),
			'not_found'           	=> esc_html__( 'No Franchise', 'Business' ),
			'not_found_in_trash'  	=> esc_html__( 'No Franchise in Trash', 'Business' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-editor-ul',
			'supports'			=> array('title', 'editor', 'comments', 'thumbnail', 'author'),
			//'taxonomies'        => array( 'post_tag' ),
		);

		register_post_type( 'franchise', $args );
	}
}
add_action( 'init', 'franchise_listing_post_type', 20 );

/**
* category taxonomy for listing post type
*/

if(!function_exists('franchise_category_taxonomies')){
	function franchise_category_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => esc_html__( 'Franchise Category', 'Business' ),
			'singular_name'     => esc_html__( 'Franchise Category', 'Business' ),
			'search_items'      => esc_html__( 'Search Franchise Category', 'Business' ),
			'all_items'         => esc_html__( 'All Franchise Category', 'Business' ),
			'parent_item'       => esc_html__( 'Parent Franchise Category', 'Business' ),
			'parent_item_colon' => esc_html__( 'Parent Franchise Business Category:', 'Business' ),
			'edit_item'         => esc_html__( 'Edit Franchise Category', 'Business' ),
			'update_item'       => esc_html__( 'Update Franchise Category', 'Business' ),
			'add_new_item'      => esc_html__( 'Add New Franchise Category', 'Business' ),
			'new_item_name'     => esc_html__( 'New Franchise Category Name', 'Business' ),
			'menu_name'         => esc_html__( 'Franchise Category', 'Business' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'franchise-category' ),
		);

		register_taxonomy( 'franchise-category', array( 'franchise' ), $args );
	}
}
add_action( 'init', 'franchise_category_taxonomies', 30 );

/*****************Franchises Custom Post Type End*********************/


/*****************Active Buyer Custom Post Type Start*******************/
if(!function_exists('active_buyer_post_type')){
	function active_buyer_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Active Buyer', 'Business' ),
			'singular_name'			=> esc_html__( 'Active Buyer', 'Business' ),
			'menu_name'				=> esc_html__( 'Active Buyer', 'Business' ),
			'parent_item_colon'		=> esc_html__( 'Parent Active Buyer', 'Business' ),
			'all_items'				=> esc_html__( 'All Active Buyer', 'Business' ),
			'view_item'				=> esc_html__( 'View Active Buyer', 'Business' ),
			'add_new_item'        	=> esc_html__( 'Add New Active Buyer', 'Business' ),
			'add_new'             	=> esc_html__( 'Add New Active Buyer', 'Business' ),
			'edit_item'           	=> esc_html__( 'Edit Active Buyer', 'Business' ),
			'update_item'         	=> esc_html__( 'Update Active Buyer', 'Business' ),
			'search_items'        	=> esc_html__( 'Search Active Buyer', 'Business' ),
			'not_found'           	=> esc_html__( 'No Active Buyer', 'Business' ),
			'not_found_in_trash'  	=> esc_html__( 'No Active Buyer in Trash', 'Business' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> true,
			'menu_icon'			=> 'dashicons-editor-ul',
			'supports'			=> array('title', 'editor', 'comments', 'thumbnail', 'author'),
			//'taxonomies'        => array( 'post_tag' ),
		);

		register_post_type( 'active-buyer', $args );
	}
}
add_action( 'init', 'active_buyer_post_type', 20 );

/**
* category taxonomy for listing post type
*/

if(!function_exists('active_buyer_category_taxonomies')){
	function active_buyer_category_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => esc_html__( 'Active Buyer Category', 'Business' ),
			'singular_name'     => esc_html__( 'Active Buyer Category', 'Business' ),
			'search_items'      => esc_html__( 'Search Active Buyer Category', 'Business' ),
			'all_items'         => esc_html__( 'All Active Buyer Category', 'Business' ),
			'parent_item'       => esc_html__( 'Parent Active Buyer Category', 'Business' ),
			'parent_item_colon' => esc_html__( 'Parent Active Buyer Business Category:', 'Business' ),
			'edit_item'         => esc_html__( 'Edit Active Buyer Category', 'Business' ),
			'update_item'       => esc_html__( 'Update Active Buyer Category', 'Business' ),
			'add_new_item'      => esc_html__( 'Add New Active Buyer Category', 'Business' ),
			'new_item_name'     => esc_html__( 'New Active Buyer Category Name', 'Business' ),
			'menu_name'         => esc_html__( 'Active Buyer Category', 'Business' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'buyer-category' ),
		);

		register_taxonomy( 'buyer-category', array( 'active-buyer' ), $args );
	}
}
add_action( 'init', 'active_buyer_category_taxonomies', 30 );

/*****************Franchises Custom Post Type End*********************/







/*****************Business Broker Custom Post Type Start*******************/
/*if(!function_exists('broker_listing_post_type')){
	function broker_listing_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Business Broker', 'Business' ),
			'singular_name'			=> esc_html__( 'Business Broker', 'Business' ),
			'menu_name'				=> esc_html__( 'Business Broker', 'Business' ),
			'parent_item_colon'		=> esc_html__( 'Parent Broker Franchise', 'Business' ),
			'all_items'				=> esc_html__( 'All Broker', 'Business' ),
			'view_item'				=> esc_html__( 'View Broker', 'Business' ),
			'add_new_item'        	=> esc_html__( 'Add New Broker', 'Business' ),
			'add_new'             	=> esc_html__( 'Add New Broker', 'Business' ),
			'edit_item'           	=> esc_html__( 'Edit Broker', 'Business' ),
			'update_item'         	=> esc_html__( 'Update Broker', 'Business' ),
			'search_items'        	=> esc_html__( 'Search Broker', 'Business' ),
			'not_found'           	=> esc_html__( 'No Broker', 'Business' ),
			'not_found_in_trash'  	=> esc_html__( 'No Broker in Trash', 'Business' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-editor-ul',
			'supports'			=> array('title', 'editor', 'comments', 'thumbnail', 'author'),
			//'taxonomies'        => array( 'post_tag' ),
		);

		register_post_type( 'broker', $args );
	}
}
add_action( 'init', 'broker_listing_post_type', 20 );*/

/**
* category taxonomy for listing post type
*/

/*if(!function_exists('broker_category_taxonomies')){
	function broker_category_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => esc_html__( 'Broker Category', 'Business' ),
			'singular_name'     => esc_html__( 'Broker Category', 'Business' ),
			'search_items'      => esc_html__( 'Search Broker Category', 'Business' ),
			'all_items'         => esc_html__( 'All Broker Category', 'Business' ),
			'parent_item'       => esc_html__( 'Parent Broker Category', 'Business' ),
			'parent_item_colon' => esc_html__( 'Parent Broker Category Category:', 'Business' ),
			'edit_item'         => esc_html__( 'Edit Broker Category', 'Business' ),
			'update_item'       => esc_html__( 'Update Broker Category', 'Business' ),
			'add_new_item'      => esc_html__( 'Add New Broker Category', 'Business' ),
			'new_item_name'     => esc_html__( 'New Broker Category Name', 'Business' ),
			'menu_name'         => esc_html__( 'Broker Category', 'Business' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'broker-category' ),
		);

		register_taxonomy( 'broker-category', array( 'broker' ), $args );
	}
}
add_action( 'init', 'broker_category_taxonomies', 30 );*/


/*************metabox field for broker custom post start**********/
/*add_action( 'cmb2_admin_init', 'business_broker_metaboxes' );
function business_broker_metaboxes(){

	 // Start with an underscore to hide fields from custom fields list
	$prefix = '_business_';

	
	$cmb = new_cmb2_box( array(
		'id'            => 'business_broker_metabox',
		'title'         => __( 'Business Broker Metabox', 'cmb2' ),
		'object_types'  => array( 'broker', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Broker Destination', 'cmb2' ),
		'desc'       => __( 'It will show your Business Broker Destination', 'cmb2' ),
		'id'         => $prefix . 'destination',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should 
	) );
	// Location (Full Address)
	$cmb->add_field( array(
			'name'			=> esc_html__( 'Location', 'cmb2' ),
			'id'			=> $prefix . 'location_text',
			'type'			=> 'text',
			'show_on_cb'	=> 'listinger_hide_if_no_cats',
			'show_in_rest' => WP_REST_Server::READABLE,
	) );

	$cmb->add_field( array(
	'name' => esc_html__( 'Phone Number', 'cmb2' ),
	'id'			=> $prefix . 'phone_number',
	'type'			=> 'text',
	'desc'       => __( 'It will show your Business Broker phone number', 'cmb2' ),
    ));

    $cmb->add_field( array(
	'name' => esc_html__( 'Broker Service', 'cmb2' ),
	'id'			=> $prefix . 'broker_service',
	'type'			=> 'text',
	'desc'       => __( 'It will show your Business Broker Service', 'cmb2' ),
    ));

    $cmb->add_field( array(
	'name' => esc_html__( 'Facebook Link', 'cmb2' ),
	'id'			=> $prefix . 'facebook_link',
	'type'			=> 'text',
	'desc'       => __( 'It will show your Business Broker Social Icon', 'cmb2' ),
    ));
    $cmb->add_field( array(
	'name' => esc_html__( 'Twitter Link', 'cmb2' ),
	'id'			=> $prefix . 'twitter_link',
	'type'			=> 'text',
	'desc'       => __( 'It will show your Business Broker Social Icon', 'cmb2' ),
    ));
    $cmb->add_field( array(
	'name' => esc_html__( 'Instagram Link', 'cmb2' ),
	'id'			=> $prefix . 'instagram_link',
	'type'			=> 'text',
	'desc'       => __( 'It will show your Business Broker Social Icon', 'cmb2' ),
    ));
    $cmb->add_field( array(
	'name' => esc_html__( 'LinkedIn Link', 'cmb2' ),
	'id'			=> $prefix . 'linkedin_link',
	'type'			=> 'text',
	'desc'       => __( 'It will show your Business Broker Social Icon', 'cmb2' ),
    ));


}*/

/*************metabox field for broker custom post end************/


/*****************Business Broker Custom Post Type End*********************/


add_action( 'cmb2_admin_init', 'business_buy_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function business_buy_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_business_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'business_metabox',
		'title'         => __( 'Business Metabox', 'cmb2' ),
		'object_types'  => array( 'buy', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );


	/*$group_field_id = $cmb->add_field( array(
	'id'          => 'business_property_features',
	'type'        => 'group',
	'description' => __( 'Generates Business Property Features', 'cmb2' ),
	// 'repeatable'  => false, // use false if you want non-repeatable group
	'options'     => array(
		'group_title'       => __( 'Business Property Features {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
		'add_button'        => __( 'Add Another Entry', 'cmb2' ),
		'remove_button'     => __( 'Remove Entry', 'cmb2' ),
		'sortable'          => true,
		// 'closed'         => true, // true to have the groups closed by default
		// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
	),
) );
	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
$cmb->add_group_field( $group_field_id, array(
	'name' => 'Features Title',
	'id'   => 'title',
	'type' => 'text',
	// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
) );*/

	/*// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Price', 'cmb2' ),
		'desc'       => __( 'It will show your Business price', 'cmb2' ),
		'id'         => $prefix . 'price',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );*/
	/*$cmb->add_field( array(
		'name'       => __( 'Offer Price', 'cmb2' ),
		'desc'       => __( 'It will show your Business offer price', 'cmb2' ),
		'id'         => $prefix . 'offer_price',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );*/
	$cmb->add_field( array(
		'name'       => __( 'Annual Turnover', 'cmb2' ),
		'desc'       => __( 'It will show your Business Annual Turnover', 'cmb2' ),
		'id'         => $prefix . 'annual_turnover',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );
     
    /* // Location (Full Address)
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Location', 'cmb2' ),
			'id'			=> $prefix . 'location_text',
			'type'			=> 'text',
			'show_on_cb'	=> 'listinger_hide_if_no_cats',
			'show_in_rest' => WP_REST_Server::READABLE,
		) );*/
		
	/*$cmb->add_field( array(
			'name'    => esc_html__( 'Time Zone', 'cmb2' ),
			'id'   =>  $prefix . 'time_zone',
			'type'    => 'text',
		) );*/
		

      /* $cmb->add_field( array(
		'name'       => __( 'From Day', 'cmb2' ),
		'desc'       => __( 'From Day', 'cmb2' ),
		'id'         => $prefix . 'from_day',
		'type'       => 'select',
		'options' => array(
				'sunday' 		=> esc_html__( 'Sunday', 'cmb2' ),
				'monday'   		=> esc_html__( 'Monday', 'cmb2' ),
				'tuesday'     	=> esc_html__( 'Tuesday', 'cmb2' ),
				'wednesday'     => esc_html__( 'Wednesday', 'cmb2' ),
				'thursday'     	=> esc_html__( 'Thursday', 'cmb2' ),
				'friday'     	=> esc_html__( 'Friday', 'cmb2' ),
				'saturday'     	=> esc_html__( 'Saturday', 'cmb2' ),
			),
			'default' => 'Sunday',
		
	) );*/

         /* $cmb->add_field( array(
		'name'       => __( 'To Day', 'cmb2' ),
		'desc'       => __( 'To Day', 'cmb2' ),
		'id'         => $prefix . 'to_day',
		'type'       => 'select',
		'options' => array(
				'sunday' 		=> esc_html__( 'Sunday', 'cmb2' ),
				'monday'   		=> esc_html__( 'Monday', 'cmb2' ),
				'tuesday'     	=> esc_html__( 'Tuesday', 'cmb2' ),
				'wednesday'     => esc_html__( 'Wednesday', 'cmb2' ),
				'thursday'     	=> esc_html__( 'Thursday', 'cmb2' ),
				'friday'     	=> esc_html__( 'Friday', 'cmb2' ),
				'saturday'     	=> esc_html__( 'Saturday', 'cmb2' ),
			),
			'default' => 'Sunday',
		
	) );*/
        /*// business start time
		$cmb->add_field(array(
			'name' 			=> esc_html__( 'Start Time', 'cmb2' ),
			'description'	=> esc_html__( 'add your business starting time', 'listinger' ),
			'id'   =>  $prefix . 'business_starttime',
			'type' => 'text_time',
		) );
		// business start time
		$cmb->add_field(array(
			'name' 			=> esc_html__( 'End Time', 'cmb2' ),
			'description'	=> esc_html__( 'add your business ending time', 'listinger' ),
			'id'   =>  $prefix . 'business_endtime',
			'type' => 'text_time',
		) );
*//*
		// Upload Gallery Images
		$cmb->add_field( array(
			'name' => esc_html__( 'Gallery Images', 'cmb2' ),
			'desc' => esc_html__( 'upload mulitple gallery images', 'cmb2' ),
			'id'   =>  'gallery_images',
			'type' => 'file_list',
			'preview_size' => array( 100, 100 ), 
			'query_args' => array( 'type' => 'image' ), 
			'text' => array(
				'add_upload_files_text' => esc_html__( 'Upload Image', 'cmb2' ), // default: "Add or Upload Files"
				'remove_image_text' => esc_html__( 'Remove Image', 'cmb2' ), // default: "Remove Image"
			),
		) );*/

		$cmb->add_field( array(
		'name'       => __( 'Property Details', 'cmb2' ),
		'desc'       => __( 'Property Details', 'cmb2' ),
		'id'         => $prefix . 'property_details',
		'type'       => 'wysiwyg',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		'options' => array(),
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	$cmb->add_field( array(
		'name'       => __( 'Other Details', 'cmb2' ),
		'desc'       => __( 'Other Details', 'cmb2' ),
		'id'         => $prefix . 'other_details',
		'type'       => 'wysiwyg',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		'options' => array(),
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );	
	
	$cmb->add_field( array(
		'name'       => __( 'Operation Details', 'cmb2' ),
		'desc'       => __( 'Operation Details', 'cmb2' ),
		'id'         => $prefix . 'Operation_details',
		'type'       => 'wysiwyg',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		'options' => array(),
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	$cmb->add_field( array(
		'name'       => __( 'Miscellaneous', 'cmb2' ),
		'desc'       => __( 'Miscellaneous', 'cmb2' ),
		'id'         => $prefix . 'miscellaneous',
		'type'       => 'wysiwyg',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		'options' => array(),
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );
	// Add other metaboxes as needed

}

/*
 Package  for pricing post type
*/
 /*if(!function_exists('packages_listing_post_type')){
function packages_listing_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Package', 'Package' ),
			'singular_name'			=> esc_html__( 'Package', 'Package' ),
			'menu_name'				=> esc_html__( 'Package', 'Package' ),
			'parent_item_colon'		=> esc_html__( 'Parent Package', 'Package' ),
			'all_items'				=> esc_html__( 'All Package', 'Package' ),
			'view_item'				=> esc_html__( 'View Package', 'Package' ),
			'add_new_item'        	=> esc_html__( 'Add New Package', 'Package' ),
			'add_new'             	=> esc_html__( 'Add New Package', 'Package' ),
			'edit_item'           	=> esc_html__( 'Edit Package', 'Package' ),
			'update_item'         	=> esc_html__( 'Update Package', 'Package' ),
			'search_items'        	=> esc_html__( 'Search Package', 'Package' ),
			'not_found'           	=> esc_html__( 'No Package', 'Package' ),
			'not_found_in_trash'  	=> esc_html__( 'No Package in Trash', 'Package' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-editor-ul',
			'supports'			=> array('title', 'editor', 'comments', 'thumbnail', 'author'),
			//'taxonomies'        => array( 'post_tag' ),
		);

		register_post_type( 'packages', $args );
	}
}
add_action( 'init', 'packages_listing_post_type', 20 );	*/
