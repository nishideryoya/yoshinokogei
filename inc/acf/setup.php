<?php
/**
 * ACF 初期設定
 */

function yoshino_acf_active() {
    return function_exists('get_field') && function_exists('acf_add_local_field_group');
}

/**
 * オプションページ（サイト共通設定）
 */
function yoshino_acf_options_page() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title'  => 'サイト設定',
        'menu_title'  => 'サイト設定',
        'menu_slug'   => 'yoshino-site-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'icon_url'    => 'dashicons-admin-site',
        'position'    => 2,
    ]);
}
add_action('acf/init', 'yoshino_acf_options_page');

/**
 * フィールドグループを JSON でテーマに保存（バージョン管理・同期用）
 */
function yoshino_acf_json_save_point($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/save_json', 'yoshino_acf_json_save_point');

function yoshino_acf_json_load_point($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'yoshino_acf_json_load_point');

/**
 * 旧メタボックスは ACF に統一
 */
function yoshino_disable_legacy_meta_boxes() {
    if (!yoshino_acf_active()) {
        return;
    }
    remove_action('add_meta_boxes', 'yoshino_taiken_meta_boxes');
    remove_action('add_meta_boxes', 'yoshino_map_spot_meta_boxes');
    remove_action('save_post_taiken', 'yoshino_save_taiken_meta');
    remove_action('save_post_map_spot', 'yoshino_save_map_spot_meta');
}
add_action('acf/init', 'yoshino_disable_legacy_meta_boxes', 20);

function yoshino_acf_admin_notice() {
    if (yoshino_acf_active()) {
        return;
    }
    if (!current_user_can('activate_plugins')) {
        return;
    }
    echo '<div class="notice notice-warning"><p>';
    echo '吉野工芸の里テーマ：コンテンツ編集には <strong>Advanced Custom Fields</strong> プラグインの有効化が必要です。';
    echo '</p></div>';
}
add_action('admin_notices', 'yoshino_acf_admin_notice');

function yoshino_acf_bootstrap() {
    if (!yoshino_acf_active()) {
        return;
    }
    $fields = get_stylesheet_directory() . '/inc/acf/fields.php';
    if (!is_readable($fields)) {
        return;
    }
    require_once $fields;
}
add_action('acf/init', 'yoshino_acf_bootstrap');
