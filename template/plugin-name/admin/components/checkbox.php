<?php 
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    $_POST[ $data['name'] ] = is_array( $_POST[ $data['name'] ] ) ? $_POST[ $data['name'] ] : array();
    update_option( $data['name'], $_POST[ $data['name'] ] );
}
if(isset($data['options']) && is_array($data['options'])) {
    ?>
    <input type="hidden" name="<?php echo esc_attr( $data['name'] ?? '' ); ?>" value="">
    <div class="plugin-name-options">
        <?php
        $option_saved = get_option( $data['name'], array() );
        $option_saved = is_array( $option_saved ) ? $option_saved : array();
        foreach( $data['options'] as $key => $option ) {
            ?>
            <label>
                <input
                    type="checkbox" 
                    name="<?php echo esc_attr( $data['name'] ?? '' ); ?>[]"
                    id="<?php echo esc_attr( $data['name'] ?? '' ) . "-$key"; ?>"
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