<?php
/*
   Plugin Name: Melu Live Chat
   Plugin URI: http://wordpress.org/extend/plugins/melu-live-chat/
   Version: 1.0
   Author: Melu Ltd
   Description: Melu is a managed live chat service that provides live chat software via this plugin, and highly trained professional operators that look after it for you.
   Text Domain: melu-live-chat
   License: GPLv3
  */


$MeluLiveChat_minimalRequiredPhpVersion = '5.6';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function MeluLiveChat_noticePhpVersionWrong() {
    global $MeluLiveChat_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "Melu Live Chat" requires a newer version of PHP to be running.',  'melu-live-chat').
            '<br/>' . __('Minimal version of PHP required: ', 'melu-live-chat') . '<strong>' . $MeluLiveChat_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'melu-live-chat') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function MeluLiveChat_PhpVersionCheck() {
    global $MeluLiveChat_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $MeluLiveChat_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'MeluLiveChat_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function MeluLiveChat_i18n_init() {
    $pluginDir = dirname(plugin_basename(__FILE__));
    load_plugin_textdomain('melu-live-chat', false, $pluginDir . '/languages/');
}


//////////////////////////////////
// Run initialization
/////////////////////////////////

// Initialize i18n
add_action('plugins_loadedi','MeluLiveChat_i18n_init');

// Run the version check.
// If it is successful, continue with initialization for this plugin


//Defer Melu scripts

function melu_defer_script( $tag, $handle, $src )
{
    if ( 'melu_live_chat.js' != $handle ) {
        return $tag;
    }

    return str_replace( '<script', '<script defer', $tag );
}
add_filter( 'script_loader_tag', 'melu_defer_script', 10, 3 );

if (MeluLiveChat_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('melu-live-chat_init.php');

    MeluLiveChat_init(__FILE__);
}
