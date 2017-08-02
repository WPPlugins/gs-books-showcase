<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
if ( ! function_exists('add_gs_bookshowcase_metaboxes') ) {

    function add_gs_bookshowcase_metaboxes(){
        add_meta_box('gsBookshowcaseSection', 'Book\'s Additioinal Info' ,'gs_bookshowcase_cmb_cb', 'gs_bookshowcase', 'normal', 'high');
    }
    add_action('add_meta_boxes', 'add_gs_bookshowcase_metaboxes');
}

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
if ( ! function_exists('gs_bookshowcase_cmb_cb') ) {
    function gs_bookshowcase_cmb_cb($post){

        // Add a nonce field so we can check for it later.
        wp_nonce_field( 'gs_bookshowcase_nonce_name', 'gs_bookshowcase_cmb_token' );

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $gsbks_meta_author = get_post_meta( $post->ID, '_gsbks_author', true );
        $gsbks_meta_publish = get_post_meta( $post->ID, '_gsbks_publish', true );
        $gsbks_meta_publisher = get_post_meta( $post->ID, '_gsbks_publisher', true );
        $gsbks_meta_url = get_post_meta( $post->ID, '_gsbks_url', true );

        ?>
        <div class="gs_bookshowcase-metafields">
            <div style="height: 20px;"></div>
            <div class="form-group">
                <label for="gsbksAuthor">Author</label>
                <input type="text" id="gsbksAuthor" class="form-control" name="gsbks_author" value="<?php echo isset($gsbks_meta_author) ? esc_attr($gsbks_meta_author) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="gsbksPublish">Published On</label>
                <input type="text" id="gsbksPublish" class="form-control" name="gsbks_publish" value="<?php echo isset($gsbks_meta_publish) ? esc_attr($gsbks_meta_publish) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="gsbksPublisher">Publisher</label>
                <input type="text" id="gsbksPublisher" class="form-control" name="gsbks_publisher" value="<?php echo isset($gsbks_meta_publisher) ? esc_attr($gsbks_meta_publisher) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="gsbksUrl">Download URL<br>(for e-book)</label>
                <input type="text" id="gsbksUrl" class="form-control" name="gsbks_url" value="<?php echo isset($gsbks_meta_url) ? esc_attr($gsbks_meta_url) : ''; ?>">
            </div>
        </div>

        <?php
    }
}


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */

if ( ! function_exists('save_gs_bookshowcase_metadata') ) {

    function save_gs_bookshowcase_metadata($post_id) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST['gs_bookshowcase_cmb_token'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['gs_bookshowcase_cmb_token'], 'gs_bookshowcase_nonce_name' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }

        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Make sure that it is set.
        if ( ! isset( $_POST['gsbks_author'] ) ) {
            return;
        }
        if ( ! isset( $_POST['gsbks_publish'] ) ) {
            return;
        }
        if ( ! isset( $_POST['gsbks_publisher'] ) ) {
            return;
        }
        if ( ! isset( $_POST['gsbks_url'] ) ) {
            return;
        }

        // Sanitize user input.
        $gsbks_author_data = sanitize_text_field( $_POST['gsbks_author'] );
        $gsbks_publish_data = sanitize_text_field( $_POST['gsbks_publish'] );
        $gsbks_publisher_data = sanitize_text_field( $_POST['gsbks_publisher'] );
        $gsbks_url_data = sanitize_text_field( $_POST['gsbks_url'] );

        // Update the meta field in the database.
        update_post_meta( $post_id, '_gsbks_author', $gsbks_author_data );
        update_post_meta( $post_id, '_gsbks_publish', $gsbks_publish_data );
        update_post_meta( $post_id, '_gsbks_publisher', $gsbks_publisher_data );
        update_post_meta( $post_id, '_gsbks_url', $gsbks_url_data );
    }
    add_action( 'save_post', 'save_gs_bookshowcase_metadata');
}