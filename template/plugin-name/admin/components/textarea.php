<?php 
/**
 * Textarea component for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    update_option( $key_option, stripslashes( sanitize_textarea_field( $_POST[ $key_option ] ) ) );
}
?>
<textarea 
    name="<?php echo esc_attr( $key_option ?? '' ); ?>"
    class="regular-text"
    id="<?php echo esc_attr( $key_option ?? '' ); ?>"
    <?php echo isset( $data['pattern'] ) ? 'pattern="' . esc_attr( $data['pattern'] ) . '"' : ''; ?>
><?php echo esc_html( get_option( $key_option ) ); ?></textarea>