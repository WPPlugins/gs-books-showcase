<?php

// -- Getting values from setting panel
function gs_bookshowcase_getoption( $option, $section, $default = '' ) {
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

// -- Shortcode [gs_book_showcase]

add_shortcode('gs_book_showcase','gs_bookshowcase_shortcode');

function gs_bookshowcase_shortcode( $atts ) {
    $gsbks_op_bookshowcase_cols     = gs_bookshowcase_getoption('gs_bookshowcase_cols', 'gs_bookshowcase_settings', 3);
    $gsbks_op_bookshowcase_theme    = gs_bookshowcase_getoption('gs_bookshowcase_theme', 'gs_bookshowcase_settings', 'gs_book_theme1');
    $gsbks_op_book_title            = gs_bookshowcase_getoption('gs_book_title', 'gs_bookshowcase_settings', 'on');
    $gsbks_op_book_details          = gs_bookshowcase_getoption('gs_book_details', 'gs_bookshowcase_settings', 'on');
    $gsbks_op_book_link_tar         = gs_bookshowcase_getoption('gs_book_link_tar', 'gs_bookshowcase_settings', '_blank');
    $gsbks_op_book_details_contl    = gs_bookshowcase_getoption('gs_book_details_contl', 'gs_bookshowcase_settings', 100);
    $gsbks_op_book_author      = gs_bookshowcase_getoption('gs_book_author', 'gs_bookshowcase_settings', 'on');
    $gsbks_op_book_publish     = gs_bookshowcase_getoption('gs_book_publish', 'gs_bookshowcase_settings', 'on');
    $gsbks_op_book_publisher   = gs_bookshowcase_getoption('gs_book_publisher', 'gs_bookshowcase_settings', 'on');
    $gsbks_op_book_url         = gs_bookshowcase_getoption('gs_book_url', 'gs_bookshowcase_settings', 'on');

    extract(shortcode_atts(
        array(
        'num'           => -1,
        'theme'         => $gsbks_op_bookshowcase_theme,
        'cols'          => $gsbks_op_bookshowcase_cols,
        'cats_name'     => '',
        'desc_limit'    => $gsbks_op_book_details_contl,
        'order'         => 'DESC',
        'orderby'       => 'date'
        ), $atts
    ));

    $GLOBALS['gs_bookshowcase_loop'] = new WP_Query(
        array(
        'post_type'             => 'gs_bookshowcase',
        'order'                 => $order,
        'orderby'               => $orderby,
        'posts_per_page'        => $num
    ));

        $output = '';
        $output = '<div class="wrap gs_bookshowcase_area '.$theme.'">';

            if ( $theme == 'gs_book_theme1') {
                include GSBOOKSHOWCASE_FILES_DIR . '/includes/templates/gs_bookshowcase_structure_1_square.php';
            } else {
                echo('<h4 style="text-align: center;">Select correct Theme or Upgrade to <a href="https://www.gsamdani.com/product/wordpress-books-showcase-plugin" target="_blank">Pro version</a> for more Options<br><a href="http://bookshowcase.gsamdani.com" target="_blank">Chcek available demos</a></h4>');
            }
        $output .= '</div>'; // end wrap
    return $output;
}