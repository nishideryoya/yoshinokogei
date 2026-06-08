<?php
/**
 * ACF フィールドグループ定義（コード管理）
 * 管理画面で編集後は acf-json/ に自動保存されます
 */

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group([
    'key'    => 'group_yoshino_options',
    'title'  => 'サイト共通設定',
    'fields' => [
        ['key' => 'field_yo_site_name', 'label' => 'サイト名', 'name' => 'site_name', 'type' => 'text', 'default_value' => '吉野工芸の里'],
        ['key' => 'field_yo_header_hours', 'label' => 'ヘッダー下バー（開館案内）', 'name' => 'header_hours', 'type' => 'text', 'default_value' => '年中無休（火曜休館） | 10:00〜17:00'],
        ['key' => 'field_yo_contact_phone', 'label' => '電話番号', 'name' => 'contact_phone', 'type' => 'text', 'default_value' => '076-255-5319'],
        ['key' => 'field_yo_contact_fax', 'label' => 'FAX', 'name' => 'contact_fax', 'type' => 'text', 'default_value' => '076-255-5360'],
        ['key' => 'field_yo_contact_email', 'label' => 'メール', 'name' => 'contact_email', 'type' => 'email', 'default_value' => 'kougei@asagaotv.ne.jp'],
        ['key' => 'field_yo_contact_address', 'label' => '住所', 'name' => 'contact_address', 'type' => 'textarea', 'rows' => 2, 'default_value' => '〒920-2321 石川県白山市吉野春29番地'],
        ['key' => 'field_yo_official_url', 'label' => '公式サイトURL', 'name' => 'official_url', 'type' => 'url', 'default_value' => 'http://www.kougeinosato.or.jp'],
        ['key' => 'field_yo_instagram_url', 'label' => 'Instagram URL', 'name' => 'instagram_url', 'type' => 'url'],
        ['key' => 'field_yo_footer_text', 'label' => 'フッター文言', 'name' => 'footer_text', 'type' => 'text', 'default_value' => '吉野工芸の里 All Rights Reserved.'],
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'yoshino-site-settings']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_front',
    'title'  => 'トップページ',
    'fields' => [
        ['key' => 'field_yf_hero_image', 'label' => 'メインビジュアル画像', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_yf_hero_cta_sub', 'label' => '予約ボタン（上段）', 'name' => 'hero_cta_sub', 'type' => 'text', 'default_value' => 'ネットで予約がスムーズ！'],
        ['key' => 'field_yf_hero_cta_label', 'label' => '予約ボタン（メイン）', 'name' => 'hero_cta_label', 'type' => 'text', 'default_value' => '体験教室の申し込みはこちら'],
        ['key' => 'field_yf_hero_cta_url', 'label' => '予約ボタンURL', 'name' => 'hero_cta_url', 'type' => 'url', 'instructions' => '空欄の場合は体験教室の予約セクションへ'],
        ['key' => 'field_yf_news_count', 'label' => 'News表示件数', 'name' => 'news_count', 'type' => 'number', 'default_value' => 3, 'min' => 1, 'max' => 12],
        ['key' => 'field_yf_about_image', 'label' => 'Aboutセクション画像', 'name' => 'about_image', 'type' => 'image', 'return_format' => 'array'],
        ['key' => 'field_yf_about_label', 'label' => 'Aboutラベル', 'name' => 'about_label', 'type' => 'text', 'default_value' => '施設案内'],
        ['key' => 'field_yf_about_title', 'label' => 'About見出し', 'name' => 'about_title', 'type' => 'text', 'default_value' => '吉野工芸の里について'],
        ['key' => 'field_yf_about_subtitle', 'label' => 'About英字', 'name' => 'about_subtitle', 'type' => 'text', 'default_value' => 'About us'],
        ['key' => 'field_yf_about_text', 'label' => 'About本文', 'name' => 'about_text', 'type' => 'textarea', 'rows' => 4, 'default_value' => '白山の豊かな自然に囲まれた「吉野工芸の里」は、伝統工芸の継承と新たな創造の場です。展示館での鑑賞、職人の技を体験できるワークショップ、広大な公園での散策など、五感で工芸に触れるひとときをお過ごしいただけます。'],
        ['key' => 'field_yf_facility_title', 'label' => '施設情報見出し', 'name' => 'facility_title', 'type' => 'text', 'default_value' => '施設情報'],
        ['key' => 'field_yf_facility_subtitle', 'label' => '施設情報英字', 'name' => 'facility_subtitle', 'type' => 'text', 'default_value' => 'Facility'],
        ['key' => 'field_yf_instagram_title', 'label' => 'Instagram見出し', 'name' => 'instagram_title', 'type' => 'text', 'default_value' => 'Instagram'],
        ['key' => 'field_yf_instagram_gallery', 'label' => 'Instagram画像（6枚推奨）', 'name' => 'instagram_gallery', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_yf_instagram_link', 'label' => 'Instagramリンク', 'name' => 'instagram_link', 'type' => 'url'],
    ],
    'location' => [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_guide',
    'title'  => 'ご利用の案内ページ',
    'fields' => [
        ['key' => 'field_yg_hero_image', 'label' => 'ヒーロー画像', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array'],
        ['key' => 'field_yg_hero_subtitle', 'label' => 'ヒーロー英字', 'name' => 'hero_subtitle', 'type' => 'text', 'default_value' => 'Guide'],
        ['key' => 'field_yg_hours_open', 'label' => '開館時間', 'name' => 'hours_open', 'type' => 'text', 'default_value' => '10:00 〜 17:00'],
        ['key' => 'field_yg_hours_phone', 'label' => '電話受付', 'name' => 'hours_phone', 'type' => 'text', 'default_value' => '10:00 〜 17:00（休館日を除く）'],
        ['key' => 'field_yg_hours_closed', 'label' => '休館日', 'name' => 'hours_closed', 'type' => 'textarea', 'rows' => 3, 'default_value' => "毎週火曜日（祝日の場合は開館し、翌日が休館日）\n12月29日 〜 1月3日"],
        [
            'key' => 'field_yg_fee_items', 'label' => '料金表', 'name' => 'fee_items', 'type' => 'repeater', 'layout' => 'table', 'button_label' => '行を追加',
            'sub_fields' => [
                ['key' => 'field_yg_fee_label', 'label' => '項目', 'name' => 'label', 'type' => 'text'],
                ['key' => 'field_yg_fee_sublabel', 'label' => '補足', 'name' => 'sublabel', 'type' => 'text'],
                ['key' => 'field_yg_fee_value', 'label' => '内容', 'name' => 'value', 'type' => 'text'],
            ],
        ],
        ['key' => 'field_yg_fee_note', 'label' => '料金の注記', 'name' => 'fee_note', 'type' => 'textarea', 'rows' => 2],
        [
            'key' => 'field_yg_price_table', 'label' => '体験教室料金目安', 'name' => 'price_table', 'type' => 'repeater', 'layout' => 'table', 'button_label' => '行を追加',
            'sub_fields' => [
                ['key' => 'field_yg_price_menu', 'label' => 'メニュー', 'name' => 'menu', 'type' => 'text'],
                ['key' => 'field_yg_price_amount', 'label' => '料金目安', 'name' => 'price', 'type' => 'text'],
                ['key' => 'field_yg_price_duration', 'label' => '所要時間', 'name' => 'duration', 'type' => 'text'],
            ],
        ],
        ['key' => 'field_yg_parking_title', 'label' => '駐車場タイトル', 'name' => 'parking_title', 'type' => 'text', 'default_value' => '無料駐車場'],
        ['key' => 'field_yg_parking_text', 'label' => '駐車場説明', 'name' => 'parking_text', 'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_yg_map_embed', 'label' => 'Googleマップ埋め込みURL', 'name' => 'map_embed', 'type' => 'url'],
        ['key' => 'field_yg_access_car', 'label' => 'お車でお越しの方', 'name' => 'access_car', 'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_yg_access_transit', 'label' => '公共交通機関', 'name' => 'access_transit', 'type' => 'textarea', 'rows' => 4],
        [
            'key' => 'field_yg_guide_items', 'label' => '園内のご案内', 'name' => 'guide_items', 'type' => 'repeater', 'layout' => 'row', 'button_label' => '項目を追加',
            'sub_fields' => [
                ['key' => 'field_yg_guide_title', 'label' => 'タイトル', 'name' => 'title', 'type' => 'text'],
                ['key' => 'field_yg_guide_body', 'label' => '内容', 'name' => 'body', 'type' => 'textarea', 'rows' => 3],
            ],
        ],
        [
            'key' => 'field_yg_visitor_notes', 'label' => 'お客様へのご注意', 'name' => 'visitor_notes', 'type' => 'repeater', 'layout' => 'table', 'button_label' => '行を追加',
            'sub_fields' => [
                ['key' => 'field_yg_note_text', 'label' => '内容', 'name' => 'text', 'type' => 'text'],
            ],
        ],
    ],
    'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'page-guide.php']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_taiken_page',
    'title'  => '体験教室ページ',
    'fields' => [
        ['key' => 'field_yt_hero_image', 'label' => 'ヒーロー画像', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array'],
        ['key' => 'field_yt_intro', 'label' => 'リード文', 'name' => 'section_intro', 'type' => 'textarea', 'rows' => 2, 'default_value' => '職人の指導のもと、伝統工芸の技に触れる体験プログラムです。'],
        ['key' => 'field_yt_cta_sub', 'label' => '予約ボタン（上段）', 'name' => 'cta_sub', 'type' => 'text', 'default_value' => 'ネットで予約がスムーズ！'],
        ['key' => 'field_yt_cta_label', 'label' => '予約ボタン', 'name' => 'cta_label', 'type' => 'text', 'default_value' => '体験教室の申し込みはこちら'],
        ['key' => 'field_yt_reserve_title', 'label' => '予約セクション見出し', 'name' => 'reserve_title', 'type' => 'text', 'default_value' => '体験教室のご予約'],
        ['key' => 'field_yt_reserve_lead', 'label' => '予約セクションリード', 'name' => 'reserve_lead', 'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_yt_reserve_phone_hours', 'label' => '電話受付時間', 'name' => 'reserve_phone_hours', 'type' => 'text', 'default_value' => '10:00〜17:00（火曜休）'],
        ['key' => 'field_yt_reserve_web_url', 'label' => 'Web予約URL', 'name' => 'reserve_web_url', 'type' => 'url'],
        [
            'key' => 'field_yt_reserve_notes', 'label' => '予約の注意事項', 'name' => 'reserve_notes', 'type' => 'repeater', 'layout' => 'table', 'button_label' => '行を追加',
            'sub_fields' => [
                ['key' => 'field_yt_reserve_note', 'label' => '内容', 'name' => 'text', 'type' => 'text'],
            ],
        ],
    ],
    'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'page-taiken.php']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_about',
    'title'  => '吉野工芸の里について',
    'fields' => [
        ['key' => 'field_ya_hero_image', 'label' => 'ヒーロー画像', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array'],
        ['key' => 'field_ya_hero_subtitle', 'label' => 'ヒーロー英字', 'name' => 'hero_subtitle', 'type' => 'text', 'default_value' => 'About Yoshino Kougei no Sato'],
        ['key' => 'field_ya_lead', 'label' => 'リード文', 'name' => 'lead', 'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_ya_greeting_image', 'label' => 'ごあいさつ画像', 'name' => 'greeting_image', 'type' => 'image', 'return_format' => 'array'],
        ['key' => 'field_ya_greeting_text', 'label' => 'ごあいさつ', 'name' => 'greeting_text', 'type' => 'textarea', 'rows' => 6],
        [
            'key' => 'field_ya_highlights', 'label' => '3つの魅力', 'name' => 'highlights', 'type' => 'repeater', 'layout' => 'row', 'max' => 3, 'button_label' => '魅力を追加',
            'sub_fields' => [
                ['key' => 'field_ya_hl_image', 'label' => '画像', 'name' => 'image', 'type' => 'image', 'return_format' => 'array'],
                ['key' => 'field_ya_hl_title', 'label' => 'タイトル', 'name' => 'title', 'type' => 'text'],
                ['key' => 'field_ya_hl_text', 'label' => '説明', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
            ],
        ],
        ['key' => 'field_ya_facilities_intro', 'label' => '園内施設イントロ', 'name' => 'facilities_intro', 'type' => 'textarea', 'rows' => 4],
        [
            'key' => 'field_ya_facilities', 'label' => '園内施設リスト', 'name' => 'facilities', 'type' => 'repeater', 'layout' => 'row', 'button_label' => '施設を追加',
            'sub_fields' => [
                ['key' => 'field_ya_fac_icon', 'label' => 'アイコン（Bootstrap Icons）', 'name' => 'icon', 'type' => 'text', 'placeholder' => 'tree'],
                ['key' => 'field_ya_fac_title', 'label' => '名称', 'name' => 'title', 'type' => 'text'],
                ['key' => 'field_ya_fac_text', 'label' => '説明', 'name' => 'text', 'type' => 'textarea', 'rows' => 2],
            ],
        ],
        ['key' => 'field_ya_experience_text', 'label' => '体験教室について', 'name' => 'experience_text', 'type' => 'textarea', 'rows' => 3],
        [
            'key' => 'field_ya_basic_info', 'label' => '基本情報', 'name' => 'basic_info', 'type' => 'repeater', 'layout' => 'table', 'button_label' => '行を追加',
            'sub_fields' => [
                ['key' => 'field_ya_info_label', 'label' => '項目', 'name' => 'label', 'type' => 'text'],
                ['key' => 'field_ya_info_value', 'label' => '内容', 'name' => 'value', 'type' => 'textarea', 'rows' => 2],
            ],
        ],
        ['key' => 'field_ya_map_embed', 'label' => 'Googleマップ埋め込みURL', 'name' => 'map_embed', 'type' => 'url'],
        ['key' => 'field_ya_access_car', 'label' => 'お車でお越しの方', 'name' => 'access_car', 'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_ya_access_transit', 'label' => '公共交通機関', 'name' => 'access_transit', 'type' => 'textarea', 'rows' => 4],
    ],
    'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_map_page',
    'title'  => '全体マップページ',
    'fields' => [
        ['key' => 'field_ym_hero_image', 'label' => 'ヒーロー画像', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array'],
        ['key' => 'field_ym_intro_catch', 'label' => 'キャッチコピー', 'name' => 'intro_catch', 'type' => 'text', 'default_value' => '見て、ふれて、創る。'],
        ['key' => 'field_ym_intro_lead', 'label' => 'リード文', 'name' => 'intro_lead', 'type' => 'textarea', 'rows' => 3],
    ],
    'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'page-map.php']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_taiken_cpt',
    'title'  => '体験教室の詳細',
    'fields' => [
        ['key' => 'field_tc_price', 'label' => '料金', 'name' => 'taiken_price', 'type' => 'text', 'placeholder' => '例：1,500円（材料費込）'],
        ['key' => 'field_tc_duration', 'label' => '所要時間', 'name' => 'taiken_duration', 'type' => 'text', 'placeholder' => '例：約60分'],
        ['key' => 'field_tc_capacity', 'label' => '定員', 'name' => 'taiken_capacity', 'type' => 'text', 'placeholder' => '例：各回10名'],
        ['key' => 'field_tc_target', 'label' => '対象', 'name' => 'taiken_target', 'type' => 'text', 'placeholder' => '例：小学生以上'],
        ['key' => 'field_tc_location', 'label' => '場所', 'name' => 'taiken_location', 'type' => 'text', 'placeholder' => '例：和紙漉き体験棟'],
    ],
    'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'taiken']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_map_spot_cpt',
    'title'  => 'マップ上の位置',
    'fields' => [
        ['key' => 'field_ms_x', 'label' => '横位置（%）', 'name' => 'map_x', 'type' => 'number', 'min' => 0, 'max' => 100, 'step' => 0.1],
        ['key' => 'field_ms_y', 'label' => '縦位置（%）', 'name' => 'map_y', 'type' => 'number', 'min' => 0, 'max' => 100, 'step' => 0.1],
        [
            'key' => 'field_ms_color', 'label' => 'アイコン色', 'name' => 'map_color', 'type' => 'select',
            'choices' => [
                'coral' => 'コーラル', 'purple' => 'パープル', 'teal' => 'ティール', 'brown' => 'ブラウン',
                'blue' => 'ブルー', 'gold' => 'ゴールド', 'sky' => 'スカイ', 'stone' => 'ストーン',
                'orange' => 'オレンジ', 'wine' => 'ワイン',
            ],
            'default_value' => 'coral',
        ],
        ['key' => 'field_ms_icon', 'label' => 'アイコン（Bootstrap Icons）', 'name' => 'map_icon', 'type' => 'text', 'placeholder' => 'palette', 'default_value' => 'geo-alt'],
    ],
    'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'map_spot']]],
]);

acf_add_local_field_group([
    'key'    => 'group_yoshino_sakka_cpt',
    'title'  => '作家プロフィール',
    'fields' => [
        ['key' => 'field_sk_genre', 'label' => '工芸ジャンル', 'name' => 'sakka_genre', 'type' => 'text', 'placeholder' => '例：陶芸'],
        ['key' => 'field_sk_history', 'label' => '経歴・プロフィール', 'name' => 'sakka_history', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0],
        ['key' => 'field_sk_instagram', 'label' => 'Instagram URL', 'name' => 'sakka_instagram', 'type' => 'url'],
        ['key' => 'field_sk_website', 'label' => '公式サイト URL', 'name' => 'sakka_website', 'type' => 'url'],
        ['key' => 'field_sk_work1', 'label' => '作品画像1', 'name' => 'work_img_01', 'type' => 'image', 'return_format' => 'url'],
        ['key' => 'field_sk_work2', 'label' => '作品画像2', 'name' => 'work_img_02', 'type' => 'image', 'return_format' => 'url'],
        ['key' => 'field_sk_work3', 'label' => '作品画像3', 'name' => 'work_img_03', 'type' => 'image', 'return_format' => 'url'],
    ],
    'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'sakka']]],
]);
