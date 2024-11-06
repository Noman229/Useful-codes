<?php

    function nk_remove_cpt_slug( $post_link, $post ) {
        if ( 'your-posttype-name' === $post->post_type && 'publish' === $post->post_status ) {     // Change post type name
            $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
        }
        return $post_link;
    }
    add_filter( 'post_type_link', 'nk_remove_cpt_slug', 10, 2 );


    function nk_add_cpt_post_names_to_main_query( $query ) {
        // Return if this is not the main query.
        if ( ! $query->is_main_query() ) {
            return;
        }
        // Return if this query doesn't match our very specific rewrite rule.
        if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
            return;
        }
        // Return if we're not querying based on the post name.
        if ( empty( $query->query['name'] ) ) {
            return;
        }
        // Add CPT to the list of post types WP will include when it queries based on the post name.
        $query->set( 'post_type', array( 'post', 'page', 'your-posttype-name' ) );
    }
    add_action( 'pre_get_posts', 'nk_add_cpt_post_names_to_main_query' );