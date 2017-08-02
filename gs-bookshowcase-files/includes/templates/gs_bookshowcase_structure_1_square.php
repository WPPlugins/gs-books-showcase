<?php

$output .= '<div class="container">';
$output .= '<div class="row clearfix gs_bookshowcase" id="gs_bookshowcase'.get_the_id().'">';

    if ( $GLOBALS['gs_bookshowcase_loop']->have_posts() ) {
        while ( $GLOBALS['gs_bookshowcase_loop']->have_posts() ) {
            $GLOBALS['gs_bookshowcase_loop']->the_post();
            $gsbks_bookshowcase_id      = get_post_thumbnail_id();
            $gsbks_bookshowcase_url     = wp_get_attachment_image_src($gsbks_bookshowcase_id, 'full', true);
            $gsbks_bookshowcase_thumb   = $gsbks_bookshowcase_url[0];
            $gsbks_bookshowcase_alt     = get_post_meta($gsbks_bookshowcase_id,'_wp_attachment_image_alt',true);
            $gsbks_book_title           = get_the_title();
            $gsbks_book_desc            = get_the_content();
            $gsbks_book_desc_link       = get_the_permalink();
            $gsbks_book_desc            = (strlen($gsbks_book_desc) > 50) ? substr($gsbks_book_desc,0, $desc_limit ).'...<a href="'.$gsbks_book_desc_link.'">Book Details</a>' : $gsbks_book_desc;
            $gsbks_book_meta            = get_post_meta( get_the_id() );

            $gsbks_st_author       = !empty($gsbks_book_meta['_gsbks_author'][0]) ? $gsbks_book_meta['_gsbks_author'][0] : '';
            $gsbks_st_publish      = !empty($gsbks_book_meta['_gsbks_publish'][0]) ? $gsbks_book_meta['_gsbks_publish'][0] : '';
            $gsbks_st_publisher    = !empty($gsbks_book_meta['_gsbks_publisher'][0]) ? $gsbks_book_meta['_gsbks_publisher'][0] : '';
            $gsbks_st_url          = !empty($gsbks_book_meta['_gsbks_url'][0]) ? $gsbks_book_meta['_gsbks_url'][0] : '';

            $output .= '<div class="col-md-'.$cols.' col-sm-6 col-xs-6">';

                $output .= '<div class="single-book center">'; // start single book
                    if ( has_post_thumbnail() )
                        $output .= '<img src="'. $gsbks_bookshowcase_thumb .'" alt="'. $gsbks_bookshowcase_alt .'" />';
                    else {
                        $output .= '<img src="' . GSBOOKSHOWCASE_FILES_URI . '/assets/img/no_img.png" class=""/>';
                    }

                    $output .= '<div class="single-book-desc-info">'; // start desc & info text
                        if ( !empty( $gsbks_book_desc ) && 'on' ==  $gsbks_op_book_details ) :
                            $output.= '<div class="gs-book-desc grey-desc">'. $gsbks_book_desc .'</div>';
                        endif;

                        $output .= '<div class="gs-bookshowcase-info center">';
                            if ( !empty( $gsbks_st_author ) && 'on' ==  $gsbks_op_book_author ) :
                                $output.= '<div class="gs-book-author"><span class="book-label">Author : </span><span class="book-auth">'. $gsbks_st_author .'</span></div>';
                            endif;
                            if ( !empty( $gsbks_st_publish ) && 'on' ==  $gsbks_op_book_publish ) :
                                $output.= '<div class="gs-book-publish"><span class="book-label">Published On : </span>'. $gsbks_st_publish .'</div>';
                            endif;
                            if ( !empty( $gsbks_st_publisher ) && 'on' ==  $gsbks_op_book_publisher ) :
                                $output.= '<div class="gs-book-publisher"><span class="book-label">Publisher : </span>'. $gsbks_st_publisher .'</div>';
                            endif;
                            if ( !empty( $gsbks_st_url ) && 'on' ==  $gsbks_op_book_url ) :
                                $output.= '<div class="gs-book-url"><span class="book-label">Book URL : </span><a href='.$gsbks_st_url.' target="'. $gsbks_op_book_link_tar .'">Buy</a></div>';
                            endif;
                        $output .= '</div>';
                    $output .= '</div>'; // end desc & info text
                $output .= '</div>'; // end single book

                    if ( !empty( $gsbks_book_title ) && 'on' ==  $gsbks_op_book_title ) :
                        $output.= '<div class="gs-book-name center">'. $gsbks_book_title .'</div>';
                    endif;
            $output .= '</div>'; // end col

        } // end while loop

    } // if loop end
    else { $output .= "No Book Added!";  }

    wp_reset_postdata();

$output .= '</div>'; // end row
$output .= '</div>'; // end container
return $output;