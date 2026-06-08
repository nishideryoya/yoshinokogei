<?php
/**
 * 吉野工芸の里リニューアルテーマ functions.php
 */

require_once get_stylesheet_directory() . '/inc/images.php';
require_once get_stylesheet_directory() . '/inc/acf/setup.php';
require_once get_stylesheet_directory() . '/inc/acf/helpers.php';

function yoshino_enqueue_scripts() {
    // 1. Bootstrap (CSS & JS)
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), null, true);

    // 2. Swiper (CSS & JS)
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    // JS本体
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);

    // 3. 自作メインJS（必ず swiper-js より後に読み込むよう依存関係を指定）
    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array('swiper-js'), null, true);

    // 4. テーマのメインCSS
    wp_enqueue_style('main-style', get_stylesheet_uri(), array('bootstrap', 'swiper-css'));

    if (yoshino_is_map_page() || is_singular('map_spot')) {
        wp_enqueue_script(
            'yoshino-map-js',
            get_stylesheet_directory_uri() . '/assets/js/map.js',
            array(),
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'yoshino_enqueue_scripts');

/**
 * テーマのセットアップ
 */
function yoshino_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'yoshino_theme_setup');

function register_custom_post_sakka() {
    register_post_type('sakka', [
        'labels' => ['name' => '作家'],
        'public' => true,
        'has_archive' => true, // これで一覧ページが有効になる
        'menu_position' => 5,
        'supports' => ['title', 'editor', 'thumbnail'],
        'rewrite' => ['slug' => 'sakka'],
    ]);
}
add_action('init', 'register_custom_post_sakka');

/**
 * 作家一覧ページ（アーカイブ）の表示件数を24件に変更する
 */
function change_sakka_posts_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }
    // 作家一覧ページ（sakka）のときだけ実行
    if ( is_post_type_archive( 'sakka' ) ) {
        $query->set( 'posts_per_page', 24 );
    }
}
add_action( 'pre_get_posts', 'change_sakka_posts_per_page' );

/**
 * 体験教室のカスタム投稿タイプ
 */
function register_taiken_post_type() {
    register_post_type('taiken', [
        'labels' => [
            'name'          => '体験教室',
            'singular_name' => '体験教室',
            'add_new_item'  => '体験教室を追加',
            'edit_item'     => '体験教室を編集',
        ],
        'public'       => true,
        'has_archive'  => false,
        'menu_position'=> 6,
        'menu_icon'    => 'dashicons-art',
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite'      => ['slug' => 'workshop', 'with_front' => false],
    ]);
}
add_action('init', 'register_taiken_post_type');

/**
 * 体験教室のカスタムフィールド（メタボックス）
 */
function yoshino_taiken_meta_boxes() {
    add_meta_box('taiken_details', '体験教室の詳細', 'yoshino_taiken_meta_box_callback', 'taiken', 'normal', 'high');
}
add_action('add_meta_boxes', 'yoshino_taiken_meta_boxes');

function yoshino_taiken_meta_box_callback($post) {
    wp_nonce_field('yoshino_taiken_save', 'yoshino_taiken_nonce');
    $fields = [
        'price'    => ['label' => '料金', 'placeholder' => '例：1,500円（材料費込）'],
        'duration' => ['label' => '所要時間', 'placeholder' => '例：約60分'],
        'capacity' => ['label' => '定員', 'placeholder' => '例：各回10名'],
        'target'   => ['label' => '対象', 'placeholder' => '例：小学生以上（未就学児は保護者同伴）'],
        'location' => ['label' => '場所', 'placeholder' => '例：和紙漉き体験棟'],
    ];
    echo '<table class="form-table"><tbody>';
    foreach ($fields as $key => $field) {
        $value = get_post_meta($post->ID, 'taiken_' . $key, true);
        printf(
            '<tr><th><label for="taiken_%1$s">%2$s</label></th><td><input type="text" id="taiken_%1$s" name="taiken_%1$s" value="%3$s" class="regular-text" placeholder="%4$s"></td></tr>',
            esc_attr($key),
            esc_html($field['label']),
            esc_attr($value),
            esc_attr($field['placeholder'])
        );
    }
    echo '</tbody></table>';
}

