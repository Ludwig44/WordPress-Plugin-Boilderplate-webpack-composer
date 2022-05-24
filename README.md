# WordPress-Plugin-Boilderplate-webpack-composer

## Introduction

This project allows with a simple bash command to create WP plugins already organized in the object-oriented format with the added bonus of a preconfiguration of composer and webpack for more modern plugins using for example scss.

This project is based on another Open Source project from DevinVinson: [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate).

I modified the initial project structure slightly and added mostly webpack and composer.

As well as a page for plugin settings, which in my experience is useful in 90% of projects, if you don't need it just remove it.

This project is ideally aimed at those who are comfortable with the DevinVision boilderplate but who wish to save time in setting it up.

## Installation & generation of plugin

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

## Translations

1. For use translation open your pot file in `/languages/plugin-name.pot` with Poedit.
2. Click on translation and properties
3. Add the name of your project and others properties
4. Save
5. Your file is ready for translation

## Composer usage

Execute all command for composer in `/includes`. For more documentation for composer [follow this link](https://getcomposer.org/).

The vendor is already installed when your plugin is generated unless composer was not installed on your machine, in this case go to `/includes` and run `composer install`.

## Webpack usage

Execute all command for webpack in `/public/src`. For more documentation for webpack [follow this link](https://webpack.js.org/).

### Install webpack

Just launch `npm install`

### Add JS files

1. In `/public/src/js` add a file for exemple `exemple.js`, you can import other files and component. For more information show [this documentation](https://webpack.js.org/api/module-methods/#import).
2. Add the new file in `/public/src/webpack.config.js` in `entry` const like this:
```
'exemple' : JS_DIR + '/exemple.js'
```
2. Launch compilation.
3. After lanch compilation, your file output in `/public/js`.

### Add SCSS files

1. In `/public/src/scss` add a file for exemple `exemple.scss`.
2. Add in your js file exemple : `/public/src/js/exemple.js` an import for scss file.
3. Launch compilation.
4. After lanch compilation, your file output in `/public/css`.

### Compilation

* If you are in dev environement you can use this command `npm run dev` for use hot reload and non minified code for js and css.
* If you are in prod environement you can use this command `npm run prod` for minified css and js code.