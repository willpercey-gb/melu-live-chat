<?php


include_once('MeluLiveChat_LifeCycle.php');

class MeluLiveChat_Plugin extends MeluLiveChat_LifeCycle {



    /**
     * @return array of option meta data.
     */
    public function getOptionMetaData() {
        return array(
            'key' => __('Product Key'),
        );
    }

//    protected function getOptionValueI18nString($optionValue) {
//        $i18nValue = parent::getOptionValueI18nString($optionValue);
//        return $i18nValue;
//    }

    protected function initOptions() {
        $options = $this->getOptionMetaData();
        if (!empty($options)) {
            foreach ($options as $key => $arr) {
                if (is_array($arr) && count($arr > 1)) {
                    $this->addOption($key, $arr[1]);
                }
            }
        }
    }

    public function getPluginDisplayName() {
        return 'Melu Live Chat';
    }

    protected function getMainPluginFileName() {
        return 'melu-live-chat.php';
    }

    /**
     * Called by install() to create any database tables if needed.
     * Best Practice:
     * (1) Prefix all table names with $wpdb->prefix
     * (2) make table names lower case only
     * @return void
     */
    protected function installDatabaseTables() {
//                global $wpdb;
//                $tableName = $this->prefixTableName('melu');
//                $wpdb->query("CREATE TABLE IF NOT EXISTS `$tableName` (
//                    `id` INTEGER NOT NULL");
    }

    /**
     * Drop plugin-created tables on uninstall.
     * @return void
     */
    protected function unInstallDatabaseTables() {
//                global $wpdb;
//                $tableName = $this->prefixTableName('melu');
//                $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
    }


    /**
     * Perform actions when upgrading from version X to version Y
     * @return void
     */
    public function upgrade() {
    }

    public function addActionsAndFilters() {

        // Add options administration page
        add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));
        add_action('wp_enqueue_scripts', array(&$this, 'queueScripts'));
        add_action('admin_enqueue_scripts', array(&$this, 'adminScripts'));
        // Example adding a script & style just for the options administration page
        //        if (strpos($_SERVER['REQUEST_URI'], $this->getSettingsSlug()) !== false) {
        //            wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));
        //            wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //        }


        // Add Actions & Filters

        // Adding scripts & styles to all pages
        // Examples:
                //wp_enqueue_script('jquery');
        //        wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));


        // Register short codes


        // Register AJAX hooks

    }
    public function queueScripts(){
        wp_register_script('melu_live_chat.js','https://meluchat.com/livechat/script.php?id='.$this->getOption("key"));
        wp_enqueue_script('melu_live_chat.js');
        wp_localize_script('melu_live_chat.js', 'MeluJS',array('id'=> $this->getOption("key"),));
    }

    public function adminScripts(){
        wp_enqueue_style( 'melu_style', plugins_url('css/melu_app.css', __FILE__) );
    }

}
