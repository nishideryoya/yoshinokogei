<?php
/**
 * Template Name: 吉野工芸の里について
 */
get_header();

$page_id    = yoshino_get_page_id('about');
$page_title = yoshino_get_page_title('about', '吉野工芸の里について');
$map_url    = yoshino_map_page_url();
$taiken_url = yoshino_taiken_page_url();
$guide_url  = yoshino_guide_page_url();
$phone      = yoshino_opt('contact_phone', '076-255-5319');
$official   = yoshino_opt('official_url', 'http://www.kougeinosato.or.jp');
$map_embed  = yoshino_field('map_embed', $page_id, 'https://www.google.com/maps?q=%E5%90%89%E9%87%8E%E5%B7%A5%E8%8A%B8%E3%81%AE%E9%87%8C+%E7%9F%B3%E5%B7%9D%E7%9C%8C%E7%99%BD%E5%B1%B1%E5%B8%82&hl=ja&z=15&output=embed');

$highlights = yoshino_repeater_or_default(yoshino_field('highlights', $page_id), [
    ['title' => '白山の自然', 'text' => '樹齢660余年を誇る国指定天然記念物「御仏供（おぼけ）杉」をはじめ、芝生の広場や散策路で四季の山あいの風景をお楽しみいただけます。', 'image' => ''],
    ['title' => '匠の技に触れる', 'text' => 'ろくろ陶芸、和紙漉き、ランプシェードづくり、押し花アートなど、作家の指導のもとで体験できる教室を開催しています（要予約）。', 'image' => ''],
    ['title' => '歴史と文化の継承', 'text' => '江戸中期の民家を移築した文化交流サロン「鶉荘（うずらそう）」では、工芸と自然のなかで、創造と交流の場を提供しています。', 'image' => ''],
]);

$facilities = yoshino_repeater_or_default(yoshino_field('facilities', $page_id), [
    ['icon' => 'brightness-high', 'title' => 'パフォーマンス広場', 'text' => '野外ギャラリー。芝生の広場で作品と自然を一体としてお楽しみください。'],
    ['icon' => 'tree', 'title' => '御仏供杉（おぼけすぎ）', 'text' => '国指定天然記念物。樹齢660余年の巨木は、園内散策のハイライトです。'],
    ['icon' => 'shop', 'title' => 'ふるさと工房', 'text' => '作家の工房・教室・ギャラリー。常設展示と工芸品の販売を行っています。'],
    ['icon' => 'house', 'title' => '文化交流サロン 鶉荘（うずらそう）', 'text' => '富山県利賀村の江戸中期の民家を移築。文化情報の収集・発信の拠点です。'],
    ['icon' => 'brush', 'title' => 'アート＆クラフト交流館', 'text' => '作家との交流会や体験教室の会場。ご予約・お問い合わせは事務局まで。'],
]);

$basic_info = yoshino_repeater_or_default(yoshino_field('basic_info', $page_id), [
    ['label' => '施設名', 'value' => '吉野工芸の里（ヨシノコウゲイノサト）'],
    ['label' => '所在地', 'value' => yoshino_opt('contact_address', '〒920-2321 石川県白山市吉野春29番地')],
    ['label' => '電話', 'value' => $phone . '（10:00〜17:00）'],
    ['label' => 'FAX', 'value' => yoshino_opt('contact_fax', '076-255-5360')],
    ['label' => '開館時間', 'value' => '10:00〜17:00'],
    ['label' => '休館日', 'value' => "毎週火曜日（祝日の場合は翌日）\n12月29日〜1月3日"],
    ['label' => '駐車場', 'value' => '約40台（無料）'],
    ['label' => '公式サイト', 'value' => $official],
]);

$hl_images = ['about-nature', 'about-craft', 'about-salon'];
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'     => $page_title,
    'subtitle'  => yoshino_field('hero_subtitle', $page_id, 'About Yoshino Kougei no Sato'),
    'image_key' => 'hero-about',
    'post_id'   => $page_id,
]); ?>