function yoshino_save_taiken_meta($post_id) {
    if (!isset($_POST['yoshino_taiken_nonce']) || !wp_verify_nonce($_POST['yoshino_taiken_nonce'], 'yoshino_taiken_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    foreach (['price', 'duration', 'capacity', 'target', 'location'] as $key) {
        if (isset($_POST['taiken_' . $key])) {
            update_post_meta($post_id, 'taiken_' . $key, sanitize_text_field($_POST['taiken_' . $key]));
        }
    }
}
add_action('save_post_taiken', 'yoshino_save_taiken_meta');

/**
 * お知らせ用カテゴリーの初期登録
 */
function yoshino_register_news_categories() {
    $categories = [
        'event'  => 'イベント',
        'info'   => 'お知らせ',
        'notice' => '重要',
    ];
    foreach ($categories as $slug => $name) {
        if (!term_exists($slug, 'category')) {
            wp_insert_term($name, 'category', ['slug' => $slug]);
        }
    }
}
add_action('after_setup_theme', 'yoshino_register_news_categories');

/**
 * 固定ページ用リライト（pagename で正しいページクエリを読み込む）
 */
function yoshino_register_taiken_rewrite() {
    add_rewrite_rule('^taiken/?$', 'index.php?pagename=taiken', 'top');
}
add_action('init', 'yoshino_register_taiken_rewrite');

/**
 * 体験教室の固定ページを自動作成（管理画面に1回ログインで実行）
 */
function yoshino_maybe_create_taiken_page() {
    if (!is_admin() || !current_user_can('edit_pages')) {
        return;
    }
    if (get_option('yoshino_taiken_page_ready')) {
        return;
    }

    if (!get_page_by_path('taiken')) {
        $page_id = wp_insert_post([
            'post_title'   => '体験教室',
            'post_name'    => 'taiken',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ]);
        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-taiken.php');
        }
    }

    update_option('yoshino_taiken_page_ready', 1);
    flush_rewrite_rules(false);
}
add_action('admin_init', 'yoshino_maybe_create_taiken_page');

/**
 * リライトルールをフラッシュ（テーマ更新時）
 * ※ news / map は WordPress 標準の固定ページURLを使う（独自リライトはクエリを壊す）
 */
function yoshino_flush_rewrite_rules() {
    yoshino_register_taiken_rewrite();
    yoshino_register_about_rewrite();
    yoshino_register_guide_rewrite();
    if (get_option('yoshino_rewrite_ver') !== '8') {
        flush_rewrite_rules(false);
        update_option('yoshino_rewrite_ver', '8');
    }
}
add_action('init', 'yoshino_flush_rewrite_rules', 99);

/**
 * 現在URLの先頭スラッグ（サブディレクトリ設置にも対応）
 */
function yoshino_current_request_slug() {
    global $wp;
    if (isset($wp->request) && $wp->request !== '') {
        $parts = explode('/', trim((string) $wp->request, '/'));
        return $parts[0] ?? '';
    }

    $path = wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (!$path) {
        return '';
    }
    $path = trim($path, '/');
    $home_path = trim((string) wp_parse_url(home_url('/'), PHP_URL_PATH), '/');
    if ($home_path !== '' && strpos($path, $home_path) === 0) {
        $path = trim(substr($path, strlen($home_path)), '/');
    }
    $parts = explode('/', $path);

    return $parts[0] ?? '';
}

/**
 * お知らせ・開催情報一覧のリクエストか
 */
function yoshino_is_news_archive_request() {
    if (is_home() && !is_front_page()) {
        return true;
    }

    $posts_page_id = (int) get_option('page_for_posts');
    if ($posts_page_id && (is_page($posts_page_id) || is_page('news'))) {
        return true;
    }

    if (yoshino_current_request_slug() === 'news') {
        return true;
    }

    global $wp;
    if (isset($wp->query_vars['pagename']) && $wp->query_vars['pagename'] === 'news') {
        return true;
    }

    return false;
}

/**
 * トップ用固定ページを取得（なければ作成）
 */
function yoshino_get_or_create_top_page_id() {
    foreach (['top', 'home'] as $slug) {
        $page = get_page_by_path($slug);
        if ($page && $page->post_status === 'publish') {
            return (int) $page->ID;
        }
    }

    $page_id = wp_insert_post([
        'post_title'   => 'トップ',
        'post_name'    => 'top',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '',
    ]);

    return (is_wp_error($page_id) || !$page_id) ? 0 : (int) $page_id;
}

/**
 * 表示設定の整合性（トップと投稿ページの取り違え防止）
 */
