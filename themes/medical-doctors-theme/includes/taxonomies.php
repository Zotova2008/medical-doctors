<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function md_register_specialization_taxonomy() {
	$labels = [
		'name'                       => _x( 'Специализации', 'Taxonomy General Name', 'medical-doctors' ),
		'singular_name'              => _x( 'Специализация', 'Taxonomy Singular Name', 'medical-doctors' ),
		'menu_name'                  => __( 'Специализации', 'medical-doctors' ),
		'all_items'                  => __( 'Все специализации', 'medical-doctors' ),
		'parent_item'                => __( 'Родительская специализация', 'medical-doctors' ),
		'parent_item_colon'          => __( 'Родительская специализация:', 'medical-doctors' ),
		'new_item_name'              => __( 'Новая специализация', 'medical-doctors' ),
		'add_new_item'               => __( 'Добавить специализацию', 'medical-doctors' ),
		'edit_item'                  => __( 'Редактировать специализацию', 'medical-doctors' ),
		'update_item'                => __( 'Обновить специализацию', 'medical-doctors' ),
		'view_item'                  => __( 'Смотреть специализацию', 'medical-doctors' ),
		'separate_items_with_commas' => __( 'Разделяйте специализации запятыми', 'medical-doctors' ),
		'add_or_remove_items'        => __( 'Добавить или удалить специализации', 'medical-doctors' ),
		'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'medical-doctors' ),
		'popular_items'              => __( 'Популярные специализации', 'medical-doctors' ),
		'search_items'               => __( 'Поиск специализаций', 'medical-doctors' ),
		'not_found'                  => __( 'Не найдено', 'medical-doctors' ),
		'no_terms'                   => __( 'Нет специализаций', 'medical-doctors' ),
		'items_list'                 => __( 'Список специализаций', 'medical-doctors' ),
		'items_list_navigation'      => __( 'Навигация по специализациям', 'medical-doctors' ),
		'filter_items_list'          => __( 'Фильтровать специализации', 'medical-doctors' ),
	];
	$args   = [
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
		'rewrite'           => [ 'slug' => 'specialization', 'with_front' => false ],
	];
	register_taxonomy( 'specialization', [ 'doctors' ], $args );
}

add_action( 'init', 'md_register_specialization_taxonomy', 0 );

function md_register_city_taxonomy() {
	$labels = [
		'name'                       => _x( 'Города', 'Taxonomy General Name', 'medical-doctors' ),
		'singular_name'              => _x( 'Город', 'Taxonomy Singular Name', 'medical-doctors' ),
		'menu_name'                  => __( 'Города', 'medical-doctors' ),
		'all_items'                  => __( 'Все города', 'medical-doctors' ),
		'parent_item'                => __( 'Родительский город', 'medical-doctors' ),
		'parent_item_colon'          => __( 'Родительский город:', 'medical-doctors' ),
		'new_item_name'              => __( 'Новый город', 'medical-doctors' ),
		'add_new_item'               => __( 'Добавить город', 'medical-doctors' ),
		'edit_item'                  => __( 'Редактировать город', 'medical-doctors' ),
		'update_item'                => __( 'Обновить город', 'medical-doctors' ),
		'view_item'                  => __( 'Смотреть город', 'medical-doctors' ),
		'separate_items_with_commas' => __( 'Разделяйте города запятыми', 'medical-doctors' ),
		'add_or_remove_items'        => __( 'Добавить или удалить города', 'medical-doctors' ),
		'choose_from_most_used'      => __( 'Выбрать из часто используемых', 'medical-doctors' ),
		'popular_items'              => __( 'Популярные города', 'medical-doctors' ),
		'search_items'               => __( 'Поиск городов', 'medical-doctors' ),
		'not_found'                  => __( 'Не найдено', 'medical-doctors' ),
		'no_terms'                   => __( 'Нет городов', 'medical-doctors' ),
		'items_list'                 => __( 'Список городов', 'medical-doctors' ),
		'items_list_navigation'      => __( 'Навигация по городам', 'medical-doctors' ),
	];
	$args   = [
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
		'rewrite'           => [ 'slug' => 'city', 'with_front' => false ],
	];
	register_taxonomy( 'city', [ 'doctors' ], $args );
}

add_action( 'init', 'md_register_city_taxonomy', 0 );