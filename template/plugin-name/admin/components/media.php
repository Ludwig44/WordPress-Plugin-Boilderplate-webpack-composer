<?php
/**
 * Media component for the settings page
 */

$key_option = sanitize_key( $data['name'] );

if( isset( $key_option, $_POST[ $key_option ] ) ) {
    update_option( $key_option, sanitize_text_field( $_POST[ $key_option ] ) );
}

wp_enqueue_media();
$is_multiple = isset( $data['multiple'] ) && $data['multiple'] === true ? 'true' : 'false';
$image_preview_template = '<img src="%s" title="%s" class="media-preview-image">';

$medias_string = isset( $key_option ) ? get_option( $key_option, '' ) : '';
$medias        = $medias_string ? explode( ',', $medias_string ) : array();
?>
<div class="quickwebp-media-input-container">
    <div id="<?php echo esc_attr( $key_option ?? '' ); ?>_is_empty" class="quickwebp-media-input--is-empty" style="display: <?php echo !empty($medias) ? 'none' : 'block'; ?>">
        <?php _e( 'No image selected', PLUGIN_NAME_TEXT_DOMAIN ); ?>
    </div>
    <input 
        type="hidden" 
        name="<?php echo esc_attr( $key_option ?? '' ); ?>"
        id="<?php echo esc_attr( $key_option ?? '' ); ?>"
        value="<?php echo esc_attr( $medias_string ); ?>"
    >
    <div id="<?php echo esc_attr( $key_option ?? '' ); ?>_medias-selected" class="quickwebp-medias-selected-container">
        <?php
        foreach( $medias as $media_id ) {
            $media = get_post( $media_id );
            if( $media ) {
                if( wp_attachment_is_image( $media_id ) ) {
                    echo wp_kses_post( sprintf( $image_preview_template, wp_get_attachment_image_url( $media_id, 'thumbnail' ), $media->post_title ) );
                } else {
                    echo wp_kses_post( sprintf( $image_preview_template, wp_mime_type_icon( $media->post_mime_type ), $media->post_title ) );
                }
            }
        }
        ?>
    </div>
    <input type="button" 
        name="<?php echo esc_attr( $key_option ?? '' ); ?>_button"
        id="<?php echo esc_attr( $key_option ?? '' ); ?>_button"
        class="button button-secondary"
        value="<?php echo esc_attr( $data['button_text'] ?? __( 'Select media', PLUGIN_NAME_TEXT_DOMAIN ) ); ?>"
    >
    <input type="button" 
        name="<?php echo esc_attr( $key_option ?? '' ); ?>_remove_button"
        id="<?php echo esc_attr( $key_option ?? '' ); ?>_remove_button"
        class="button button-secondary button-remove-media"
        value="<?php echo esc_attr( $data['remove_button_text'] ?? __( 'Remove medias', PLUGIN_NAME_TEXT_DOMAIN ) ); ?>"
        <?php echo empty( $medias ) ? 'disabled' : ''; ?>
    >
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        const id = '<?php echo esc_attr( $key_option ?? '' ); ?>';
        const media_template_preview = '<?php echo wp_kses_post($image_preview_template); ?>';
        jQuery( "#" + id + "_button" ).click(function(e) {
            e.preventDefault();
            var image = wp.media({ 
                title: '<?php echo esc_attr( $data['button_text'] ?? __( 'Select media', PLUGIN_NAME_TEXT_DOMAIN ) ); ?>',
                multiple: <?php echo esc_attr( $is_multiple ); ?>
            })

            image.on('select', function(e){
                const medias = image.state().get('selection').toJSON();
                let selected_medias_preview = '';
                let medias_ids = '';
                medias.forEach( media => {
                    medias_ids = medias_ids === '' ? media.id : medias_ids + ',' + media.id;
                    let preview_image = '';
                    if( media.type === 'image' ) {
                        preview_image = media.sizes.thumbnail.url;
                    } else {
                        preview_image = media.icon;
                    }
                    selected_medias_preview += media_template_preview.replace( '%s', preview_image ).replace( '%s', media.title );
                });
                jQuery( "#" + id + "_medias-selected" ).html( selected_medias_preview );
                jQuery( "#" + id ).val( medias_ids );
                
                jQuery( "#" + id + "_remove_button" ).prop( 'disabled', false );
                jQuery( '#' + id + "_is_empty" ).hide();
            });

            image.on('open', function(e){
                const medias_ids = jQuery( "#" + id ).val();
                if( medias_ids !== '' ) {
                    const medias = medias_ids.split(',');
                    const selection = image.state().get('selection');
                    medias.forEach( media_id => {
                        const media = wp.media.attachment( media_id );
                        media.fetch();
                        selection.add( media ? [ media ] : [] );
                    });
                }
            });

            image.open();
            
        });

        jQuery( "#" + id + "_remove_button" ).click(function(e) {
            e.preventDefault();
            jQuery( "#" + id + "_medias-selected" ).html( '' );
            jQuery( "#" + id ).val( '' );
            
            jQuery( "#" + id + "_remove_button" ).attr( 'disabled', 'disabled' );
            jQuery( '#' + id + "_is_empty" ).show();
        });
    });
</script>