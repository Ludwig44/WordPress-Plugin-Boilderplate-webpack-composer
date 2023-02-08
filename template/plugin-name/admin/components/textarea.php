<?php 
/**
 * Textarea component for the settings page
 */
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    update_option( $data['name'], stripslashes( sanitize_textarea_field( $_POST[ $data['name'] ] ) ) );
}
?>
<textarea 
    name="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
    class="regular-text"
    id="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
    <?php echo isset( $data['pattern'] ) ? 'pattern="' . esc_attr( $data['pattern'] ) . '"' : ''; ?>
><?php echo esc_html( get_option( $data['name'] ) ); ?></textarea>