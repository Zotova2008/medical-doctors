<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function md_register_doctor_cpt() {
	$labels = [
		'name'                     => _x( 'Врачи', 'Название типа записей (множ.)', 'medical-doctors' ),
		'singular_name'            => _x( 'Врач', 'Название типа записей (ед.)', 'medical-doctors' ),
		'menu_name'                => __( 'Врачи', 'medical-doctors' ),
		'all_items'                => __( 'Все врачи', 'medical-doctors' ),
		'add_new'                  => __( 'Добавить нового', 'medical-doctors' ),
		'add_new_item'             => __( 'Добавить нового врача', 'medical-doctors' ),
		'edit_item'                => __( 'Редактировать врача', 'medical-doctors' ),
		'new_item'                 => __( 'Новый врач', 'medical-doctors' ),
		'view_item'                => __( 'Смотреть врача', 'medical-doctors' ),
		'view_items'               => __( 'Смотреть врачей', 'medical-doctors' ),
		'search_items'             => __( 'Поиск врачей', 'medical-doctors' ),
		'not_found'                => __( 'Врачи не найдены', 'medical-doctors' ),
		'not_found_in_trash'       => __( 'В корзине врачи не найдены', 'medical-doctors' ),
		'parent_item_colon'        => __( 'Родительский врач:', 'medical-doctors' ),
		'featured_image'           => __( 'Фото врача', 'medical-doctors' ),
		'set_featured_image'       => __( 'Установить фото врача', 'medical-doctors' ),
		'remove_featured_image'    => __( 'Удалить фото врача', 'medical-doctors' ),
		'use_featured_image'       => __( 'Использовать как фото врача', 'medical-doctors' ),
		'archives'                 => __( 'Архивы врачей', 'medical-doctors' ),
		'insert_into_item'         => __( 'Вставить в запись врача', 'medical-doctors' ),
		'uploaded_to_this_item'    => __( 'Загружено для этого врача', 'medical-doctors' ),
		'filter_items_list'        => __( 'Фильтровать список врачей', 'medical-doctors' ),
		'items_list_navigation'    => __( 'Навигация по списку врачей', 'medical-doctors' ),
		'items_list'               => __( 'Список врачей', 'medical-doctors' ),
		'attributes'               => __( 'Атрибуты врача', 'medical-doctors' ),
		'name_admin_bar'           => __( 'Врач', 'medical-doctors' ),
		'item_published'           => __( 'Врач опубликован', 'medical-doctors' ),
		'item_published_privately' => __( 'Врач опубликован приватно', 'medical-doctors' ),
		'item_reverted_to_draft'   => __( 'Врач возвращен в черновик', 'medical-doctors' ),
		'item_scheduled'           => __( 'Врач запланирован', 'medical-doctors' ),
		'item_updated'             => __( 'Врач обновлен', 'medical-doctors' ),
		'parent_item_colon'        => __( 'Родительский врач:', 'medical-doctors' ),
	];

	$args = [
		'label'               => __( 'Врачи', 'medical-doctors' ),
		'description'         => __( 'Справочник врачей', 'medical-doctors' ),
		'labels'              => $labels,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-businessperson',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'rewrite'             => [ 'slug' => 'doctors', 'with_front' => false ],
		'template'            => [],
		'menu_position'       => 5,
	];

	register_post_type( 'doctors', $args );
}

add_action( 'init', 'md_register_doctor_cpt', 0 );