function yoshino_apply_reading_settings_fix() {
    $news_page = get_page_by_path('news');
    if (!$news_page || $news_page->post_status !== 'publish') {
        return;
    }

    $news_id       = (int) $news_page->ID;
    $posts_page_id = (int) get_option('page_for_posts');
    $front_page_id = (int) get_option('page_on_front');

    if (!$posts_page_id) {
        update_option('page_for_posts', $news_id);
        $posts_page_id = $news_id;
    }

    // 投稿ページがフロントに設定されていると /news/ が front-page.php になる
    if ($posts_page_id && $front_page_id === $posts_page_id) {
        $top_id = yoshino_get_or_create_top_page_id();
        if ($top_id) {
            update_option('page_on_front', $top_id);
            update_option('show_on_front', 'page');
        }
    }
}

/**
 * 各一覧・固定ページに正しいテンプレートを割り当て
 */
function yoshino_template_router($template) {
    // /news/ は is_front_page() でも必ず一覧テンプレートへ
    if (yoshino_is_news_archive_request()) {
        $news_template = get_stylesheet_directory() . '/home.php';
        if (file_exists($news_template)) {
            return $news_template;
        }
    }

    $slug = yoshino_current_request_slug();
    if (is_page('map') || $slug === 'map') {
        $map_template = get_stylesheet_directory() . '/page-map.php';
        if (file_exists($map_template)) {
            return $map_template;
        }
    }

    return $template;
}
add_filter('template_include', 'yoshino_template_router', 99);

/**
 * 投稿ページ（/news/）が固定ページクエリになった場合に投稿一覧へ補正
 */
function yoshino_fix_posts_page_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    $posts_page_id = (int) get_option('page_for_posts');
    $news_page     = get_page_by_path('news');
    if (!$posts_page_id && $news_page) {
        $posts_page_id = (int) $news_page->ID;
    }

    $slug     = yoshino_current_request_slug();
    $pagename = (string) $query->get('pagename');
    $is_news  = ($slug === 'news' || $pagename === 'news')
        || ($posts_page_id && (int) $query->get('page_id') === $posts_page_id);

    if (!$is_news) {
        return;
    }

    if ($query->is_page() && !$query->is_home()) {
        $query->set('page_id', '');
        $query->set('pagename', '');
        $query->set('post_type', 'post');
        $query->set('posts_per_page', get_option('posts_per_page'));
        $query->is_page     = false;
        $query->is_singular = false;
        $query->is_home     = true;
    }
}
add_action('pre_get_posts', 'yoshino_fix_posts_page_query');

/**
 * 体験教室ページのURL
 */
function yoshino_taiken_page_url() {
    $page = get_page_by_path('taiken');
    if ($page && $page->post_status === 'publish') {
        $url = get_permalink($page);
        if ($url) {
            return $url;
        }
    }
    return trailingslashit(home_url('/taiken'));
}

/**
 * お知らせ（News & Events）一覧のURL
 */
function yoshino_news_archive_url() {
    $posts_page_id = (int) get_option('page_for_posts');
    if ($posts_page_id) {
        $url = get_permalink($posts_page_id);
        if ($url) {
            return $url;
        }
    }
    $page = get_page_by_path('news');
    if ($page && $page->post_status === 'publish') {
        $url = get_permalink($page);
        if ($url) {
            return $url;
        }
    }
    return trailingslashit(home_url('/news'));
}

function yoshino_maybe_create_news_page() {
    if (get_option('yoshino_news_page_ready')) {
        return;
    }
    if (!is_admin() || !current_user_can('edit_pages')) {
        return;
    }

    $page = get_page_by_path('news');
    if (!$page) {
        $page_id = wp_insert_post([
            'post_title'  => 'お知らせ',
            'post_name'   => 'news',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_content'=> '',
        ]);
        if ($page_id && !is_wp_error($page_id)) {
            update_option('page_for_posts', $page_id);
        }
    } elseif (!get_option('page_for_posts')) {
        update_option('page_for_posts', $page->ID);
    }

    update_option('yoshino_news_page_ready', 1);
}
add_action('init', 'yoshino_maybe_create_news_page', 12);

/**
 * 表示設定の整合性を確保（管理画面ログイン時・初回フロント表示時）
 */
