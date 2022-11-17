<?php 
/**
 * Radio component for the settings page
 */
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    update_option( $data['name'], sanitize_text_field( $_POST[ $data['name'] ] ) );
}
if(isset($data['options']) && is_array($data['options'])) {
    ?>
    <input type="hidden" name="<?php echo esc_attr( $data['name'] ?? '' ); ?>" value="">
    <div class="plugin-name-options">
        <?php
        foreach( $data['options'] as $option ) {
            ?>
            <label>
                <input 
                    type="radio" 
                    name="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
                    id="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
                    value="<?php echo esc_attr( $option['value'] ?? '' ); ?>"
                    <?php checked( $option['value'], get_option( $data['name'] ) ); ?>
                >
                <?php echo esc_html( $option['label'] ?? '' ); ?>
            </label>
            <?php
        }
        ?>
    </div>
    <?php
}