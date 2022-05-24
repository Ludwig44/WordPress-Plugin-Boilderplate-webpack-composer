echo "----------------------------------------------------";
echo "------🚜 Welcome in Boilderplate Generator 🚜 ------";
echo "--------------------By Ludwig44--------------------";
echo "------------https://github.com/Ludwig44/------------";
echo "----------------------------------------------------";

# a menu to select action
echo "What do you want to do?";
echo "1. Create a new plugin (required composer)";
echo "2. Delete all plugins in output folder";
echo "q: Exit";

read -p "Your choice: " choice;

# if output file doesnt exist, create it
if [ ! -d "output" ]; then
    mkdir output;
fi

if [ $choice = "1" ]
then
    echo "----------------------------------------------------";
    echo "--------------🏁 Start installation 🏁--------------";
    echo "----------------------------------------------------";

    echo "ℹ️ Please respect the format indicated, in order to ensure the compatibility of your plugin. ℹ️";

    read -p "❓ Enter your WordPress plugin name with this format 'Plugin_Name' : " plugin_name;
    read -p "❓ Enter your plugin uri with this format 'http://example.com/plugin-name-uri/' : " plugin_uri;
    read -p "❓ Enter your plugin author name with this format 'Your Name' : " plugin_author_name;
    read -p "❓ Enter your plugin author uri with this format 'http://example.com/' : " plugin_author_uri;
    read -p "❓ Enter your plugin author email with this format 'email@example.com' : " plugin_author_email;
    read -p "❓ Enter your plugin description with this format 'This is a short description of what the plugin does. It's displayed in the WordPress admin area.' : " plugin_description;

    #create vars
    plugin_name_lowercase=$(echo $plugin_name | tr '[:upper:]' '[:lower:]');
    plugin_name_uppercase=$(echo $plugin_name | tr '[:lower:]' '[:upper:]');
    plugin_name_with_hyphen=$(echo $plugin_name_lowercase | sed -e 's/_/-/g');
    plugin_name_with_space=$(echo $plugin_name | sed -e 's/_/ /g');
    files_parameters=$(echo \( -name "*.php" -o -name "*.json" -o -name "*.txt" -o -name "*.pot" -o -name "*.css" -o -name "*.js" \) );

    #create plugin dir
    mkdir -p ./output/$plugin_name_with_hyphen;

    #mv files from template to plugin dir
    cp -r ./template/plugin-name/* ./output/$plugin_name_with_hyphen/;

    #change http://example.com/plugin-name-uri/ to http://example.com/example-me/
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s,http://example.com/plugin-name-uri/,$plugin_uri,g";

    #change http://example.com/ to http://example.com/
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s,http://example.com/,$plugin_author_uri,g";

    #change Your Name to Example Name
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/Your Name/$plugin_author_name/g";

    #change email@example.com to me@example.com
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/email@example.com/$plugin_author_email/g";

    #change Plugin_Name to Example_Me
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/Plugin_Name/$plugin_name/g";

    #change plugin_name to example_me
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/plugin_name/$plugin_name_lowercase/g";

    #change PLUGIN_NAME_ to EXAMPLE_ME_
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/PLUGIN_NAME_/$plugin_name_uppercase\_/g";

    #change plugin-name to example-me
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/plugin-name/$plugin_name_with_hyphen/g";

    #change WordPress Plugin Boilerplate to Exemple Me
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/WordPress Plugin Boilerplate/$plugin_name_with_space/g";

    #change This is a short description of what the plugin does. It's displayed in the WordPress admin area. to Exemple Me is a plugin
    find ./output/$plugin_name_with_hyphen -type f $files_parameters -print0 | xargs -0 sed -i '' -e "s/This is a short description of what the plugin does. It's displayed in the WordPress admin area./$plugin_description/g";

    #rename files and folders from plugin-name to example-me
    find ./output/$plugin_name_with_hyphen -type d -iname '*plugin-name*' -depth -exec bash -c '
        mv "$1" "${1//plugin-name/'$plugin_name_with_hyphen'}"
    ' -- {} \;
    find ./output/$plugin_name_with_hyphen -type f -iname '*plugin-name*' -depth -exec bash -c '
        mv "$1" "${1//plugin-name/'$plugin_name_with_hyphen'}"
    ' -- {} \;

    #install composer
    echo "📦 Installing composer...";
    composer install --working-dir=./output/$plugin_name_with_hyphen/includes;
    echo "✅ Composer installed.";

    echo "----------------------------------------------------";
    echo "-------------🎉 Installation complete 🎉-------------";
    echo "----------------------------------------------------";
fi

if [ $choice = "2" ]
then
    read -p "Are you sure you want to delete all plugins in output folder? (y/n) : " choice;
    if [ $choice = "y" ]
    then
        echo "🗑️ Deleting all plugins in output folder...";
        rm -rf -v ./output/*;
        echo "✅ All plugins deleted.";
    fi
fi