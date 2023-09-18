=== User Role Editor Pro ===
Contributors: Vladimir Garagulya (https://www.role-editor.com)
Tags: user, role, editor, security, access, permission, capability
Requires at least: 4.4
Tested up to: 5.9.2
Stable tag: 4.62.1
Requires PHP: 7.3
License URI: https://www.role-editor.com/end-user-license-agreement/

User Role Editor Pro WordPress plugin makes user roles and capabilities changing easy. Edit/add/delete WordPress user roles and capabilities.

== Description ==

User Role Editor Pro WordPress plugin allows you to change user roles and capabilities easy.
Just turn on check boxes of capabilities you wish to add to the selected role and click "Update" button to save your changes. That's done. 
Add new roles and customize its capabilities according to your needs, from scratch of as a copy of other existing role. 
Unnecessary self-made role can be deleted if there are no users whom such role is assigned.
Role assigned every new created user by default may be changed too.
Capabilities could be assigned on per user basis. Multiple roles could be assigned to user simultaneously.
You can add new capabilities and remove unnecessary capabilities which could be left from uninstalled plugins.
Multi-site support is provided.

== Installation ==

Installation procedure:

1. Deactivate plugin if you have the previous version installed.
2. Extract "user-role-editor-pro.zip" archive content to the "/wp-content/plugins/user-role-editor-pro" directory.
3. Activate "User Role Editor Pro" plugin via 'Plugins' menu in WordPress admin menu. 
4. Go to the "Settings"-"User Role Editor" and adjust plugin options according to your needs. For WordPress multisite URE options page is located under Network Admin Settings menu.
5. Go to the "Users"-"User Role Editor" menu item and change WordPress roles and capabilities according to your needs.

In case you have a free version of User Role Editor installed: 
Pro version includes its own copy of a free version (or the core of a User Role Editor). So you should deactivate free version and can remove it before installing of a Pro version. 
The only thing that you should remember is that both versions (free and Pro) use the same place to store their settings data. 
So if you delete free version via WordPress Plugins Delete link, plugin will delete automatically its settings data. Changes made to the roles will stay unchanged.
You will have to configure lost part of the settings at the User Role Editor Pro Settings page again after that.
Right decision in this case is to delete free version folder (user-role-editor) after deactivation via FTP, not via WordPress.

== Changelog ==

= [4.62.1] 29.03.2022 =
* Core version: 4.61.2
* Update: Marked as compatible with WordPress 5.9.2
* Fix: Gravity Forms access add-on: 
*   - Uncaught Error: Call to undefined method URE_GF_Access_User::get_fg_list() in /wp-content/plugins/user-role-editor-pro/pro/includes/classes/gf-access-user.php:211
*   - All Gravity Forms were available for the user in spite of the restrictions set for him in some cases.
*   - Button "Gravity Forms" did not work at "Users->User Role Editor" page. 


= [4.62] 07.03.2022 =
* Core version: 4.61.2
* Update: Marked as compatible with WordPress 5.9.1
* New: It's possible to import all user roles at once from previously exported CSV file.
* New: "Edit posts restrictions" add-on: It's possible to replicate  settings from the main site to all other subsites of the multisite network (Network admin->Users->User Role Editor->Update Network).
* Core version was updated to version 4.61.2
* Fix: "Users->Add New" page - other selected roles were not saved.
* Update: URE uses WordPress notification styles for own operation result output.


Full list of changes is available in changelog.txt file.
