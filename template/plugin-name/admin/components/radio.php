<?php 
/**
 * Radio component for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    update_option( $key_option, sanitize_text_field( $_POST[ $key_option ] ) );
}
if(isset($data['options']) && is_array($data['options'])) {
    ?>
    <input type="hidden" name="<?php echo esc_attr( $key_option ?? '' ); ?>" value="">
    <div class="quickwebp-options">
        <?php
        foreach( $data['options'] as $option ) {
            ?>
            <label>
                <input 
                    type="radio" 
                    name="<?php echo esc_attr( $key_option ?? '' ); ?>"
                    id="<?php echo esc_attr( $key_option ?? '' ); ?>"
                    value="<?php echo esc_attr( $option['value'] ?? '' ); ?>"
                    <?php checked( $option['value'], get_option( $key_option ) ); ?>
                >
                <?php echo esc_html( $option['label'] ?? '' ); ?>
            </label>
            <?php
        }
        ?>
    </div>
    <?php
}