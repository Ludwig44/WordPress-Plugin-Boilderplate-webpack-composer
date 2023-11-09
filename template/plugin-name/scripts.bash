current_dir=$(pwd);
plugin_name="plugin-name";

echo "----------------------------------------------------";
echo "-----------------🛠️ DEV SCRIPTS 🛠️-----------------";
echo "----------------------------------------------------";

# a menu to select action
echo "What do you want to do?";
echo "1. Export to ZIP file";
echo "q: Exit";

read -p "Enter your choice: " choice;

if [ $choice = "1" ]
then 
    rm -rf $plugin_name.zip;
    exclude_files="--exclude=.* --exclude=.DS_Store --exclude=__MACOSX --exclude=scripts.bash --exclude=$plugin_name.zip --exclude=public/assets/src/* --exclude=*package-lock.json --exclude=*package.json --exclude=*README.md --exclude=*webpack.config.js --exclude=*node_modules/*";
    echo "Exporting to FREE version to ZIP";
    zip -rq $plugin_name.zip $plugin_name $exclude_files;
    
     # Open the folder
    open "$current_dir";
fi
