<?php
// ============== Displaying Additional Columns ===============

if ( ! function_exists('gs_bookshowcase_screen_columns') ) {
    add_filter( 'manage_edit-gs_bookshowcase_columns', 'gs_bookshowcase_screen_columns' );

    function gs_bookshowcase_screen_columns( $columns ) {
        unset( $columns['date'] );
        $columns['title'] = 'Book Name';
        $columns['gsbookshowcase_featured_image'] = 'Book Image';
        $columns['_gsbks_publisher'] = 'Publisher';
        $columns['date'] = 'Date';
        return $columns;
    }
}

// GET FEATURED IMAGE
if ( ! function_exists('gs_bookshowcase_featured_image') ) {
    function gs_bookshowcase_featured_image($post_ID) {
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id);
            return $post_thumbnail_img[0];
        }
    }
}

if ( ! function_exists('gs_bookshowcase_columns_content') ) {
    add_action('manage_posts_custom_column', 'gs_bookshowcase_columns_content', 10, 2);
    // SHOW THE FEATURED IMAGE
    function gs_bookshowcase_columns_content($column_name, $post_ID) {
        if ($column_name == 'gsbookshowcase_featured_image') {
            $post_featured_image = gs_bookshowcase_featured_image($post_ID);
            if ($post_featured_image) {
                echo '<img src="' . $post_featured_image . '" width="34"/>';
            }
        }
    }
}

//Populating the Columns
if ( ! function_exists('gs_bookshowcase_populate_columns') ) {

    add_action( 'manage_posts_custom_column', 'gs_bookshowcase_populate_columns' );

    function gs_bookshowcase_populate_columns( $column ) {
        if ( '_gsbks_publisher' == $column ) {
            $book_publisher = get_post_meta( get_the_ID(), '_gsbks_publisher', true );
            echo $book_publisher;
        }
    }
}