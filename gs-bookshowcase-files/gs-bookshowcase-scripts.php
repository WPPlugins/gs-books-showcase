<?php

// -- Include js files
if ( ! function_exists('gs_enqueue_bookshowcase_scripts') ) {
    function gs_enqueue_bookshowcase_scripts() {
        if (!is_admin()) {

            wp_register_script('gsbookshowcase-custom-js', GSBOOKSHOWCASE_FILES_URI . '/assets/js/gs-bookshowcase.custom.js', array('jquery'), GSBOOKSHOWCASE_VERSION , true);
            wp_enqueue_script('gsbookshowcase-custom-js');
        }
    }
    add_action( 'wp_enqueue_scripts', 'gs_enqueue_bookshowcase_scripts' );
}

// -- Include css files
if ( ! function_exists('gs_enqueue_bookshowcase_styles') ) {
    function gs_enqueue_bookshowcase_styles() {
        if (!is_admin()) {
            $media = 'all';

            wp_register_style('gsbookshowcase-custom-bootstrap', GSBOOKSHOWCASE_FILES_URI . '/assets/css/gs-bookshowcase-custom-bootstrap.css','', GSBOOKSHOWCASE_VERSION, $media);
            wp_enqueue_style('gsbookshowcase-custom-bootstrap');

            // Plugin main stylesheet
            wp_register_style('gs_bookshowcase_csutom_css', GSBOOKSHOWCASE_FILES_URI . '/assets/css/gs-bookshowcase-custom.css','', GSBOOKSHOWCASE_VERSION, $media);
            wp_enqueue_style('gs_bookshowcase_csutom_css');
        }
    }
    add_action( 'init', 'gs_enqueue_bookshowcase_styles' );
}

// -- Admin css
function gsbookshowcase_enque_admin_style() {
    $media = 'all';
    wp_register_style('gsbookshowcase-fa-icons-admin', GSBOOKSHOWCASE_FILES_URI . '/assets/fa-icons/css/font-awesome.min.css','', GSBOOKSHOWCASE_VERSION, $media);
    wp_enqueue_style('gsbookshowcase-fa-icons-admin');

    wp_register_style('gs-plugins-free-bookshow', GSBOOKSHOWCASE_FILES_URI . '/admin/css/gs_free_plugins.css','', GSBOOKSHOWCASE_VERSION, $media);
    wp_enqueue_style('gs-plugins-free-bookshow');

    // Plugin dashboard admin stylesheet
    wp_register_style('gsbookshowcase_admin_css', GSBOOKSHOWCASE_FILES_URI . '/admin/css/gsbookshowcase-admin.css','', GSBOOKSHOWCASE_VERSION, $media);
    wp_enqueue_style('gsbookshowcase_admin_css');
}
add_action( 'admin_enqueue_scripts', 'gsbookshowcase_enque_admin_style' );