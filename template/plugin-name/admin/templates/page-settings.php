<?php
/**
 * The admin settings of the plugin.
 * @since      1.0.0
 */
?>
<h1><?php _e( "WordPress Plugin Boilerplate Settings", PLUGIN_NAME_TEXT_DOMAIN ); ?></h1>
<form action="" method="post">
    <table class="form-table">
        <?php $this->render_component( array(
            'type'        => 'text',
            'name'        => 'sample_input_text',
            'label'       => __( 'Input text', PLUGIN_NAME_TEXT_DOMAIN ),
            'description' => __( 'This is a sample input text.', PLUGIN_NAME_TEXT_DOMAIN ),
        ) ); ?>

        <?php $this->render_component( array(
            'type'        => 'textarea',
            'name'        => 'sample_input_textarea',
            'label'       => __( 'Input textarea', PLUGIN_NAME_TEXT_DOMAIN ),
            'description' => __( 'This is a sample input textarea.', PLUGIN_NAME_TEXT_DOMAIN ),
        ) ); ?>

        <?php $this->render_component( array(
            'type'        => 'code-editor',
            'name'        => 'sample_input_code_editor',
            'mime_type'   => 'text/html', // MIME Type list : https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types
            'label'       => __( 'Input code editor', PLUGIN_NAME_TEXT_DOMAIN ),
            'height'      => "100px",
            'description' => __( 'This is a sample code editor.', PLUGIN_NAME_TEXT_DOMAIN ),
        ) ); ?>
        
        <?php $this->render_component( array(
            'type'        => 'media',
            'name'        => 'sample_input_media',
            'multiple'    => true,
            'label'       => __( 'Input media', PLUGIN_NAME_TEXT_DOMAIN ),
            'description' => __( 'This is a sample input media.', PLUGIN_NAME_TEXT_DOMAIN ),
        ) ); ?>

        <?php $this->render_component( array(
            'type'        => 'toggle',
            'name'        => 'sample_input_toggle',
            'label'       => __( 'Input toggle', PLUGIN_NAME_TEXT_DOMAIN ),
            'description' => __( 'This is a sample input toggle.', PLUGIN_NAME_TEXT_DOMAIN ),
        ) ); ?>

        <?php $this->render_component( array(
            'type'        => 'radio',
            'name'        => 'sample_input_radio',
            'label'       => __( 'Input radio', PLUGIN_NAME_TEXT_DOMAIN ),
            'description' => __( 'This is a sample input radio.', PLUGIN_NAME_TEXT_DOMAIN ),
            'options'    => array(
                array(
                    'label' => __( 'Option 1', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-1',
                ),
                array(
                    'label' => __( 'Option 2', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-2',
                ),
                array(
                    'label' => __( 'Option 3', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-3',
                ),
            ),
        ) ); ?>

        <?php $this->render_component( array(
            'type'        => 'checkbox',
            'name'        => 'sample_input_checkbox',
            'label'       => __( 'Input checkbox', PLUGIN_NAME_TEXT_DOMAIN ),
            'description' => __( 'This is a sample input checkbox.', PLUGIN_NAME_TEXT_DOMAIN ),
            'options'    => array(
                array(
                    'label' => __( 'Option 1', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-1',
                ),
                array(
                    'label' => __( 'Option 2', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-2',
                ),
                array(
                    'label' => __( 'Option 3', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-3',
                ),
            ),
        ) ); ?>

        <?php $this->render_component( array(
            'type'        => 'select',
            'name'        => 'sample_input_select',
            'label'       => __( 'Input select', PLUGIN_NAME_TEXT_DOMAIN ),
            'description' => __( 'This is a sample input select.', PLUGIN_NAME_TEXT_DOMAIN ),
            'placeholder' => __( 'Select', PLUGIN_NAME_TEXT_DOMAIN ),
            'options'    => array(
                array(
                    'label' => __( 'Option 1', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-1',
                ),
                array(
                    'label' => __( 'Option 2', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-2',
                ),
                array(
                    'label' => __( 'Option 3', PLUGIN_NAME_TEXT_DOMAIN ),
                    'value' => 'option-3',
                ),
            ),
        ) ); ?>

        <?php $this->render_component( array(
            'type'        => 'range-slider',
            'min'         => 0,
            'max'         => 100,
            'step'        => 1,
            'unit'        => '%',
            'name'        => 'sample_range_slider',
            'label'       => __( 'Sample Range Slider', PLUGIN_NAME_TEXT_DOMAIN ),
            'default'     => 50,
        )); ?>
        
    </table>
    <?php submit_button(); ?>
</form>