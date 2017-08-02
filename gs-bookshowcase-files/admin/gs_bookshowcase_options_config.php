<?php
/**
 * This page shows the procedural or functional example
 * OOP way example is given on the main plugin file.
 * @author GSamdani <gsamdani@gmail.com>
 */

/**
 * WordPress settings API demo class
 * @author GSamdani
 */


if ( !class_exists('gs_Bookshowcase_Settings_Config' ) ):
class gs_Bookshowcase_Settings_Config {

    private $settings_api;

    function __construct() {
        $this->settings_api = new gs_Bookshowcase_WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') ); //display options
        add_action( 'admin_menu', array($this, 'admin_menu') ); //display the page of options.
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {

        add_submenu_page( 'edit.php?post_type=gs_bookshowcase', 'Bookshowcase Settings', 'Bookshowcase Settings', 'delete_posts', 'bookshowcase-settings', array($this, 'plugin_page'));
    }


    function get_settings_sections() {
        $sections = array(
            array(
                'id'     => 'gs_bookshowcase_settings',
                'title' => __( 'GS Book Showcase Settings', 'gsbookshowcase' )
            ),
            array(
                'id'    => 'gs_bookshowcase_style_settings',
                'title' => __( 'Style Settings', 'gsbookshowcase' )
            )
        );
        return $sections;
    }

    //start all options of "GS book settings" and "Style Settings" under nav
    /*
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(

            // Start of book settings nav, 'gs_bookshowcase_settings' => array()
            'gs_bookshowcase_settings' => array(
                // Front page display Columns
                array(
                    'name'      => 'gs_bookshowcase_cols',
                    'label'     => __( 'Page Columns', 'gsbookshowcase' ),
                    'desc'      => __( 'Select number of Book Showcase columns', 'gsbookshowcase' ),
                    'type'      => 'select',
                    'default'   => '3',
                    'options'   => array(
                        '6'    => '2 Columns',
                        '4'      => '3 Columns',
                        '3'      => '4 Columns',
                    )
                ),
                // Bookshowcase theme
                array(
                    'name'  => 'gs_bookshowcase_theme',
                    'label' => __( 'Style & Theming', 'gsbookshowcase' ),
                    'desc'  => __( 'Select preffered Style & Theme', 'gsbookshowcase' ),
                    'type'  => 'select',
                    'default'   => 'gs_book_theme1',
                    'options'   => array(
                        'gs_book_theme1'   => 'Hover (Lite)',
                        'gs_book_theme2'   => 'Grid (Pro)',
                        'gs_book_theme3'   => 'Left Sqr (Pro)',
                        'gs_book_theme4'   => 'Right Sqr (Pro)',
                        'gs_book_theme7'   => 'Slider (Pro)',
                        'gs_book_theme7_1' => 'Slider & Hover (Pro)',
                        'gs_book_theme8'   => 'Popup (Pro)',
                        'gs_book_theme9'   => 'Filter (Pro)',
                        'gs_book_theme10'  => 'Grey (Pro)',
                        'gs_book_theme11'  => 'To Single (Pro)',
                    )
                ),
                // Book Name
                array(
                    'name'      => 'gs_book_title',
                    'label'     => __( 'Book Name', 'gsbookshowcase' ),
                    'desc'      => __( 'Show or Hide All Books Name', 'gsbookshowcase' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Book Description/Details
                array(
                    'name'      => 'gs_book_details',
                    'label'     => __( 'Book Details', 'gsbookshowcase' ),
                    'desc'      => __( 'Show or Hide All Books Details', 'gsbookshowcase' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Book Author
                array(
                    'name'      => 'gs_book_author',
                    'label'     => __( 'Book Author', 'gsbookshowcase' ),
                    'desc'      => __( 'Show or Hide All Books Author', 'gsbookshowcase' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Book Publish Date
                array(
                    'name'      => 'gs_book_publish',
                    'label'     => __( 'Book Publish Date', 'gsbookshowcase' ),
                    'desc'      => __( 'Show or Hide All Books Publish Date', 'gsbookshowcase' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Book Publisher
                array(
                    'name'      => 'gs_book_publisher',
                    'label'     => __( 'Book publisher ', 'gsbookshowcase' ),
                    'desc'      => __( 'Show or Hide All Books Publisher ', 'gsbookshowcase' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                
                // Book URL
                array(
                    'name'      => 'gs_book_url',
                    'label'     => __( 'Book URL', 'gsbookshowcase' ),
                    'desc'      => __( 'Show or Hide All Books URL', 'gsbookshowcase' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Book Link Target
                array(
                    'name'      => 'gs_book_link_tar',
                    'label'     => __( 'Book Link Target', 'gsbookshowcase' ),
                    'desc'      => __( 'Specify target to load the Links, Default New Tab ', 'gsbookshowcase' ),
                    'type'      => 'select',
                    'default'   => '_blank',
                    'options'   => array(
                        '_blank'    => 'New Tab',
                        '_self'     => 'Same Window'
                    )
                ),
                // Book Detail Description character control
                array(
                    'name'  => 'gs_book_details_contl',
                    'label' => __( 'Details/Description Character contl', 'gsbookshowcase' ),
                    'desc'  => __( 'Define maximum number of characters in Book details. Default 100 & Maximum 300', 'gsbookshowcase' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 300,
                    'default' => 100
                ),

            ), // end of book Settings Tab

            'gs_bookshowcase_style_settings' => array(
                array(
                    'name'      => 'gs_book_setting_banner',
                    'label'     => __( '', 'gsbookshowcase' ),
                    'desc'      => __( '<p class="gsbookshowcase_pro">Available at <a href="https://www.gsamdani.com/product/wordpress-books-showcase-plugin/" target="_blank">PRO</a> version.</p>', 'gsbookshowcase' )
                ),
                // Font Size
                array(
                    'name'      => 'gs_book_fz',
                    'label'     => __( 'Font Size', 'gsbookshowcase' ),
                    'desc'      => __( 'Set Font Size for <b>Book Name</b>', 'gsbookshowcase' ),
                    'type'      => 'number',
                    'default'   => '18',
                    'options'   => array(
                        'min'   => 1,
                        'max'   => 30,
                        'default' => 18
                    )
                ),
                // Font weight
                array(
                    'name'      => 'gs_book_fntw',
                    'label'     => __( 'Font Weight', 'gsbookshowcase' ),
                    'desc'      => __( 'Select Font Weight for <b>Book Name</b>', 'gsbookshowcase' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'bold'      => 'Bold',
                        'lighter'   => 'Lighter'
                    )
                ),
                // Font style
                array(
                    'name'      => 'gs_book_fnstyl',
                    'label'     => __( 'Font Style', 'gsbookshowcase' ),
                    'desc'      => __( 'Select Font Weight for <b>Book Name</b>', 'gsbookshowcase' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'italic'      => 'Italic'
                    )
                ),
                // Font Color of book Name
                array(
                    'name'    => 'gs_book_name_color',
                    'label'   => __( 'Font Color', 'gsbookshowcase' ),
                    'desc'    => __( 'Select color for <b>Book Name</b>.', 'gsbookshowcase' ),
                    'type'    => 'color',
                    'default' => '#141412'
                ),
                // Label Font Size
                array(
                    'name'      => 'gs_book_label_fz',
                    'label'     => __( 'Label Font Size', 'gsbookshowcase' ),
                    'desc'      => __( 'Set Font Size for <b>Book Label</b>', 'gsbookshowcase' ),
                    'type'      => 'number',
                    'default'   => '18',
                    'options'   => array(
                        'min'   => 1,
                        'max'   => 30,
                        'default' => 18
                    )
                ),
                // Label Font Color
                array(
                   'name'    => 'gs_book_label_color',
                   'label'   => __( 'Label Font Color', 'gsbookshowcase' ),
                   'desc'    => __( 'Select color for <b>Book Label</b>.', 'gsbookshowcase' ),
                   'type'    => 'color',
                   'default' => '#0BF'
                ),
                // Label Font Color
                array(
                   'name'    => 'gs_books_BtnNavCls_color',
                   'label'   => __( 'Popup Btn, Nav & Close Color', 'gsbookshowcase' ),
                   'desc'    => __( 'Select color for <b>Popup Btn, Nav & Close Button</b>.', 'gsbookshowcase' ),
                   'type'    => 'color',
                   'default' => '#F4511E'
                ),
                // Font weight
                array(
                    'name'      => 'gs_filter_cat_pos',
                    'label'     => __( 'Filter Category Position', 'gsbookshowcase' ),
                    'desc'      => __( 'Select Filter Category Position', 'gsbookshowcase' ),
                    'type'      => 'select',
                    'default'   => 'center',
                    'options'   => array(
                        'left'    => 'Left',
                        'center'  => 'Center',
                        'right'   => 'Right'
                    )
                ),
                // bookshowcase Custom CSS
                array(
                    'name'    => 'gs_book_custom_css',
                    'label'   => __( 'Your Custom CSS', 'gsbookshowcase' ),
                    'desc'    => __( 'You can write your own custom css', 'gsbookshowcase' ),
                    'type'    => 'textarea'
                ),

            ) // end of Style Settings nav array, 'gs_bookshowcase_style_settings' => array()
        ); //end of $settings_fields = array()

        return $settings_fields;
    } // end of function get_settings_fields()

    function plugin_page() {
        settings_errors();
        echo '<div class="wrap gs_bookshowcase_wrap" style="width: 845px; float: left;">';
        // echo '<div id="post-body-content">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';

        ?>
            <div class="gswps-admin-sidebar" style="width: 277px; float: left; margin-top: 62px;">
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Support / Report a bug' ) ?></span></h3>
                    <div class="inside centered">
                        <p>Please feel free to let me know if you got any bug to report. Your report / suggestion can make the plugin awesome!</p>
                        <p style="margin-bottom: 1px! important;"><a href="https://www.gsamdani.com/support" target="_blank" class="button button-primary">Get Support</a></p>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Buy me a coffee' ) ?></span></h3>
                    <div class="inside centered">
                        <p>If you like the plugin, please buy me a coffee to inspire me to develop further.</p>
                        <p style="margin-bottom: 1px! important;"><a href='https://www.2checkout.com/checkout/purchase?sid=202460873&quantity=1&product_id=8' class="button button-primary" target="_blank">Donate</a></p>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Join GS Plugins on facebook' ) ?></span></h3>
                    <div class="inside centered">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/gsplugins&amp;width&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=723137171103956" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:220px;" allowTransparency="true"></iframe>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Follow GS Plugins on twitter' ) ?></span></h3>
                    <div class="inside centered">
                        <a href="https://twitter.com/gsplugins" target="_blank" class="button button-secondary">Follow @gsplugins<span class="dashicons dashicons-twitter" style="position: relative; top: 3px; margin-left: 3px; color: #0fb9da;"></span></a>
                    </div>
                </div>
            </div>
        <?php
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

$settings = new gs_Bookshowcase_Settings_Config();