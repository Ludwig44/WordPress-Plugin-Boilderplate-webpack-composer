<?php 
/**
 * Select component for the settings page
 */
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    update_option( $data['name'], sanitize_text_field( $_POST[ $data['name'] ] ) );
}
if(isset($data['options']) && is_array($data['options'])) {
    ?>
    <select 
        name="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
        id="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
    >
        <option value="">
            <?php echo esc_html( $data['placeholder'] ?? __( 'Select an option', PLUGIN_NAME_TEXT_DOMAIN ) ); ?>
        </option>
        <?php
        $option_saved = get_option( $data['name'] );
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