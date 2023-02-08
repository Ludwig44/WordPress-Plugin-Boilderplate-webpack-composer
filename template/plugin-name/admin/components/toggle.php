<?php 
/**
 * Toggle component like IOS style for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    $value_to_save = $_POST[ $key_option ] == '1' ? '1' : '0';
    update_option( $key_option, sanitize_text_field( $_POST[ $key_option ] ) );
}
?>
<label class="switch">
    <input type="hidden" name="<?php echo esc_attr( $key_option ?? '' ); ?>" value="0">
    <input 
        class="<?php echo esc_attr( $data['classes'] ?? ''); ?>"
        type="checkbox" 
        name="<?php echo esc_attr( $key_option ?? '' ); ?>"
        id="<?php echo esc_attr( $key_option ?? '' ); ?>"
        value="1"
        <?php checked( '1', get_option( $key_option, $data['default'] ?? '' ) ); ?>
    >
    <span class="slider round"></span>
</label>