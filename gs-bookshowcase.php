<?php
/**
 *
 * @package   GS_Bookshowcase
 * @author    Golam Samdani <samdani1997@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.gsamdani.com
 * @copyright 2016 Golam Samdani
 *
 * @wordpress-plugin
 * Plugin Name:         GS Book Showcase Lite
 * Plugin URI:          http://www.gsamdani.com/wordpress-plugins
 * Description:         Best Responsive Book Showcase plugin for Wordpress to display Book Cover, Author, Reviews, Rating & many more. Display anywhere at your site using shortcode like [gs_book_showcase theme="gs_book_theme1"] & widgets. Check more shortcode examples and documentation at <a href="http://bookshowcase.gsamdani.com">GS Bookshowcase PRO Demos & Docs</a>
 * Version:             1.2
 * Author:              Golam Samdani
 * Author URI:          http://www.gsamdani.com
 * Text Domain:         gsbookshowcase
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! defined( 'GSBOOKSHOWCASE_HACK_MSG' ) ) define( 'GSBOOKSHOWCASE_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gsbookshowcase' ) );

// Protect direct access
if ( ! defined( 'ABSPATH' ) ) die( GSBOOKSHOWCASE_HACK_MSG );

// Defining constants
if( ! defined( 'GSBOOKSHOWCASE_VERSION' ) ) define( 'GSBOOKSHOWCASE_VERSION', '1.2' );
if( ! defined( 'GSBOOKSHOWCASE_MENU_POSITION' ) ) define( 'GSBOOKSHOWCASE_MENU_POSITION', 41 );
if( ! defined( 'GSBOOKSHOWCASE_PLUGIN_DIR' ) ) define( 'GSBOOKSHOWCASE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'GSBOOKSHOWCASE_PLUGIN_URI' ) ) define( 'GSBOOKSHOWCASE_PLUGIN_URI', plugins_url( '', __FILE__ ) );
if( ! defined( 'GSBOOKSHOWCASE_FILES_DIR' ) ) define( 'GSBOOKSHOWCASE_FILES_DIR', GSBOOKSHOWCASE_PLUGIN_DIR . 'gs-bookshowcase-files' );
if( ! defined( 'GSBOOKSHOWCASE_FILES_URI' ) ) define( 'GSBOOKSHOWCASE_FILES_URI', GSBOOKSHOWCASE_PLUGIN_URI . '/gs-bookshowcase-files' );

require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-cpt.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-meta-fields.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-column.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-shortcode.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/gs-bookshowcase-scripts.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/admin/class.settings-api.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/admin/gs_bookshowcase_options_config.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/gs-plugins/gs-plugins.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/gs-plugins/gs-plugins-free.php';

if ( ! function_exists('gs_bookshowcase_pro_link') ) {
    function gs_bookshowcase_pro_link( $gsBookshowcase_links ) {
        $gsBookshowcase_links[] = '<a class="gs-project-pro-link" href="https://www.gsamdani.com/product/wordpress-books-showcase-plugin" target="_blank">Go Pro!</a>';
        $gsBookshowcase_links[] = '<a href="https://www.gsamdani.com/wordpress-plugins" target="_blank">GS Plugins</a>';
        return $gsBookshowcase_links;
    }
    add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'gs_bookshowcase_pro_link' );
}