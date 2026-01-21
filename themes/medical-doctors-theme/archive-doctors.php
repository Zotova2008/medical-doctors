<?php
get_header();
?>
    <main id="primary" class="site-main">
        <div class="container">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Архив врачей', 'medical-doctors' ); ?></h1>
                <p class="archive-description"><?php esc_html_e( 'Найдите лучших врачей по специализации и городу', 'medical-doctors' ); ?></p>
            </header>
            <div class="doctors-filters">
                <form method="GET" action="<?php echo esc_url( get_post_type_archive_link( 'doctors' ) ); ?>"
                      class="filters-form">
                    <div class="filter-group">
                        <label for="specialization"><?php esc_html_e( 'Специализация:', 'medical-doctors' ); ?></label>
                        <select name="specialization" id="specialization">
                            <option value=""><?php esc_html_e( 'Все специализации', 'medical-doctors' ); ?></option>
                            <?php
                            $specializations = get_terms( [ 'taxonomy' => 'specialization', 'hide_empty' => false ] );
                            $current_spec    = isset( $_GET['specialization'] ) ? sanitize_text_field( wp_unslash( $_GET['specialization'] ) ) : '';
                            foreach ( $specializations as $spec ) {
                                printf( '<option value="%s" %s>%s</option>', esc_attr( $spec->slug ), selected( $current_spec, $spec->slug, false ), esc_html( $spec->name ) );
                            }
                            ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="city"><?php esc_html_e( 'Город:', 'medical-doctors' ); ?></label>
                        <select name="city" id="city">
                            <option value=""><?php esc_html_e( 'Все города', 'medical-doctors' ); ?></option>
                            <?php
                            $cities       = get_terms( [ 'taxonomy' => 'city', 'hide_empty' => false ] );
                            $current_city = isset( $_GET['city'] ) ? sanitize_text_field( wp_unslash( $_GET['city'] ) ) : '';
                            foreach ( $cities as $city ) {
                                printf( '<option value="%s" %s>%s</option>', esc_attr( $city->slug ), selected( $current_city, $city->slug, false ), esc_html( $city->name ) );
                            }
                            ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="sort"><?php esc_html_e( 'Сортировать:', 'medical-doctors' ); ?></label>
                        <select name="sort" id="sort">
                            <option value=""><?php esc_html_e( 'По умолчанию', 'medical-doctors' ); ?></option>
                            <option value="rating" <?php selected( isset( $_GET['sort'] ) ? $_GET['sort'] : '', 'rating' ); ?>><?php esc_html_e( 'По рейтингу (высокий → низкий)', 'medical-doctors' ); ?></option>
                            <option value="price_asc" <?php selected( isset( $_GET['sort'] ) ? $_GET['sort'] : '', 'price_asc' ); ?>><?php esc_html_e( 'По цене (дешёвый → дорогой)', 'medical-doctors' ); ?></option>
                            <option value="experience" <?php selected( isset( $_GET['sort'] ) ? $_GET['sort'] : '', 'experience' ); ?>><?php esc_html_e( 'По стажу (большой → маленький)', 'medical-doctors' ); ?></option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <button type="submit"
                                class="filter-submit"><?php esc_html_e( 'Применить фильтры', 'medical-doctors' ); ?></button>
                    </div>
                    <div class="filter-group">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'doctors' ) ); ?>"
                           class="filter-reset"><?php esc_html_e( 'Сбросить', 'medical-doctors' ); ?></a>
                    </div>
                </form>
            </div>
            <?php if ( have_posts() ) : ?>
                <div class="doctors-grid">
                    <?php while ( have_posts() ) : the_post();
                        $experience      = md_get_doctor_experience();
                        $price           = md_get_doctor_price();
                        $rating          = md_get_doctor_rating();
                        $specializations = get_the_terms( get_the_ID(), 'specialization' );
                        $spec_names      = [];
                        if ( $specializations && ! is_wp_error( $specializations ) ) {
                            $spec_names = array_slice( array_map( function ( $term ) {
                                return $term->name;
                            }, $specializations ), 0, 2 );
                        }
                        ?>
                        <article class="doctor-card">
                            <div class="card-image">
                                <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'thumbnail', [ 'class' => 'doctor-thumbnail' ] );
                                } else {
                                    echo '<div class="no-image">' . esc_html__( 'Нет фото', 'medical-doctors' ) . '</div>';
                                } ?>
                            </div>
                            <div class="card-content">
                                <h2 class="doctor-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <?php if ( ! empty( $spec_names ) ) : ?>
                                    <div class="doctor-specializations">
                                        <strong><?php esc_html_e( 'Специализация:', 'medical-doctors' ); ?></strong> <?php echo esc_html( implode( ', ', $spec_names ) ); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="doctor-meta-small">
                                    <span class="experience"><strong><?php esc_html_e( 'Стаж:', 'medical-doctors' ); ?></strong> <?php echo esc_html( $experience . ' ' . __( 'лет', 'medical-doctors' ) ); ?></span>
                                    <span class="price"><strong><?php esc_html_e( 'Цена:', 'medical-doctors' ); ?></strong> <?php echo esc_html( number_format( $price, 0 ) . ' ' . __( 'руб.', 'medical-doctors' ) ); ?></span>
                                    <span class="rating"><strong><?php esc_html_e( 'Рейтинг:', 'medical-doctors' ); ?></strong> <?php echo wp_kses_post( md_display_star_rating( $rating ) ); ?></span>
                                </div>
                                <a href="<?php the_permalink(); ?>"
                                   class="card-link"><?php esc_html_e( 'Подробнее →', 'medical-doctors' ); ?></a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <div class="pagination-wrapper">
                    <?php the_posts_pagination( [
                            'mid_size'  => 2,
                            'prev_text' => __( '← Назад', 'medical-doctors' ),
                            'next_text' => __( 'Вперёд →', 'medical-doctors' )
                    ] ); ?>
                </div>
            <?php else : ?>
                <p class="no-doctors"><?php esc_html_e( 'Врачи не найдены. Попробуйте изменить фильтры.', 'medical-doctors' ); ?></p>
            <?php endif;
            wp_reset_postdata(); ?>
        </div>
    </main>
<?php get_footer(); ?>