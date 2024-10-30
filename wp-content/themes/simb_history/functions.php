<?php

// подключаем стили и скрипты
add_action( 'wp_enqueue_scripts', 'simb_history_scripts' );

function simb_history_scripts() {	
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css', [], null, "all" );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', [], null, "all" );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css', [], null, "all" );
	wp_enqueue_style( 'common-styles', get_template_directory_uri() . '/css/styles.css', [], date("HmsdmY"), "all" );
	
	
	wp_enqueue_script( 'jq371', get_template_directory_uri() . '/js/jq371.js', array(), '3.7.1', false );
	wp_enqueue_script( 'slickjs', get_template_directory_uri() . '/js/slick.min.js', array(), '1.8.1', false );
	wp_enqueue_script( 'commonjs', get_template_directory_uri() . '/js/common.js', array(), '1.0.1', true );
}

// Отключаем Guttengerg
if( 'disable_gutenberg' ){
	remove_theme_support( 'core-block-patterns' ); // WP 5.5

	add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );

	// отключим подключение базовых css стилей для блоков
	// ВАЖНО! когда выйдут виджеты на блоках или что-то еще, эту строку нужно будет комментировать
	remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

	// Move the Privacy Policy help notice back under the title field.
	add_action( 'admin_init', function(){
		remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
		add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
	} );
}

add_filter( 'use_block_editor_for_post_type', 'my_disable_gutenberg', 10, 2 );

function my_disable_gutenberg( $current_status, $post_type ) {

	$disabled_post_types = [ 'book', 'movie' ];

	return ! in_array( $post_type, $disabled_post_types, true );
}


//включаем окошко для загрузки изображений записей
add_theme_support( 'post-thumbnails');


	$main_cat = $wpdb->get_results("
					SELECT `wp_terms`.`term_id` AS `id`, `wp_terms`.`slug`, `wp_terms`.`name`, `wp_term_taxonomy`.`parent`
					FROM `wp_terms`, `wp_term_taxonomy`
					WHERE `wp_term_taxonomy`.`term_id` = `wp_terms`.`term_id` AND `wp_term_taxonomy`.`parent` = 0"
				);


function my_upload_size_limit( $limit ) {
add_filter( 'upload_size_limit', 'my_upload_size_limit' );
    return wp_convert_hr_to_bytes( '100M' );
}