function yoshino_ensure_reading_settings() {
    if (get_option('yoshino_reading_settings_ver') === '2') {
        return;
    }

    if (is_admin() && !current_user_can('manage_options')) {
        return;
    }

    yoshino_apply_reading_settings_fix();
    update_option('yoshino_reading_settings_ver', '2');
    delete_option('yoshino_reading_settings_ready');
}
add_action('init', 'yoshino_ensure_reading_settings', 5);
add_action('admin_init', 'yoshino_ensure_reading_settings');

/**
 * マップ施設（スポット）のカスタム投稿タイプ
 */
function register_map_spot_post_type() {
    register_post_type('map_spot', [
        'labels' => [
            'name'          => '施設',
            'singular_name' => '施設',
            'add_new_item'  => '施設を追加',
            'edit_item'     => '施設を編集',
        ],
        'public'       => true,
        'has_archive'  => false,
        'menu_position'=> 7,
        'menu_icon'    => 'dashicons-location-alt',
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'rewrite'      => ['slug' => 'spot', 'with_front' => false],
    ]);
}
add_action('init', 'register_map_spot_post_type');

function yoshino_map_spot_meta_boxes() {
    add_meta_box('map_spot_position', 'マップ上の位置', 'yoshino_map_spot_meta_box_callback', 'map_spot', 'side', 'high');
}
add_action('add_meta_boxes', 'yoshino_map_spot_meta_boxes');

function yoshino_map_spot_meta_box_callback($post) {
    wp_nonce_field('yoshino_map_spot_save', 'yoshino_map_spot_nonce');
    $x     = get_post_meta($post->ID, 'map_x', true);
    $y     = get_post_meta($post->ID, 'map_y', true);
    $color = get_post_meta($post->ID, 'map_color', true) ?: 'coral';
    $icon  = get_post_meta($post->ID, 'map_icon', true) ?: 'geo-alt';
    $colors = [
        'coral'  => 'コーラル',
        'purple' => 'パープル',
        'teal'   => 'ティール',
        'brown'  => 'ブラウン',
        'blue'   => 'ブルー',
        'gold'   => 'ゴールド',
        'sky'    => 'スカイ',
        'stone'  => 'ストーン',
        'orange' => 'オレンジ',
        'wine'   => 'ワイン',
    ];
    echo '<p><label for="map_x">横位置（%）</label><br><input type="number" id="map_x" name="map_x" value="' . esc_attr($x) . '" min="0" max="100" step="0.1" class="small-text"> %</p>';
    echo '<p><label for="map_y">縦位置（%）</label><br><input type="number" id="map_y" name="map_y" value="' . esc_attr($y) . '" min="0" max="100" step="0.1" class="small-text"> %</p>';
    echo '<p><label for="map_color">アイコン色</label><br><select id="map_color" name="map_color">';
    foreach ($colors as $key => $label) {
        printf('<option value="%s" %s>%s</option>', esc_attr($key), selected($color, $key, false), esc_html($label));
    }
    echo '</select></p>';
    echo '<p><label for="map_icon">アイコン（Bootstrap Icons 名）</label><br>';
    echo '<input type="text" id="map_icon" name="map_icon" value="' . esc_attr($icon) . '" class="regular-text" placeholder="例：palette"></p>';
    echo '<p class="description">マップのピン位置は 0〜100 の数値で指定します。</p>';
}

function yoshino_save_map_spot_meta($post_id) {
    if (!isset($_POST['yoshino_map_spot_nonce']) || !wp_verify_nonce($_POST['yoshino_map_spot_nonce'], 'yoshino_map_spot_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    foreach (['map_x', 'map_y', 'map_color', 'map_icon'] as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
        }
    }
}
add_action('save_post_map_spot', 'yoshino_save_map_spot_meta');

/**
 * 園内マップSVG上のピン位置（%）
 */
function yoshino_map_pin_layout() {
    return [
        'tenji-kan'      => ['x' => 35.5, 'y' => 36],
        'taiken-kobo'    => ['x' => 50.8, 'y' => 48],
        'dining'         => ['x' => 35.8, 'y' => 70],
        'sculpture-park' => ['x' => 24.8, 'y' => 76],
        'shop'           => ['x' => 62.4, 'y' => 37],
        'washi-taiken'   => ['x' => 16.5, 'y' => 50],
        'mokko-center'   => ['x' => 69.4, 'y' => 58],
        'bbq-plaza'      => ['x' => 54.4, 'y' => 67],
        'observatory'    => ['x' => 79.2, 'y' => 24],
        'history-museum' => ['x' => 47.4, 'y' => 31],
    ];
}

