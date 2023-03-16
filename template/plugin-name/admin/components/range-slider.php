<?php 
/**
 * Range slider component for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    update_option( $key_option, stripslashes( sanitize_text_field( $_POST[ $key_option ] ) ) );
}
?>

<div class="rang-slider regular-text">
    <input 
        type="range"
        min="<?php echo esc_attr( $data['min'] ?? 1 ); ?>"
        max="<?php echo esc_attr( $data['max'] ?? 100 ); ?>"
        step="<?php echo esc_attr( $data['step'] ?? 1 ); ?>"
        name="<?php echo esc_attr( $key_option ?? '' ); ?>"
        id="<?php echo esc_attr( $key_option ?? '' ); ?>"
        value="<?php echo esc_html( get_option( $key_option ?? '', $data['default'] ?? '' ) ); ?>"
        <?php echo isset( $data['pattern'] ) ? 'pattern="' . esc_attr( $data['pattern'] ) . '"' : ''; ?>
    >
    <span class="value">
        <span class="value-num"><?php echo esc_html( get_option( $key_option ?? '', $data['default'] ?? '' ) ); ?></span>
        <span class="value-unit"><?php echo esc_html( $data['unit'] ?? '' ); ?></span>
    </span>
    <div class="progress"></div>
</div>