<?php

// Coonect styles
function wl_test_theme_scripts()
{

    wp_enqueue_style('wl-style.css', get_template_directory_uri() . '/assets/css/wl_style.css');
}
add_action('wp_enqueue_scripts', 'wl_test_theme_scripts');

// activate thumbnails support
add_theme_support('post-thumbnails');

// add custom post type
function create_car_post_type()
{
    $args = array(
        'public' => true,
        'show_in_rest' => true,
        'label'  => 'Car',
        'supports' => array('title', 'editor', 'thumbnail',),
        'taxonomies' => array('mark'),
        'has_archive' => true

    );
    register_post_type('car', $args);
}
add_action('init', 'create_car_post_type');

// add mark taxanomies into Car post type
function create_mark_taxonomy()
{
    $labels = array(
        'name'              => 'Marks',
        'singular_name'     => 'mark',
        'search_items'      => 'Search mark',
        'all_items'         => 'All marks',
        'edit_item'         => 'Edit marks',
        'update_item'       => 'Update mark',
        'add_new_item'      => 'Add new mark',
        'new_item_name'     => 'new mark name',
        'menu_name'         => 'Марка'
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'Марка')
    );

    register_taxonomy('mark', 'car', $args);
}
add_action('init', 'create_mark_taxonomy');

// add country taxanomies into Car post type
function create_country_taxonomy()
{
    $labels = array(
        'name'              => 'Countries',
        'singular_name'     => 'country',
        'search_items'      => 'Search country',
        'all_items'         => 'All countries',
        'edit_item'         => 'Edit countries',
        'update_item'       => 'Update country',
        'add_new_item'      => 'Add new country',
        'new_item_name'     => 'new country name',
        'menu_name'         => 'Страна производитель'
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'Страна производитель')
    );

    register_taxonomy('country', 'car', $args);
}
add_action('init', 'create_country_taxonomy');

// add metabox color picker
function add_car_color_metabox()
{
    add_meta_box(
        'car_color',
        'Цвет',
        'display_car_color',
        'car',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_car_color_metabox');

// Display color picker metabox content
function display_car_color($post)
{
    $car_color = get_post_meta($post->ID, 'car_color', true);
?>
    <label for="car_color">Цвет авто:</label>
    <input type="color" id="car_color" name="car_color" value="<?php echo esc_attr($car_color); ?>">
<?php
}

// Saving the value of a color picker
function save_car_color_meta_data($post_id)
{
    if (array_key_exists('car_color', $_POST)) {
        update_post_meta($post_id, 'car_color', sanitize_hex_color($_POST['car_color']));
    }
}
add_action('save_post_car', 'save_car_color_meta_data');

// add metabox car fuel
function add_car_fuel_metabox()
{
    add_meta_box(
        'car_fuel',
        'Топливо',
        'display_car_fuel',
        'car',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_car_fuel_metabox');

// Display car fuel metabox content
function display_car_fuel($post)
{
    $car_fuel = get_post_meta($post->ID, 'car_fuel', true);
?>
    <label for="car_fuel">Топливо:</label>
    <select id="car_fuel" name="car_fuel">
        <option value="Бензин" <?php selected($car_fuel, 'Бензин'); ?>>Бензин</option>
        <option value="Дизель" <?php selected($car_fuel, 'Дизель'); ?>>Дизель</option>
    </select>
<?php
}

// Saving the value of a car fuel
function save_car_fuel_meta_data($post_id)
{
    if (array_key_exists('car_fuel', $_POST)) {
        update_post_meta($post_id, 'car_fuel', sanitize_text_field($_POST['car_fuel']));
    }
}
add_action('save_post_car', 'save_car_fuel_meta_data');

// add metabox car power
function add_car_power_metabox()
{
    add_meta_box(
        'car_power',
        'Мощность',
        'display_car_power',
        'car',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_car_power_metabox');

// Display car power metabox content
function display_car_power($post)
{
    $car_power = get_post_meta($post->ID, 'car_power', true);
?>
    <label for="car_price">Мощность:</label>
    <input type="number" id="car_power" name="car_power" value="<?php echo esc_attr($car_power); ?>">
<?php
}

// Saving the value of a car power
function save_car_power_meta_data($post_id)
{
    if (array_key_exists('car_power', $_POST)) {
        update_post_meta($post_id, 'car_power', sanitize_text_field($_POST['car_power']));
    }
}
add_action('save_post_car', 'save_car_power_meta_data');

// add metabox car price
function add_car_price_metabox()
{
    add_meta_box(
        'car_price',
        'Цена',
        'display_car_price',
        'car',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_car_price_metabox');

// Display car price metabox content
function display_car_price($post)
{
    $car_price = get_post_meta($post->ID, 'car_price', true);
?>
    <label for="car_price">Цена:</label>
    <input type="number" id="car_price" name="car_price" value="<?php echo esc_attr($car_price); ?>" step="any">
<?php
}

// Saving the value of a car price
function save_car_price_meta_data($post_id)
{
    if (array_key_exists('car_price', $_POST)) {
        update_post_meta($post_id, 'car_price', sanitize_text_field($_POST['car_price']));
    }
}
add_action('save_post_car', 'save_car_price_meta_data');

// add new settings to customizer
function custom_theme_customizer($wp_customize)
{
    // add header section
    $wp_customize->add_section('header_section', array(
        'title' => 'Настройки хедера',
        'priority' => 30,
    ));

    // add phone field
    $wp_customize->add_setting('header_phone', array(
        'default' => '+38068534315',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('header_phone', array(
        'type' => 'text',
        'section' => 'header_section',
        'label' => 'Телефон',
    ));
}
add_action('customize_register', 'custom_theme_customizer');