function yoshino_map_spot_default_image($slug) {
    $key = 'facility-' . $slug;
    $images = yoshino_theme_images();
    if (isset($images[$key])) {
        return $images[$key];
    }
    return yoshino_img('default');
}

function yoshino_map_spot_pin_coords($post_id, $slug, $x, $y) {
    $layout = yoshino_map_pin_layout();
    if (isset($layout[$slug])) {
        return $layout[$slug];
    }
    return ['x' => (float) $x, 'y' => (float) $y];
}

/**
 * マップ施設の初期データ
 */
function yoshino_map_spot_defaults() {
    return [
        [
            'slug'    => 'tenji-kan',
            'title'   => '展示館（常設・企画）',
            'excerpt' => '地元作家による伝統工芸品から現代アートまで幅広く展示しています。',
            'content' => '季節ごとの企画展も開催。工芸の歴史と美しさをじっくり鑑賞できます。',
            'color'   => 'purple',
            'icon'    => 'image',
            'image'   => 'https://placehold.jp/24/6a5acd/ffffff/800x500.png?text=%E5%B1%95%E7%A4%BA%E9%A4%A8',
        ],
        [
            'slug'    => 'taiken-kobo',
            'title'   => '体験工房',
            'excerpt' => '紙漉きや木工など、職人の指導を受けながら自分だけの作品を作れます。',
            'content' => '各種ワークショップを開催。ご家族やグループでのご参加も歓迎です。',
            'color'   => 'teal',
            'icon'    => 'palette',
            'image'   => 'https://placehold.jp/24/4682b4/ffffff/800x500.png?text=%E4%BD%93%E9%A8%93%E5%B7%A5%E6%88%BF',
        ],
        [
            'slug'    => 'dining',
            'title'   => 'お食事処 御前橘',
            'excerpt' => '地元の食材を活かした料理と、四季の景色を楽しめます。',
            'content' => 'ランチセットや季節限定メニューをご用意。工芸の里散策の合間にお立ち寄りください。',
            'color'   => 'brown',
            'icon'    => 'cup-hot',
            'image'   => 'https://placehold.jp/24/8b4513/ffffff/800x500.png?text=%E3%81%8A%E9%A3%9F%E4%BA%8B%E5%87%A6',
        ],
        [
            'slug'    => 'sculpture-park',
            'title'   => '彫刻広場・公園',
            'excerpt' => '広大な芝生に点在する彫刻を眺めながら散策が楽しめます。',
            'content' => '自然と調和した屋外ギャラリー。ベンチや休憩所も整備されています。',
            'color'   => 'sky',
            'icon'    => 'brightness-high',
            'image'   => 'https://placehold.jp/24/5f9ea0/ffffff/800x500.png?text=%E5%BD%AB%E5%88%BB%E5%BA%83%E5%A0%B4',
        ],
        [
            'slug'    => 'shop',
            'title'   => '工芸品販売所',
            'excerpt' => 'ここでしか手に入らない一点物の工芸品を多数取り揃えています。',
            'content' => '作家の作品やお土産品を豊富にラインナップ。ギフトにも最適です。',
            'color'   => 'blue',
            'icon'    => 'bag',
            'image'   => 'https://placehold.jp/24/4169e1/ffffff/800x500.png?text=%E8%B2%A9%E5%A3%B2%E6%89%80',
        ],
        [
            'slug'    => 'washi-taiken',
            'title'   => '和紙漉き体験棟',
            'excerpt' => '伝統的な加賀の手漉き和紙作りを体験できる施設です。',
            'content' => '職人の指導のもと、世界に一つだけの和紙づくりに挑戦できます。初心者の方も安心してご参加いただけます。',
            'color'   => 'coral',
            'icon'    => 'brush',
            'image'   => 'https://placehold.jp/24/8b4513/ffffff/800x500.png?text=%E5%92%8C%E7%B4%99%E4%BD%93%E9%A8%93',
        ],
        [
            'slug'    => 'mokko-center',
            'title'   => '木工センター',
            'excerpt' => '本格的な機械を備え、木材加工を学べます。',
            'content' => '木工体験や見学ツアーも実施。木の温もりを感じる空間です。',
            'color'   => 'gold',
            'icon'    => 'hammer',
            'image'   => 'https://placehold.jp/24/b8860b/ffffff/800x500.png?text=%E6%9C%A8%E5%B7%A5',
        ],
        [
            'slug'    => 'bbq-plaza',
            'title'   => 'バーベキュー広場',
            'excerpt' => '家族やグループで楽しめる屋外調理スペースです。',
            'content' => '予約制で炉端・テーブルをご利用いただけます。季節のイベントも開催します。',
            'color'   => 'orange',
            'icon'    => 'fire',
            'image'   => 'https://placehold.jp/24/e67e22/ffffff/800x500.png?text=BBQ',
        ],
        [
            'slug'    => 'observatory',
            'title'   => '展望デッキ',
            'excerpt' => '白山連峰のパノラマビューを楽しめる絶景スポット。',
            'content' => '施設内の高台から里全体を見渡せます。写真撮影にも人気です。',
            'color'   => 'stone',
            'icon'    => 'binoculars',
            'image'   => 'https://placehold.jp/24/696969/ffffff/800x500.png?text=%E5%B1%95%E6%9C%9B',
        ],
        [
            'slug'    => 'history-museum',
            'title'   => '歴史資料館',
            'excerpt' => 'この地域の工芸が歩んできた歴史と文化を知ることができます。',
            'content' => '貴重な資料や道具の展示を通じて、工芸の里の成り立ちを学べます。',
            'color'   => 'wine',
            'icon'    => 'book',
            'image'   => 'https://placehold.jp/24/7d4e6d/ffffff/800x500.png?text=%E6%AD%B4%E5%8F%B2',
        ],
    ];
}