<main class="py-5">
    <div class="container" style="max-width: 900px;">

        <section class="mb-5">
            <p class="lead text-secondary lh-lg">
                <?php echo nl2br(esc_html(yoshino_field('lead', $page_id, '白山麓の豊かな自然に抱かれた「吉野工芸の里」は、石川県白山市吉野に広がる、工芸と文化の体験型施設です。陶芸・ガラス・和紙・木工など、さまざまな分野の作家が集い、作品の展示・販売はもちろん、制作体験を通じて「ものづくり」のよろこびに触れていただけます。'))); ?>
            </p>
        </section>

        <section class="mb-5">
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm bg-light">
                        <img src="<?php echo esc_url(yoshino_image_url(yoshino_field('greeting_image', $page_id), yoshino_img('about-nature'))); ?>" class="object-fit-cover" alt="白山麓の風景">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="h4 fw-bold heading-accent">ごあいさつ</h2>
                    <p class="text-secondary lh-lg small mb-0">
                        <?php echo nl2br(esc_html(yoshino_field('greeting_text', $page_id, '当施設は、昭和60年（1985年）に旧吉野谷村が地域振興を目的として設立し、国の補助を得て芸術文化の振興に取り組んできました。現在は運営母体が「白山吉野地域振興協議会」へ移行し、これまでと変わらぬ志のもと、地域に根ざした文化づくりを続けています。'))); ?>
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-5 py-4 px-4 bg-light rounded">
            <h2 class="h4 fw-bold heading-accent mb-4">3つの魅力</h2>
            <div class="row g-4">
                <?php foreach ($highlights as $i => $hl) :
                    $img = yoshino_image_url($hl['image'] ?? '', yoshino_img($hl_images[$i] ?? 'about-nature'));
                ?>
                <div class="col-md-4">
                    <div class="text-center px-2">
                        <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm mb-3">
                            <img src="<?php echo esc_url($img); ?>" class="object-fit-cover" alt="<?php echo esc_attr($hl['title'] ?? ''); ?>">
                        </div>
                        <h3 class="h6 fw-bold"><?php echo esc_html($hl['title'] ?? ''); ?></h3>
                        <p class="small text-secondary mb-0"><?php echo esc_html($hl['text'] ?? ''); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="h4 fw-bold heading-accent mb-4">園内の主な施設</h2>
            <p class="text-secondary small mb-4">
                <?php echo nl2br(esc_html(yoshino_field('facilities_intro', $page_id, '野外ギャラリー「パフォーマンス広場」では多数の作家作品が展示され、「ふるさと工房」では美術工芸品の展示・販売（2階展示室は無料で鑑賞可能）を行っています。'))); ?>
            </p>
            <ul class="list-group list-group-flush border rounded shadow-sm">
                <?php foreach ($facilities as $fac) : ?>
                <li class="list-group-item d-flex gap-3 align-items-start py-3">
                    <i class="bi bi-<?php echo esc_attr($fac['icon'] ?? 'geo-alt'); ?> text-primary fs-5"></i>
                    <div>
                        <strong><?php echo esc_html($fac['title'] ?? ''); ?></strong>
                        <p class="small text-secondary mb-0"><?php echo esc_html($fac['text'] ?? ''); ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="text-center mt-4">
                <a href="<?php echo esc_url($map_url); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                    <i class="bi bi-map me-2"></i>全体マップで施設を見る
                </a>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="h4 fw-bold heading-accent mb-3">体験教室について</h2>
            <p class="text-secondary lh-lg">
                <?php echo nl2br(esc_html(yoshino_field('experience_text', $page_id, '陶芸（ろくろ体験）、和紙を使ったランプシェードづくり、押し花アートなど、個人・少人数グループ・学校単位での参加が可能です。事前予約を優先しておりますので、お早めにお申し込みください。'))); ?>
            </p>
            <a href="<?php echo esc_url($taiken_url); ?>" class="btn btn-success rounded-pill px-4 fw-bold">
                体験教室の一覧・予約
            </a>
        </section>

        <section class="mb-5">
            <h2 class="h4 fw-bold heading-accent mb-4">基本情報</h2>
            <table class="table table-bordered bg-white shadow-sm mb-0">
                <tbody>
                    <?php foreach ($basic_info as $row) : ?>
                    <tr>
                        <th class="bg-light ps-3" style="width: 28%;"><?php echo esc_html($row['label'] ?? ''); ?></th>
                        <td class="ps-3">
                            <?php if (($row['label'] ?? '') === '公式サイト' && !empty($row['value'])) : ?>
                                <a href="<?php echo esc_url($row['value']); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                    <?php echo esc_html(parse_url($row['value'], PHP_URL_HOST) ?: $row['value']); ?> <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            <?php elseif (($row['label'] ?? '') === '電話') : ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="text-decoration-none"><?php echo esc_html($row['value'] ?? ''); ?></a>
                            <?php else : ?>
                                <?php echo nl2br(esc_html($row['value'] ?? '')); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="mb-5" id="access">
            <h2 class="h4 fw-bold heading-accent mb-4">アクセス</h2>
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                        <iframe src="<?php echo esc_url($map_embed); ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="吉野工芸の里の地図"></iframe>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h3 class="h6 fw-bold mb-2"><i class="bi bi-car-front me-2"></i>お車でお越しの方</h3>
                    <p class="small text-secondary mb-4"><?php echo nl2br(esc_html(yoshino_field('access_car', $page_id, "北陸自動車道「白山IC」より国道157号線で南へ約50分\n金沢市内より約50分 / 小松市内より約30分"))); ?></p>
                    <h3 class="h6 fw-bold mb-2"><i class="bi bi-bus-front me-2"></i>公共交通機関でお越しの方</h3>
                    <p class="small text-secondary mb-0"><?php echo nl2br(esc_html(yoshino_field('access_transit', $page_id, "北陸鉄道白山バス「上吉野経由・瀬女・白峰行き」\n「吉野工芸の里」バス停下車"))); ?></p>
                </div>
            </div>
        </section>

        <section class="text-center py-4 border-top">
            <p class="text-secondary small mb-3">ご来館の際は、開館時間・休館日をご確認ください。</p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="<?php echo esc_url($guide_url); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">ご利用の案内</a>
                <a href="<?php echo esc_url($map_url); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">全体マップ</a>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-link text-secondary">トップへ戻る</a>
            </div>
        </section>

    </div>
</main>

<?php get_footer(); ?>
