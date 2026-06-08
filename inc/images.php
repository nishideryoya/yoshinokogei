<?php
/**
 * テーマ共通の仮画像（placehold.jp）
 * 施設マスタの image もここから参照
 */

function yoshino_theme_images() {
    static $images = null;
    if ($images !== null) {
        return $images;
    }

    $images = [
        'default'       => 'https://placehold.jp/24/cccccc/ffffff/800x500.png?text=Photo',
        'hero-main'     => get_stylesheet_directory_uri() . '/assets/images/hero-main.jpg',
        'about-main'    => get_stylesheet_directory_uri() . '/assets/images/about-main.jpg',
        'hero-news'     => 'https://placehold.jp/24/4a5568/ffffff/1200x420.png',
        'hero-about'    => 'https://placehold.jp/24/5a8f4a/ffffff/1200x420.png',
        'hero-guide'    => 'https://placehold.jp/24/6b5344/ffffff/1200x420.png',
        'hero-taiken'   => 'https://placehold.jp/24/4682b4/ffffff/1200x420.png',
        'hero-map'      => 'https://placehold.jp/24/8b7355/ffffff/1200x420.png',
        'hero-sakka'    => 'https://placehold.jp/24/6a5acd/ffffff/1200x420.png',
        'about-nature'  => 'https://placehold.jp/24/5a8f4a/ffffff/800x600.png?text=%E7%99%BD%E5%B1%B1%E8%87%A8',
        'about-craft'   => 'https://placehold.jp/24/8b4513/ffffff/800x500.png?text=%E5%B7%A5%E8%8A%B8%E4%BD%93%E9%A8%93',
        'about-salon'   => 'https://placehold.jp/24/7a5238/ffffff/800x500.png?text=%E9%B4%89%E8%8D%89',
        'taiken-default'=> 'https://placehold.jp/24/4682b4/ffffff/640x360.png?text=%E4%BD%93%E9%A8%93',
        'news-1'        => get_stylesheet_directory_uri() . '/assets/images/news-1.jpg',
        'news-2'        => get_stylesheet_directory_uri() . '/assets/images/news-2.jpg',
        'news-3'        => get_stylesheet_directory_uri() . '/assets/images/news-3.jpg',
        'sakka-default' => 'https://placehold.jp/24/6a5acd/ffffff/400x400.png?text=Artist',
        'sakka-work'    => 'https://placehold.jp/24/8b4513/ffffff/400x400.png?text=Work',
        'instagram-1'   => 'https://placehold.jp/24/e8839a/ffffff/400x400.png?text=IG+1',
        'instagram-2'   => 'https://placehold.jp/24/6a5acd/ffffff/400x400.png?text=IG+2',
        'instagram-3'   => 'https://placehold.jp/24/3d9a8b/ffffff/400x400.png?text=IG+3',
        'instagram-4'   => 'https://placehold.jp/24/c9a227/ffffff/400x400.png?text=IG+4',
        'instagram-5'   => 'https://placehold.jp/24/5f9ea0/ffffff/400x400.png?text=IG+5',
        'instagram-6'   => 'https://placehold.jp/24/7d4e6d/ffffff/400x400.png?text=IG+6',
    ];

    if (function_exists('yoshino_map_spot_defaults')) {
        foreach (yoshino_map_spot_defaults() as $spot) {
            if (!empty($spot['image'])) {
                $images['facility-' . $spot['slug']] = $spot['image'];
            }
        }
    }

    return $images;
}

/**
 * @param string $key 画像キー（facility-tenji-kan など）
 */
function yoshino_img($key, $fallback_key = 'default') {
    $images = yoshino_theme_images();
    if (isset($images[$key])) {
        return $images[$key];
    }
    if ($fallback_key && isset($images[$fallback_key])) {
        return $images[$fallback_key];
    }
    return $images['default'];
}

/**
 * ページヒーロー用の background スタイル（文字入り画像は使わない）
 */
function yoshino_hero_bg_style($key) {
    if (strpos((string) $key, 'facility-') === 0) {
        $key = 'hero-map';
    }
    $url = esc_url(yoshino_img($key));
    return "background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url('{$url}') no-repeat center/cover;";
}

/**
 * 体験教室カード用（投稿IDから仮画像を割り当て）
 */
function yoshino_taiken_card_image($post_id = 0) {
    if ($post_id && has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, 'medium_large');
    }
    $keys  = ['facility-taiken-kobo', 'facility-washi-taiken', 'facility-tenji-kan', 'taiken-default'];
    $index = $post_id ? ((int) $post_id % count($keys)) : 0;
    return yoshino_img($keys[$index]);
}

/**
 * 作家アイコン用
 */
function yoshino_sakka_avatar_image($post_id = 0) {
    if ($post_id && has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, 'medium');
    }
    $keys  = ['sakka-default', 'facility-tenji-kan', 'facility-shop', 'facility-mokko-center'];
    $index = $post_id ? ((int) $post_id % count($keys)) : 0;
    return yoshino_img($keys[$index]);
}

/**
 * お知らせカード用
 */
function yoshino_news_card_image($post_id = 0) {
    if ($post_id && has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, 'medium_large');
    }
    $keys  = ['news-1', 'news-2', 'news-3'];
    $index = $post_id ? ((int) $post_id % 3) : 0;
    return yoshino_img($keys[$index]);
}
