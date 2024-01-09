#### REQUIREMENTS ####
# - fswatch (brew install fswatch)
# - sshpass (brew install hudochenkov/sshpass/sshpass) OR if not work (https://www.cyberciti.biz/faq/how-to-install-sshpass-on-macos-os-x/)

current_dir=$(pwd);
plugin_name="plugin-name";

echo "----------------------------------------------------";
echo "-----------------🛠️ DEV SCRIPTS 🛠️-----------------";
echo "----------------------------------------------------";

# a menu to select action
echo "What do you want to do?";
echo "1. Export to ZIP file";
echo "2. Watch and sync with remote server";
echo "q: Exit";

read -p "Enter your choice: " choice;

if [ $choice = "1" ]
then 
    rm -rf $plugin_name.zip;
    exclude_files="--exclude=.* --exclude=.DS_Store --exclude=__MACOSX --exclude=scripts.bash --exclude=$plugin_name.zip --exclude=public/assets/src/* --exclude=*package-lock.json --exclude=*package.json --exclude=*README.md --exclude=*webpack.config.js --exclude=*node_modules/*";
    echo "Exporting to ZIP";
    zip -rq $plugin_name.zip ./* $exclude_files;
    
     # Open the folder
    open "$current_dir";
fi

if [ $choice = "2" ]
then 
    echo "Watching";
    # fswatch -o . | xargs -n1 -I{} sshpass -p 'YOURPASSWORD' rsync -avz --exclude '.gitignore' --exclude '.git' --exclude '.DS_Store' --exclude 'public/assets/package.json' --exclude 'public/assets/package-lock.json' --exclude 'public/assets/node_modules/*' --exclude 'public/src/*' --exclude 'scripts.bash' . USER@HOST:./PATH/wp-content/plugins/plugin-name/ --delete
fi