/**
 * 施設データの登録・同期（トップの Facility とマップで共通）
 */
function yoshino_ensure_map_spots() {
    if (get_option('yoshino_facilities_unified_v1')) {
        return;
    }

    $layout = yoshino_map_pin_layout();
    foreach (yoshino_map_spot_defaults() as $order => $spot) {
        $coords = $layout[$spot['slug']] ?? ['x' => 50, 'y' => 50];
        $exists = get_posts([
            'name'        => $spot['slug'],
            'post_type'   => 'map_spot',
            'post_status' => 'any',
            'numberposts' => 1,
        ]);

        if ($exists) {
            $post_id = $exists[0]->ID;
            wp_update_post([
                'ID'           => $post_id,
                'menu_order'   => $order,
                'post_excerpt' => $spot['excerpt'],
            ]);
        } else {
            $post_id = wp_insert_post([
                'post_title'   => $spot['title'],
                'post_name'    => $spot['slug'],
                'post_excerpt' => $spot['excerpt'],
                'post_content' => $spot['content'],
                'post_status'  => 'publish',
                'post_type'    => 'map_spot',
                'menu_order'   => $order,
            ]);
        }

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, 'map_x', (string) $coords['x']);
            update_post_meta($post_id, 'map_y', (string) $coords['y']);
            update_post_meta($post_id, 'map_color', $spot['color']);
            update_post_meta($post_id, 'map_icon', $spot['icon']);
        }
    }

    update_option('yoshino_map_spots_seeded', 1);
    update_option('yoshino_facilities_unified_v1', 1);
}
add_action('init', 'yoshino_ensure_map_spots', 15);

/**
 * マップページのURL
 */
function yoshino_maybe_create_map_page() {
    if (!is_admin() || !current_user_can('edit_pages')) {
        return;
    }
    if (get_option('yoshino_map_page_ready')) {
        return;
    }

    if (!get_page_by_path('map')) {
        $page_id = wp_insert_post([
            'post_title'  => '全体マップ',
            'post_name'   => 'map',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_content'=> '',
        ]);
        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-map.php');
        }
    }

    update_option('yoshino_map_page_ready', 1);
}
add_action('admin_init', 'yoshino_maybe_create_map_page');

function yoshino_is_map_page() {
    return is_page('map') || is_page_template('page-map.php') || yoshino_current_request_slug() === 'map';
}

function yoshino_map_page_url() {
    $page = get_page_by_path('map');
    if ($page && $page->post_status === 'publish') {
        $url = get_permalink($page);
        if ($url) {
            return $url;
        }
    }
    return trailingslashit(home_url('/map'));
}

/**
 * 施設一覧（トップの Facility・全体マップ・詳細ページで共通）
 */
function yoshino_get_facilities() {
    return yoshino_get_map_spots();
}

