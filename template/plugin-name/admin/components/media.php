<?php
if( isset( $data['name'], $_POST[ $data['name'] ] ) ) {
    update_option( $data['name'], sanitize_text_field( $_POST[ $data['name'] ] ) );
}
wp_enqueue_media();
$is_multiple = isset( $data['multiple'] ) && $data['multiple'] === true ? 'true' : 'false';
$image_preview_template = '<img src="%s" title="%s" class="media-preview-image">';

?>
<div class="plugin-name-media-input-container">
    <input 
        type="hidden" 
        name="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
        id="<?php echo esc_attr( $data['name'] ?? '' ); ?>"
        value="<?php echo esc_attr( get_option( $data['name'] ) ); ?>"
    >
    <div id="<?php echo esc_attr( $data['name'] ?? '' ); ?>_medias-selected" class="plugin-name-medias-selected-container">
        <?php
        $medias = explode( ',', get_option( $data['name'] ) );
        foreach( $medias as $media_id ) {
            $media = get_post( $media_id );
            if( $media ) {
                if( wp_attachment_is_image( $media_id ) ) {
                    echo sprintf( $image_preview_template, wp_get_attachment_image_url( $media_id, 'thumbnail' ), $media->post_title );
                } else {
                    echo sprintf( $image_preview_template, wp_mime_type_icon( $media->post_mime_type ), $media->post_title );
                }
            }
        }
        ?>
    </div>
    <input type="button" 
        name="<?php echo esc_attr( $data['name'] ?? '' ); ?>_button"
        id="<?php echo esc_attr( $data['name'] ?? '' ); ?>_button"
        class="button button-secondary"
        value="<?php echo esc_attr( $data['button_text'] ?? __( 'Select media', PLUGIN_NAME_TEXT_DOMAIN ) ); ?>"
    >
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        const id = '<?php echo esc_attr( $data['name'] ?? '' ); ?>';
        const media_template_preview = '<?php echo $image_preview_template; ?>';
        jQuery( "#" + id + "_button" ).click(function(e) {
            e.preventDefault();
            var image = wp.media({ 
                title: '<?php echo esc_attr( $data['button_text'] ?? __( 'Select media', PLUGIN_NAME_TEXT_DOMAIN ) ); ?>',
                multiple: <?php echo esc_attr( $is_multiple ); ?>
            })

            image.on('select', function(e){
                console.log(image.state().get('selection').toJSON());
                const medias = image.state().get('selection').toJSON();
                let selected_medias_preview = '';
                let medias_ids = '';
                medias.forEach( media => {
                    medias_ids = medias_ids === '' ? media.id : medias_ids + ',' + media.id;
                    console.log(medias_ids);
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
            });

            image.on('open', function(e){
                console.log(id);
                const medias_ids = jQuery( "#" + id ).val();
                console.log(medias_ids);
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
    });
</script>