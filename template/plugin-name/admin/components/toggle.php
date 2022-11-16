<?php 
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    $value_to_save = $_POST[ $data['name'] ] == '1' ? '1' : '0';
    update_option( $data['name'], sanitize_text_field( $_POST[ $data['name'] ] ) );
}
?>
<label class="switch">
    <input type="hidden" name="<?php echo esc_attr( $data['name'] ?? '' ); ?>" value="0">
    <input 
        type="checkbox" 
        name="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
        id="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
        value="1"
        <?php checked( '1', get_option( $data['name'] ) ); ?>
    >
    <span class="slider round"></span>
</label>