/**
 * マップに表示する施設データを取得
 */
function yoshino_get_map_spots() {
    $query = new WP_Query([
        'post_type'      => 'map_spot',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ]);

    $spots = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id   = get_the_ID();
            $slug = get_post_field('post_name', $id);
            $raw_x = yoshino_map_meta($id, 'map_x');
            $raw_y = yoshino_map_meta($id, 'map_y');
            $coords = yoshino_map_spot_pin_coords($id, $slug, $raw_x ?: 50, $raw_y ?: 50);
            $spots[] = [
                'id'      => $id,
                'slug'    => $slug,
                'title'   => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'url'     => get_permalink(),
                'image'   => get_the_post_thumbnail_url($id, 'medium_large')
                    ?: yoshino_map_spot_default_image($slug)
                    ?: '',
                'x'       => $coords['x'],
                'y'       => $coords['y'],
                'color'   => yoshino_map_meta($id, 'map_color') ?: 'coral',
                'icon'    => yoshino_map_meta($id, 'map_icon') ?: 'geo-alt',
            ];
        }
        wp_reset_postdata();
        return $spots;
    }

    foreach (yoshino_map_spot_defaults() as $spot) {
        $layout = yoshino_map_pin_layout();
        $coords = $layout[$spot['slug']] ?? ['x' => 50, 'y' => 50];
        $spots[] = [
            'id'      => $spot['slug'],
            'slug'    => $spot['slug'],
            'title'   => $spot['title'],
            'excerpt' => $spot['excerpt'],
            'url'     => '#',
            'image'   => $spot['image'],
            'x'       => $coords['x'],
            'y'       => $coords['y'],
            'color'   => $spot['color'],
            'icon'    => $spot['icon'],
        ];
    }
    return $spots;
}

/**
 * 「吉野工芸の里について」ページ用リライト
 */
function yoshino_register_about_rewrite() {
    add_rewrite_rule('^about/?$', 'index.php?pagename=about', 'top');
}

/**
 * 「吉野工芸の里について」ページ
 */
function yoshino_about_page_url() {
    $page = get_page_by_path('about');
    if ($page && $page->post_status === 'publish') {
        $url = get_permalink($page);
        if ($url) {
            return $url;
        }
    }
    return trailingslashit(home_url('/about'));
}

function yoshino_maybe_create_about_page() {
    if (!is_admin() || !current_user_can('edit_pages')) {
        return;
    }
    if (get_option('yoshino_about_page_ready')) {
        return;
    }

    if (!get_page_by_path('about')) {
        $page_id = wp_insert_post([
            'post_title'  => '吉野工芸の里について',
            'post_name'   => 'about',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_content'=> '',
        ]);
        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-about.php');
        }
    }

    update_option('yoshino_about_page_ready', 1);
}
add_action('admin_init', 'yoshino_maybe_create_about_page');

/**
 * ご利用の案内ページ
 */
function yoshino_guide_page_url() {
    $page = get_page_by_path('guide');
    if ($page && $page->post_status === 'publish') {
        $url = get_permalink($page);
        if ($url) {
            return $url;
        }
    }
    return trailingslashit(home_url('/guide'));
}

function yoshino_register_guide_rewrite() {
    add_rewrite_rule('^guide/?$', 'index.php?pagename=guide', 'top');
}

function yoshino_maybe_create_guide_page() {
    if (!is_admin() || !current_user_can('edit_pages')) {
        return;
    }
    if (get_option('yoshino_guide_page_ready')) {
        return;
    }

    $page = get_page_by_path('guide');
    if ($page) {
        update_post_meta($page->ID, '_wp_page_template', 'page-guide.php');
    } else {
        $page_id = wp_insert_post([
            'post_title'  => 'ご利用の案内',
            'post_name'   => 'guide',
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_content'=> '',
        ]);
        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-guide.php');
        }
    }

    update_option('yoshino_guide_page_ready', 1);
}
add_action('admin_init', 'yoshino_maybe_create_guide_page');

function yoshino_ensure_guide_template() {
    if (get_option('yoshino_guide_template_set')) {
        return;
    }
    $page = get_page_by_path('guide');
    if ($page) {
        update_post_meta($page->ID, '_wp_page_template', 'page-guide.php');
    }
    update_option('yoshino_guide_template_set', 1);
}
add_action('init', 'yoshino_ensure_guide_template', 15);