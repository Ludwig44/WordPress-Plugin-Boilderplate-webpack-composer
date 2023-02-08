<?php 
/**
 * Checkbox component for the settings page
 */
$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {

    $value = is_array($_POST[ $key_option ]) ? array_map( 'sanitize_text_field', $_POST[ $key_option ] ) : array();
    update_option( $key_option, $value );
    
}
if(isset($data['options']) && is_array($data['options'])) {
    ?>
    <input type="hidden" name="<?php echo esc_attr( $key_option ?? '' ); ?>" value="">
    <div class="quickwebp-options">
        <?php
        $option_saved = get_option( $key_option, $data['default'] );
        $option_saved = is_array( $option_saved ) ? $option_saved : array();
        foreach( $data['options'] as $key => $option ) {
            ?>
            <label>
                <input
                    type="checkbox" 
                    name="<?php echo esc_attr( $key_option ?? '' ); ?>[]"
                    id="<?php echo esc_attr( ($key_option ?? '') . "-$key" ); ?>"
                    value="<?php echo esc_attr( $option['value'] ?? '' ); ?>"
                    <?php checked( in_array( $option['value'], $option_saved ) ); ?>
                >
                <?php echo esc_html( $option['label'] ?? '' ); ?>
            </label>
            <?php
        }
        ?>
    </div>
    <?php
}