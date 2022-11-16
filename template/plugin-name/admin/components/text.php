<?php 
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    update_option( $data['name'], sanitize_text_field( $_POST[ $data['name'] ] ) );
}
?>
<input 
    type="<?php echo esc_attr( $data['type'] ); ?>"
    name="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
    class="regular-text"
    id="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
    value="<?php echo esc_html( get_option( $data['name'] ) ); ?>"
    <?php echo isset( $data['pattern'] ) ? 'pattern="' . esc_attr( $data['pattern'] ) . '"' : ''; ?>
>