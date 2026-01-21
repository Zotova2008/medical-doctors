<?php
get_header();
?>
    <main id="primary" class="site-main">
        <div class="container">
            <?php while ( have_posts() ) : the_post();
                $experience      = md_get_doctor_experience();
                $price           = md_get_doctor_price();
                $rating          = md_get_doctor_rating();
                $specializations = get_the_terms( get_the_ID(), 'specialization' );
                $cities          = get_the_terms( get_the_ID(), 'city' );
                ?>
                <article class="doctor-single">
                    <header class="doctor-header">
                        <h1 class="doctor-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="doctor-content-wrapper">
                        <div class="doctor-image">
                            <?php if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium', [ 'class' => 'doctor-thumbnail' ] );
                            } else {
                                echo '<div class="no-image">' . esc_html__( 'No photo', 'medical-doctors' ) . '</div>';
                            } ?>
                        </div>
                        <div class="doctor-meta">
                            <div class="meta-item"><strong><?php esc_html_e( 'Опыт:', 'medical-doctors' ); ?></strong>
                                <?php echo esc_html( $experience . ' ' . __( 'лет', 'medical-doctors' ) ); ?></div>
                            <div class="meta-item"><strong><?php esc_html_e( 'Стоимость:', 'medical-doctors' );
                                    ?></strong> <?php echo esc_html( number_format( $price, 0 ) . ' ' . __( 'руб.', 'medical-doctors' ) ); ?>
                            </div>
                            <div class="meta-item"><strong><?php esc_html_e( 'Рейтинг:', 'medical-doctors' );
                                    ?></strong> <?php echo wp_kses_post( md_display_star_rating( $rating ) ); ?></div>
                            <?php if ( $specializations && ! is_wp_error( $specializations ) ) : $spec_names = array_map( function ( $term ) {
                                return esc_html( $term->name );
                            }, $specializations ); ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e( 'Специализация:', 'medical-doctors' ); ?></strong> <?php
                                    echo
                                    implode( ', ', $spec_names ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( $cities && ! is_wp_error( $cities ) ) : $city_names = array_map( function ( $term ) {
                                return esc_html( $term->name );
                            }, $cities ); ?>
                                <div class="meta-item">
                                    <strong><?php esc_html_e( 'Город:', 'medical-doctors' ); ?></strong> <?php echo
                                    implode( ', ', $city_names ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="doctor-content">
                        <h2><?php esc_html_e( 'О враче', 'medical-doctors' ); ?></h2>
                        <?php if ( has_excerpt() ) : ?>
                            <div class="doctor-excerpt"><?php the_excerpt(); ?></div><?php endif; ?>
                        <div class="doctor-description"><?php the_content(); ?></div>
                    </div>
                    <footer class="doctor-footer">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'doctors' ) ); ?>"
                           class="back-link">← <?php esc_html_e( 'Все врачи', 'medical-doctors' ); ?></a>
                    </footer>
                </article>
            <?php endwhile; ?>
        </div>
    </main>
<?php get_footer();