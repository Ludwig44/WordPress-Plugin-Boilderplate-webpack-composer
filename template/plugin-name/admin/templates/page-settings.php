<?php
/**
 * Provide a admin area view for the plugin settings.
 *
 * @link       http://example.com/
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/templates
 */
?>
<h1><?php echo __('WordPress Plugin Boilerplate settings', PLUGIN_NAME_TEXT_DOMAIN); ?></h1>
<form action="" method="post">
    <table class="form-table">
        <?php self::render_fields(); ?>
    </table>
    <?php submit_button(); ?>
</form>