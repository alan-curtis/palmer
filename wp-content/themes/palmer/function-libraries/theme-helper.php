<?php
    /** =============================================================== **/
    /** General Theme Helpers **/
    /** =============================================================== **/
    // Generate body class
    function generateBodyClass() {
        global $post;
        $bodyClass = "body-";
        switch ( TRUE ) {
            case is_404():
                $bodyClass .= "404";
                break;
            default:
                $bodyClass .= $post->post_name;
                break;
        }
        echo $bodyClass;
    }

    // Generate a background style of a given image URL
    function generateBackgroundStyle( $imageURL, $echoStyle = TRUE ) {
        $imageStyle = ' style="background-image: url(\'' . $imageURL . '\');" ';
        if ( $echoStyle ) {
            // Echo image as background
            echo $imageStyle;
        } else {
            // Return generated style
            return $imageStyle;
        }
    }

    // Generate the post featured image as background
    function postFeaturedImage( $postID = NULL, $size = "large", $echoStyle = TRUE ) {
        if ( $postID == NULL ) {
            global $post;
            $postID = $post->ID;
        }
        if ( $echoStyle ) {
            // Echo the featured image as background
            generateBackgroundStyle( get_the_post_thumbnail_url( $postID, $size ) );
        } else {
            return get_the_post_thumbnail_url( $postID, $size );
        }
    }

    // Generate the correct theme images URL
    function themeImg( $imgFileName ) {
        echo get_bloginfo( "template_url" ) . "/dist/images/" . $imgFileName;
    }

    // Generate the correct theme pdf URL
    function themePDF( $fileName ) {
        echo get_bloginfo( "template_url" ) . "/dist/pdf/" . $fileName;
    }

    function generateLink() {
    }

    function generateImg() {
    }
