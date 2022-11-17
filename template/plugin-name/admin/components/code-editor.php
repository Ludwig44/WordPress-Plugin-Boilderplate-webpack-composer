<?php
/**
 * Code editor component like theme editor for the settings page
 */
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    update_option( $data['name'], $_POST[ $data['name'] ] );
}
?>
<textarea 
    name="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
    id="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
><?php echo esc_textarea( stripslashes(  get_option( $data['name'] ?? '' ) ) ); ?></textarea>

<style>
    <?php echo '.' . esc_attr( $data['name'] ) . '-container'; ?> > .CodeMirror {
        height: <?php echo esc_attr( $data['height'] ?? "auto" ); ?>;
    }
</style>

<?php
$settings = wp_enqueue_code_editor( array( 'type' => $data['mime_type'] ?? 'text/html' ) );

if ( $settings ) {
    wp_add_inline_script(
        'code-editor',
        sprintf(
            'jQuery( function() { wp.codeEditor.initialize( "'. $data['name'] .'", %s ); } );',
            wp_json_encode( $settings )
        )
    );
}
