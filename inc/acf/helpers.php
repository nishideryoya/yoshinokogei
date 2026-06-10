<?php
/**
 * ACF ヘルパー関数
 */

function yoshino_opt($key, $default = '') {
    if (!yoshino_acf_active()) {
        return $default;
    }
    $val = get_field($key, 'option');
    return yoshino_acf_value($val, $default);
}

function yoshino_field($key, $post_id = false, $default = '') {
    if (!yoshino_acf_active()) {
        return $default;
    }
    $val = get_field($key, $post_id);
    return yoshino_acf_value($val, $default);
}

function yoshino_page_field($slug, $key, $default = '') {
    return yoshino_field($key, yoshino_get_page_id($slug), $default);
}

/**
 * スラッグから固定ページIDを取得（カスタムリライト時も安全）
 */
function yoshino_get_page_id($slug) {
    static $cache = [];
    if (!isset($cache[$slug])) {
        if (is_page($slug)) {
            $cache[$slug] = (int) get_queried_object_id();
        } else {
            $page = get_page_by_path($slug);
            $cache[$slug] = ($page && $page->post_status === 'publish') ? (int) $page->ID : 0;
        }
    }
    return $cache[$slug];
}

function yoshino_get_page_title($slug, $fallback = '') {
    $page_id = yoshino_get_page_id($slug);
    return $page_id ? get_the_title($page_id) : $fallback;
}

function yoshino_acf_value($val, $default = '') {
    if ($val === null || $val === false || $val === '') {
        return $default;
    }
    if (is_array($val) && empty($val)) {
        return $default;
    }
    return $val;
}

function yoshino_image_url($field_value, $fallback = '') {
    if (is_array($field_value)) {
        if (!empty($field_value['url'])) {
            return $field_value['url'];
        }
        if (!empty($field_value['ID'])) {
            $url = wp_get_attachment_image_url((int) $field_value['ID'], 'full');
            if ($url) {
                return $url;
            }
        }
    }
    if (is_numeric($field_value)) {
        $url = wp_get_attachment_image_url((int) $field_value, 'full');
        if ($url) {
            return $url;
        }
    }
    if (is_string($field_value) && filter_var($field_value, FILTER_VALIDATE_URL)) {
        return $field_value;
    }
    return $fallback;
}

function yoshino_page_hero_url($post_id = 0, $image_key = 'hero-main') {
    $fallback = yoshino_img($image_key);
    if ($post_id && yoshino_acf_active()) {
        return yoshino_image_url(get_field('hero_image', $post_id), $fallback);
    }
    return $fallback;
}

function yoshino_hero_image_style($post_id = 0, $image_key = 'hero-main') {
    $url = esc_url(yoshino_page_hero_url($post_id, $image_key));
    return "background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url('{$url}') no-repeat center/cover;";
}

function yoshino_taiken_meta($post_id, $key) {
    if (yoshino_acf_active()) {
        return yoshino_field('taiken_' . $key, $post_id, '');
    }
    return get_post_meta($post_id, 'taiken_' . $key, true);
}

function yoshino_map_meta($post_id, $key) {
    if (yoshino_acf_active()) {
        return yoshino_field($key, $post_id, '');
    }
    return get_post_meta($post_id, $key, true);
}

function yoshino_repeater_or_default($rows, array $default) {
    return (!empty($rows) && is_array($rows)) ? $rows : $default;
}

function yoshino_gallery_urls($gallery, array $fallback_keys = []) {
    $urls = [];
    if (!empty($gallery) && is_array($gallery)) {
        foreach ($gallery as $item) {
            $url = yoshino_image_url($item);
            if ($url) {
                $urls[] = $url;
            }
        }
    }
    if ($urls) {
        return $urls;
    }
    foreach ($fallback_keys as $key) {
        $urls[] = yoshino_img($key);
    }
    return $urls;
}
