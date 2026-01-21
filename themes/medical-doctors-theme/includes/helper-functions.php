<?php if ( ! defined( 'ABSPATH' ) ) exit;
function md_get_doctor_experience( $post_id = null ) { if ( ! $post_id ) $post_id = get_the_ID(); return absint( get_post_meta( $post_id, '_md_doctor_experience', true ) ); }
function md_get_doctor_price( $post_id = null ) { if ( ! $post_id ) $post_id = get_the_ID(); return absint( get_post_meta( $post_id, '_md_doctor_price', true ) ); }
function md_get_doctor_rating( $post_id = null ) { if ( ! $post_id ) $post_id = get_the_ID(); return floatval( get_post_meta( $post_id, '_md_doctor_rating', true ) ); }
function md_display_star_rating( $rating ) {
	$rating = floatval( $rating );
	$full_stars = floor( $rating );
	$half_star = ( $rating - $full_stars >= 0.5 ) ? 1 : 0;
	$empty_stars = 5 - $full_stars - $half_star;
	$stars = str_repeat( '★', $full_stars ) . ( $half_star ? '☆' : '' ) . str_repeat( '☆', $empty_stars );
	return esc_html( $stars . ' (' . number_format( $rating, 1 ) . ')' );
}