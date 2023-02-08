<?php 
/**
 * Text component for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    update_option( $key_option, stripslashes( sanitize_text_field( $_POST[ $key_option ] ) ) );
}
?>
<input 
    type="<?php echo esc_attr( $data['type'] ); ?>"
    name="<?php echo esc_attr( $key_option ?? '' ); ?>"
    class="regular-text"
    id="<?php echo esc_attr( $key_option ?? '' ); ?>"
    value="<?php echo esc_html( get_option( $key_option ?? '', $data['default'] ?? '' ) ); ?>"
    <?php echo isset( $data['pattern'] ) ? 'pattern="' . esc_attr( $data['pattern'] ) . '"' : ''; ?>
>