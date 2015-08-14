<?php

// Include parent style.css
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

// Custom thumb sizes
add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    // add_image_size( 'category-thumb', 300 ); // 300 pixels wide (and unlimited height)
    add_image_size( 'poster', 300, 424, true ); // (cropped)
}


// Include thumbs in calls to wp-api
add_action( 'rest_api_init', 'slug_register_starship' );
function slug_register_starship() {
    register_api_field( 'post',
        'thumb',
        array(
            'get_callback'    => 'slug_get_starship',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

/**
 * Get the value of the "starship" field
 *
 * @param array $object Details of current post.
 * @param string $field_name Name of field.
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function slug_get_starship( $object, $field_name, $request ) {
    //return get_post_meta( $object[ 'id' ], $field_name, true );
    // var_dump($object);
    // exit;
    // return get_the_post_thumbnail( $object[ 'id' ], 'post-thumbnail');
    return wp_get_attachment_image_src( $object[ 'featured_image' ], 'poster');
}
