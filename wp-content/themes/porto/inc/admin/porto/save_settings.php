<?php

add_action( 'admin_init', 'porto_compile_css' );

function porto_compile_css($import = false) {

    if ( current_user_can( 'manage_options' ) && (isset( $_GET['compile_theme'] ) || $import) ) {

        global $reduxPortoSettings;

        $reduxFramework = $reduxPortoSettings->ReduxFramework;
        $template_dir = porto_dir;

        // Compile SCSS files
        if (!class_exists('scssc')) {
            require_once( porto_admin . '/scssphp/scss.inc.php' );
        }

        // config file
        ob_start();
        require dirname(__FILE__) . '/config_scss_theme.php';
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/scss/_config_theme.scss';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        ob_start();
        $scss = new scssc();
        $scss->setImportPaths($template_dir . '/scss');
        $scss->setFormatter('scss_formatter');
        echo $scss->compile('@import "theme.scss"');
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/css/theme_'.get_current_blog_id().'.css';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        if (!$import) {
            // finally redirect to success page
            wp_redirect( admin_url( 'admin.php?page=porto_settings&compile_theme_success=true' ) );
        }
    }

    if ( current_user_can( 'manage_options' ) && (isset( $_GET['compile_theme_rtl'] ) || $import) ) {

        global $reduxPortoSettings;

        $reduxFramework = $reduxPortoSettings->ReduxFramework;
        $template_dir = porto_dir;

        // Compile SCSS files
        if (!class_exists('scssc')) {
            require_once( porto_admin . '/scssphp/scss.inc.php' );
        }

        // config file
        ob_start();
        require dirname(__FILE__) . '/config_scss_theme.php';
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/scss/_config_theme.scss';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        ob_start();
        $scss = new scssc();
        $scss->setImportPaths($template_dir . '/scss');
        $scss->setFormatter('scss_formatter');
        echo $scss->compile('@import "theme_rtl.scss"');
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/css/theme_rtl_'.get_current_blog_id().'.css';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        if (!$import) {
            // finally redirect to success page
            wp_redirect( admin_url( 'admin.php?page=porto_settings&compile_theme_rtl_success=true' ) );
        }
    }

    if ( current_user_can( 'manage_options' ) && (isset( $_GET['compile_plugins'] ) || $import) ) {

        global $reduxPortoSettings;

        $reduxFramework = $reduxPortoSettings->ReduxFramework;
        $template_dir = porto_dir;

        // Compile SCSS files
        if (!class_exists('scssc')) {
            require_once( porto_admin . '/scssphp/scss.inc.php' );
        }

        // config file
        ob_start();
        require dirname(__FILE__) . '/config_scss_plugins.php';
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/scss/_config_plugins.scss';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        ob_start();
        $scss = new scssc();
        $scss->setImportPaths($template_dir . '/scss');
        $scss->setFormatter('scss_formatter');
        echo $scss->compile('@import "plugins.scss"');
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/css/plugins_'.get_current_blog_id().'.css';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        if (!$import) {
            // finally redirect to success page
            wp_redirect( admin_url( 'admin.php?page=porto_settings&compile_plugins_success=true' ) );
        }
    }

    if ( current_user_can( 'manage_options' ) && (isset( $_GET['compile_plugins_rtl'] ) || $import) ) {

        global $reduxPortoSettings;

        $reduxFramework = $reduxPortoSettings->ReduxFramework;
        $template_dir = porto_dir;

        // Compile SCSS files
        if (!class_exists('scssc')) {
            require_once( porto_admin . '/scssphp/scss.inc.php' );
        }

        // config file
        ob_start();
        require dirname(__FILE__) . '/config_scss_plugins.php';
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/scss/_config_plugins.scss';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        ob_start();
        $scss = new scssc();
        $scss->setImportPaths($template_dir . '/scss');
        $scss->setFormatter('scss_formatter');
        echo $scss->compile('@import "plugins_rtl.scss"');
        $_config_css = ob_get_clean();

        $filename = $template_dir.'/css/plugins_rtl_'.get_current_blog_id().'.css';

        if (is_writable(dirname($filename)) == false){
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false){
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }
        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

        if (!$import) {
            // finally redirect to success page
            wp_redirect( admin_url( 'admin.php?page=porto_settings&compile_plugins_rtl_success=true' ) );
        }
    }
}

add_action('redux/options/porto_settings/saved', 'porto_save_theme_settings', 10, 2);
add_action('redux/options/porto_settings/import', 'porto_save_theme_settings', 10, 2);
add_action('redux/options/porto_settings/reset', 'porto_save_theme_settings');
add_action('redux/options/porto_settings/section/reset', 'porto_save_theme_settings');

function porto_config_value($value) {
    return isset($value) ? $value : 0;
}

function porto_save_theme_settings() {
    global $porto_settings;

    update_option('porto_init_theme', '1');

    update_option('porto_theme_type_'.get_current_blog_id(), $porto_settings['theme-type']);

    global $reduxPortoSettings;

    $reduxFramework = $reduxPortoSettings->ReduxFramework;
    $template_dir = porto_dir;

    // Compile LESS Files

    if (!class_exists('lessc')) {
        require_once( porto_admin . '/lessphp/less.inc.php' );
    }

    // config file

    ob_start();
    include dirname(__FILE__) . '/config_less.php';
    $_config_css = ob_get_clean();

    $filename = $template_dir.'/less/config.less';

    if (is_writable(dirname($filename)) == false){
        @chmod(dirname($filename), 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false){
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

    // skin css

    ob_start();
    $less = new lessc;

    echo $less->compileFile($template_dir.'/less/skin.less');

    if (isset($porto_settings['css-code']))
        echo $porto_settings['css-code'];

    $_config_css = ob_get_clean();

    $filename = $template_dir.'/css/skin_'.get_current_blog_id().'.css';

    if (is_writable(dirname($filename)) == false){
        @chmod(dirname($filename), 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false){
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

    // rtl skin css

    ob_start();
    $less = new lessc;

    echo $less->compileFile($template_dir.'/less/skin_rtl.less');

    if (isset($porto_settings['css-code']))
        echo $porto_settings['css-code'];

    $_config_css = ob_get_clean();

    $filename = $template_dir.'/css/skin_rtl_'.get_current_blog_id().'.css';

    if (is_writable(dirname($filename)) == false){
        @chmod(dirname($filename), 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false){
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));
}