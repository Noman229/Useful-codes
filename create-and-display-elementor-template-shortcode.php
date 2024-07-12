<?php

// Add a custom column inside [Elementor -> Templates] and display the shortcode 
function add_shortcode_column($columns) {
    $columns['shortcode'] = 'Shortcode';
    return $columns;
}
add_filter('manage_edit-elementor_library_columns', 'add_shortcode_column');

function render_shortcode_column($column, $post_id) {
    if ($column == 'shortcode') {
        echo '[elementor-template id="' . $post_id . '"]';
    }
}
add_action('manage_elementor_library_posts_custom_column', 'render_shortcode_column', 10, 2);

// Shortcode to display Elementor template
function display_elementor_template($atts) {
    $atts = shortcode_atts([
        'id' => '',
    ], $atts, 'custom-template');

    if (empty($atts['id'])) {
        return '';
    }

    return Elementor\Plugin::instance()->frontend->get_builder_content_for_display($atts['id']);
}
add_shortcode('custom-template', 'display_elementor_template');

