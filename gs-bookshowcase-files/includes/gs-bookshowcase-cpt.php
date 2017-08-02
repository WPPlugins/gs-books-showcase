<?php
/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/

//Registers a new post type
if ( ! function_exists( 'GS_Bookshowcase' ) ) {

    function GS_bookshowcase() {
        $labels = array(
            'name'               => _x( 'Books Showcase', 'gsbookshowcase' ),
            'singular_name'      => _x( 'Book', 'gsbookshowcase' ),
            'menu_name'          => _x( 'GS Books Showcase', 'admin menu', 'gsbookshowcase' ),
            'name_admin_bar'     => _x( 'GS Bookshowcase', 'add new on admin bar', 'gsbookshowcase' ),
            'add_new'            => _x( 'Add New Book', 'book', 'gsbookshowcase' ),
            'add_new_item'       => __( 'Add New Book', 'gsbookshowcase' ),
            'new_item'           => __( 'New Bookshowcase', 'gsbookshowcase' ),
            'edit_item'          => __( 'Edit Bookshowcase', 'gsbookshowcase' ),
            'view_item'          => __( 'View Bookshowcase', 'gsbookshowcase' ),
            'all_items'          => __( 'Books Showcase', 'gsbookshowcase' ),
            'search_items'       => __( 'Search Bookshowcase', 'gsbookshowcase' ),
            'parent_item_colon'  => __( 'Parent Bookshowcase:', 'gsbookshowcase' ),
            'not_found'          => __( 'No Bookshowcase found.', 'gsbookshowcase' ),
            'not_found_in_trash' => __( 'No Bookshowcase found in Trash.', 'gsbookshowcase' ),
            'featured_image'        => __( 'Book Cover', 'gsbookshowcase' ),
            'set_featured_image'    => __( 'Set Book Cover', 'gsbookshowcase' ),
            'remove_featured_image' => __( 'Remove Book Cover', 'gsbookshowcase' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'books' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => GSBOOKSHOWCASE_MENU_POSITION,
            'menu_icon'          => 'dashicons-book',
            'supports'           => array( 'title', 'editor','thumbnail')
        );

        register_post_type( 'gs_bookshowcase', $args );
    }
}

add_action( 'init', 'GS_Bookshowcase' );

// Register Theme Features (feature image for Bookshowcase)
if ( ! function_exists('gs_bookshowcase_theme_support') ) {

    function gs_bookshowcase_theme_support()  {
        // Add theme support for Featured Images
        add_theme_support( 'post-thumbnails', array( 'gs_bookshowcase' ) );
        add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
        add_theme_support( 'post-thumbnails', array( 'page' ) ); // Add it for pages
        add_theme_support( 'post-thumbnails', array( 'product' ) ); // Add it for products
        add_theme_support( 'post-thumbnails');
        // Add Shortcode support in text widget
        add_filter('widget_text', 'do_shortcode');
    }

    // Hook into the 'after_setup_theme' action
    add_action( 'after_setup_theme', 'gs_bookshowcase_theme_support' );
}

// SIDEBAR Ad for PRO version
function gs_bookshowcase_pro_features_meta_box() {
    add_meta_box(
        'gs_bookshowcase_sectionid_pro_sidebar',
        __( "GS Bookshowcase Pro Features" , 'gsbookshowcase' ),
        'gs_bookshowcase_pro_features',
        'gs_bookshowcase',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'gs_bookshowcase_pro_features_meta_box' );

function gs_bookshowcase_pro_features() { ?>
    <ul class="gsbookshow_pro_fea">
        <li>11 different themes</li>
        <li>Single Book Template included</li>
        <li>Archive Book Template included</li>
        <li>GS Book Showcase Widget available</li>
        <li>GS Book Showcase Shortcode generator available at page / post</li>
        <li>Display Books by Group / category wise</li>
        <li>Limit number of Books to display.</li>
        <li>Limit number of characters for description.</li>
        <li>Custom CSS – Add Custom CSS to GS Book Showcase</li>
        <li>Priority Email Support.</li>
        <li>Free Installation ( If needed ).</li>
        <li>Life time free update.</li>
        <li>Well documentation and support.</li>
        <li>And many more..</li>
    </ul>
    <p><a class="button button-primary button-large" href="https://www.gsamdani.com/product/wordpress-books-showcase-plugin" target="_blank">Go for PRO</a></p>
    <div style="clear:both"></div>
<?php
}

// SIDEBAR Ad for PRO version
function gs_bookshowcase_pro_features_meta_fileds() {
    add_meta_box(
        'gs_bookshowcase_pro_below_meta',
        __( "GS Bookshowcase more Meta Fileds at Pro Version" , 'gsbookshowcase' ),
        'gs_bookshowcase_pro_meta_fileds',
        'gs_bookshowcase',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'gs_bookshowcase_pro_features_meta_fileds' );

function gs_bookshowcase_pro_meta_fileds() { ?>
    <ul class="gsbookshow_pro_fea">
        <li>Translator</li>
        <li>ISBN</li>
        <li>ASIN</li>
        <li>Total Pages / Length</li>
        <li>Country</li>
        <li>Language</li>
        <li>Book Dimensions</li>
        <li>File Size (if e-book)</li>
        <li>Author Biography</li>
        <li>Review</li>
        <li>Readers Rating</li>
        <li>Author Image</li>
        <li>Books Group / Category</li>
        <li>Book Cover (Featured Image)</li>
        <li>Book Cover / Gallery (Multiple book pages)</li>

    </ul>
    <p><a class="button button-primary button-large" href="https://www.gsamdani.com/product/wordpress-books-showcase-plugin" target="_blank">Go for PRO</a></p>
    <div style="clear:both"></div>
<?php
}