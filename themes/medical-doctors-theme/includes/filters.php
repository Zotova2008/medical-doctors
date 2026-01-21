<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function md_modify_doctors_archive_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'doctors' ) || $query->is_tax( 'specialization' ) || $query->is_tax( 'city' ) ) ) {
		$query->set( 'posts_per_page', 9 );
		$specialization = isset( $_GET['specialization'] ) ? sanitize_text_field( wp_unslash( $_GET['specialization'] ) ) : '';
		$city           = isset( $_GET['city'] ) ? sanitize_text_field( wp_unslash( $_GET['city'] ) ) : '';
		$sort           = isset( $_GET['sort'] ) ? sanitize_text_field( wp_unslash( $_GET['sort'] ) ) : '';
		$tax_query      = [];
		if ( $specialization && term_exists( $specialization, 'specialization' ) ) {
			$tax_query[] = [ 'taxonomy' => 'specialization', 'field' => 'slug', 'terms' => $specialization ];
		}
		if ( $city && term_exists( $city, 'city' ) ) {
			$tax_query[] = [ 'taxonomy' => 'city', 'field' => 'slug', 'terms' => $city ];
		}
		if ( ! empty( $tax_query ) ) {
			$tax_query['relation'] = 'AND';
			$query->set( 'tax_query', $tax_query );
		}
		if ( $sort ) {
			switch ( $sort ) {
				case 'rating':
					$query->set( 'meta_key', '_md_doctor_rating' );
					$query->set( 'orderby', 'meta_value_num' );
					$query->set( 'order', 'DESC' );
					break;
				case 'price_asc':
					$query->set( 'meta_key', '_md_doctor_price' );
					$query->set( 'orderby', 'meta_value_num' );
					$query->set( 'order', 'ASC' );
					break;
				case 'experience':
					$query->set( 'meta_key', '_md_doctor_experience' );
					$query->set( 'orderby', 'meta_value_num' );
					$query->set( 'order', 'DESC' );
					break;
				default:
					$query->set( 'orderby', 'date' );
					$query->set( 'order', 'DESC' );
			}
		}
	}
}

add_action( 'pre_get_posts', 'md_modify_doctors_archive_query' );