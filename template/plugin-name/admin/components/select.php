<?php 
/**
 * Select component for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    update_option( $key_option, sanitize_text_field( $_POST[ $key_option ] ) );
}
if(isset($data['options']) && is_array($data['options'])) {
    ?>
    <select 
        name="<?php echo esc_attr( $key_option ?? '' ); ?>"
        id="<?php echo esc_attr( $key_option ?? '' ); ?>"
    >
        <option value="">
            <?php echo esc_html( $data['placeholder'] ?? __( 'Select an option', QUICKWEBP_TEXT_DOMAIN ) ); ?>
        </option>
        <?php
        $option_saved = get_option( $key_option );
        foreach( $data['options'] as $option ) {
            ?>
            <option 
                value="<?php echo esc_attr( $option['value'] ?? '' ); ?>"
                <?php selected( $option['value'], $option_saved ); ?>
            >
                <?php echo esc_html( $option['label'] ?? '' ); ?>
            </option>
            <?php
        }
        ?>
    </select>
    <?php
}