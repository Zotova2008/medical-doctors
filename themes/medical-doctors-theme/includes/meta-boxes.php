<?php if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function md_add_doctor_meta_boxes() {
    add_meta_box( 'md_doctor_details', __( 'Детали врача', 'medical-doctors' ), 'md_render_doctor_meta_box', 'doctors', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'md_add_doctor_meta_boxes' );

function md_render_doctor_meta_box( $post ) {
    wp_nonce_field( 'md_save_doctor_meta', 'md_doctor_meta_nonce' );
    $experience = absint( get_post_meta( $post->ID, '_md_doctor_experience', true ) );
    $price      = absint( get_post_meta( $post->ID, '_md_doctor_price', true ) );
    $rating     = floatval( get_post_meta( $post->ID, '_md_doctor_rating', true ) );
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="md_doctor_experience"><?php esc_html_e( 'Стаж (лет)', 'medical-doctors' ); ?></label>
            </th>
            <td><input type="number" id="md_doctor_experience" name="md_doctor_experience"
                       value="<?php echo esc_attr( $experience ); ?>" min="0" max="70" class="regular-text"/>
                <p class="description"><?php esc_html_e( 'Стаж врача в годах', 'medical-doctors' ); ?></p></td>
        </tr>
        <tr>
            <th><label for="md_doctor_price"><?php esc_html_e( 'Цена от', 'medical-doctors' ); ?></label></th>
            <td><input type="number" id="md_doctor_price" name="md_doctor_price"
                       value="<?php echo esc_attr( $price ); ?>" min="0" step="100" class="regular-text"/>
                <p class="description"><?php esc_html_e( 'Минимальная цена консультации', 'medical-doctors' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="md_doctor_rating"><?php esc_html_e( 'Рейтинг', 'medical-doctors' ); ?></label></th>
            <td><input type="number" id="md_doctor_rating" name="md_doctor_rating"
                       value="<?php echo esc_attr( $rating ); ?>" min="0" max="5" step="0.1" class="regular-text"/>
                <p class="description"><?php esc_html_e( 'Рейтинг от 0 до 5', 'medical-doctors' ); ?></p></td>
        </tr>
    </table>
    <?php
}

function md_save_doctor_meta_box( $post_id ) {
    if ( ! isset( $_POST['md_doctor_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['md_doctor_meta_nonce'] ) ), 'md_save_doctor_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['md_doctor_experience'] ) ) {
        update_post_meta( $post_id, '_md_doctor_experience', absint( $_POST['md_doctor_experience'] ) );
    }
    if ( isset( $_POST['md_doctor_price'] ) ) {
        update_post_meta( $post_id, '_md_doctor_price', absint( $_POST['md_doctor_price'] ) );
    }
    if ( isset( $_POST['md_doctor_rating'] ) ) {
        $rating = floatval( $_POST['md_doctor_rating'] );
        update_post_meta( $post_id, '_md_doctor_rating', max( 0, min( 5, $rating ) ) );
    }
}

add_action( 'save_post_doctors', 'md_save_doctor_meta_box' );