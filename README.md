# WordPress-Plugin-Boilderplate-webpack-composer

## Introduction

This project allows with a simple bash command to create WP plugins already organized in the object-oriented format with the added bonus of a preconfiguration of composer and webpack for more modern plugins using for example scss.

This project is based on another Open Source project from DevinVinson: [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate).

I modified the initial project structure slightly and added mostly webpack and composer.

As well as a page for plugin settings, which in my experience is useful in 90% of projects, if you don't need it just remove it.

This project is ideally aimed at those who are comfortable with the DevinVision boilderplate but who wish to save time in setting it up.

## Installation & generation of plugin

![Image](https://media1.giphy.com/media/k1iWAv6dAx037tRhTh/giphy.gif?cid=790b7611d5abca383e80a49957e882e84037be80f184a5dd&rid=giphy.gif&ct=g)

1. Clone project
```
git clone git@github.com:Ludwig44/WordPress-Plugin-Boilderplate-webpack-composer.git;
cd WordPress-Plugin-Boilderplate-webpack-composer;
```
2. To generate a new plugin it's very simple, just run the following command on the install.bash file at the root of the project:
```
bash install.bash
```
3. Follow the instructions in your terminal.
4. Go to the output folder and copy the generate folder to your plugin folder in your WordPress installation.
5. Don't forget to activate your new plugin in your WordPress.
6. Finish

## Constantes

All constantes defined by the plugin (the name `PLUGIN_NAME` is replace by your plugin name):

1. `PLUGIN_NAME_VERSION` : The version of your plugin.
2. `PLUGIN_NAME_TEXT_DOMAIN` : The text domain of your plugin for internationnalisation.
3. `PLUGIN_NAME_PLUGIN_PATH` : The plugin path for include files.
4. `PLUGIN_NAME_PLUGIN_URL` : The plugin url to include script or style for example.

## Cron job

The plugin template embed a cron job class, for easily add cron job. For add one just follow this steps:

1. Go to `/admin/class-cron-job`, in `plugin_name_crons_list()` function
2. Add an element in the array with the following syntax (you have an exemple commmented in the file):
```
'exemple' => array(
        "file_path" => "admin/cron/exemple.php", // Replace by your cron job file path
        'interval' 	=> HOUR_IN_SECONDS * 24, // Replace by your interval
        'display' 	=> __( 'Exemple of description', PLUGIN_NAME_TEXT_DOMAIN ) // Replace by your description
    )
``` 
3. Add file in the cron folder at `/admin/cron/` or in other path.
4. You can test cron with [WP Control](https://wordpress.org/plugins/wp-crontrol/)

## Translations

1. For use translation open your pot file in `/languages/plugin-name.pot` with Poedit.
2. Click on translation and properties
3. Add the name of your project and others properties
4. Save
5. Your file is ready for translation

## Composer usage

Execute all command for composer in `/includes`. For more documentation for composer [follow this link](https://getcomposer.org/).

The vendor is already installed when your plugin is generated unless composer was not installed on your machine, in this case go to `/includes` and run `composer install`.

## Webpack usage (changed for [@wordpress/scripts](https://www.npmjs.com/package/@wordpress/scripts))

Execute all command for @wordpress/scripts in `/public/assets`.

### Install node modules

Just launch `npm install`

### Add JS files

1. In `public/assets/src/js` add a file for exemple `exemple.js`, you can import other files and component. For more information show [this documentation](https://webpack.js.org/api/module-methods/#import).
2. Launch compilation with `npm run dev` or `npm run prod` command.
3. After lanch compilation, your file output in `public/assets/build`.

### Add SCSS files

1. In `public/assets/src/scss` add a file for exemple `exemple.scss`.
2. Add in your js file exemple : `public/assets/src/js/exemple.js` an import for scss file.
3. Launch compilation.
4. After lanch compilation, your file output in `public/assets/build`.

### Compilation

* If you are in dev environement you can use this command `npm run dev` for use hot reload and non minified code for js and css.
* If you are in prod environement you can use this command `npm run prod` for minified css and js code.

### Output files and usage in WordPress
When you compile files, you have 3 types of files in `public/assets/build` folder:
* `plugin-name.asset.php` : This file is for register script and style in WordPress.
* `plugin-name.js` : This file is for js code.
* `plugin-name.css` : This file is for css code.

For use this files in WordPress, you have to register script and style in your plugin. For this you have to use `wp_register_script` and `wp_register_style` functions. For more information [follow this link](https://developer.wordpress.org/reference/functions/wp_register_script/).

You can use this code for register script and style in WordPress:
```
$assets_data = include( PLUGIN_NAME_PLUGIN_PATH . 'public/assets/build/plugin-name.asset.php' );
wp_enqueue_script( 'plugin-name-js', PLUGIN_NAME_PLUGIN_URL . 'public/assets/build/plugin-name.js', $assets_data['dependencies'] ?? array(), $assets_data['version'] ?? filemtime( PLUGIN_NAME_PLUGIN_PATH . 'public/assets/build/plugin-name.js' ), true );
wp_enqueue_style( 'plugin-name-css', PLUGIN_NAME_PLUGIN_URL . 'public/assets/build/plugin-name.css', array(), filemtime( PLUGIN_NAME_PLUGIN_PATH . 'public/assets/build/plugin-name.css' ) );
```