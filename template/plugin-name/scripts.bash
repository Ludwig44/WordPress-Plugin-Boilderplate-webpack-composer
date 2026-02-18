#### REQUIREMENTS ####
# - fswatch (brew install fswatch)
# - sshpass (brew install hudochenkov/sshpass/sshpass) OR if not work (https://www.cyberciti.biz/faq/how-to-install-sshpass-on-macos-os-x/)

current_dir=$(pwd);
plugin_name="plugin-name";

# Extract version from plugin file
plugin_version=$(grep -m 1 "Version:" ${plugin_name}.php | sed 's/.*Version:[[:space:]]*//' | tr -d '[:space:]')
plugin_name_versioned="${plugin_name}-v${plugin_version}";

echo "----------------------------------------------------";
echo "-----------------🛠️ DEV SCRIPTS 🛠️-----------------";
echo "----------------------------------------------------";
echo "Plugin Name: $plugin_name";
echo "Plugin Version: $plugin_version";
echo "----------------------------------------------------";

# a menu to select action
echo "What do you want to do?";
echo "1. Export to ZIP file";
echo "2. Watch and sync with remote server";
echo "q: Exit";

read -p "Enter your choice: " choice;

if [ $choice = "1" ]
then 
    rm -rf $plugin_name-v*.zip;
    rm -rf $plugin_name;
    mkdir $plugin_name;
    exclude_files="--exclude=.* --exclude=README.md --exclude=.DS_Store --exclude=__MACOSX --exclude=scripts.bash --exclude=*.zip --exclude=scripts-local/* --exclude=public/assets/src/* --exclude=*package-lock.json --exclude=*package.json --exclude=*README.md --exclude=*webpack.config.js --exclude=*node_modules/*";
    rsync -avz $exclude_files ./ $plugin_name/;
    rm -rf ${plugin_name}-v*.zip;
    echo "Exporting to ZIP: $plugin_name_versioned.zip";
    zip -rq $plugin_name.zip $plugin_name;
    mv $plugin_name.zip $plugin_name_versioned.zip;
    rm -rf $plugin_name;
    
     # Open the folder
    open "$current_dir";
fi

if [ $choice = "2" ]
then 
    echo "Watching";
    # fswatch -o . | xargs -n1 -I{} sshpass -p 'YOURPASSWORD' rsync -avz --exclude '.gitignore' --exclude '.git' --exclude '.DS_Store' --exclude '*.zip' --exclude 'public/assets/package.json' --exclude 'public/assets/package-lock.json' --exclude 'public/assets/node_modules/*' --exclude 'public/src/*' --exclude 'scripts.bash' . USER@HOST:./PATH/wp-content/plugins/plugin-name/ --delete
fi
