<?php
/**
 * Code editor component like theme editor for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    update_option( $key_option, $_POST[ $key_option ] );
}
?>
<textarea 
    name="<?php echo esc_attr( $key_option ?? '' ); ?>"
    id="<?php echo esc_attr( $key_option ?? '' ); ?>"
><?php echo esc_textarea( stripslashes(  get_option( $key_option ?? '' ) ) ); ?></textarea>

<style>
    <?php echo '.' . esc_attr( $key_option ) . '-container'; ?> > .CodeMirror {
        height: <?php echo esc_attr( $data['height'] ?? "auto" ); ?>;
    }
</style>

<?php
$settings = wp_enqueue_code_editor( array( 'type' => $data['mime_type'] ?? 'text/html' ) );

if ( $settings ) {
    wp_add_inline_script(
        'code-editor',
        sprintf(
            'jQuery( function() { wp.codeEditor.initialize( "'. $key_option .'", %s ); } );',
            wp_json_encode( $settings )
        )
    );
}
