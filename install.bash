
echo "🏁 Start installation 🏁";

read -p "Enter your WordPress plugin name with this format 'Plugin_Name' : " plugin_name;

#change Plugin_Name to Example_Me
find . -type f \( -name "*.php" -o -name "*.txt" -o -name "*.pot" -o -name "*.css" -o -name "*.js" \) -print0 | xargs -0 sed -i '' -e "s/Plugin_Name/$plugin_name/g";

plugin_name_lowercase=$(echo $plugin_name | tr '[:upper:]' '[:lower:]');

#change plugin_name to example_me
find . -type f \( -name "*.php" -o -name "*.txt" -o -name "*.pot" -o -name "*.css" -o -name "*.js" \) -print0 | xargs -0 sed -i '' -e "s/plugin_name/$plugin_name_lowercase/g";

plugin_name_uppercase=$(echo $plugin_name | tr '[:lower:]' '[:upper:]');

#change PLUGIN_NAME_ to EXAMPLE_ME_
find . -type f \( -name "*.php" -o -name "*.txt" -o -name "*.pot" -o -name "*.css" -o -name "*.js" \) -print0 | xargs -0 sed -i '' -e "s/PLUGIN_NAME_/$plugin_name_uppercase\_/g";

plugin_name_with_hyphen=$(echo $plugin_name_lowercase | sed -e 's/_/-/g');

#change plugin-name to example-me
find . -type f \( -name "*.php" -o -name "*.txt" -o -name "*.pot" -o -name "*.css" -o -name "*.js" \) -print0 | xargs -0 sed -i '' -e "s/plugin-name/$plugin_name_with_hyphen/g";

#rename files and folders from plugin-name to example-me
find . -type d -iname '*plugin-name*' -depth -exec bash -c '
    mv "$1" "${1//plugin-name/'$plugin_name_with_hyphen'}"
' -- {} \;
find . -type f -iname '*plugin-name*' -depth -exec bash -c '
    mv "$1" "${1//plugin-name/'$plugin_name_with_hyphen'}"
' -- {} \;

echo "🎉 Installation complete 🎉";