<?php
/**
 * Template Name: ご利用の案内
 */
get_header();

$page_id    = yoshino_get_page_id('guide');
$page_title = yoshino_get_page_title('guide', 'ご利用の案内');
$taiken_url = yoshino_taiken_page_url();
$about_url  = yoshino_about_page_url();
$phone      = yoshino_opt('contact_phone', '076-255-5319');
$fax        = yoshino_opt('contact_fax', '076-255-5360');
$email      = yoshino_opt('contact_email', 'kougei@asagaotv.ne.jp');
$address    = yoshino_opt('contact_address', '〒920-2321 石川県白山市吉野春29番地');
$map_embed  = yoshino_field('map_embed', $page_id, 'https://www.google.com/maps?q=%E5%90%89%E9%87%8E%E5%B7%A5%E8%8A%B8%E3%81%AE%E9%87%8C+%E7%9F%B3%E5%B7%9D%E7%9C%8C%E7%99%BD%E5%B1%B1%E5%B8%82&hl=ja&z=15&output=embed');

$fee_items = yoshino_repeater_or_default(yoshino_field('fee_items', $page_id), [
    ['label' => '園内入場', 'sublabel' => '', 'value' => '無料'],
    ['label' => 'ふるさと工房', 'sublabel' => '2階展示室', 'value' => '鑑賞無料'],
    ['label' => '体験教室', 'sublabel' => '', 'value' => 'プログラムにより異なります（例：陶芸 3,500円〜 / 和紙 800円〜 / ガラス 1,500円〜）'],
]);

$price_table = yoshino_repeater_or_default(yoshino_field('price_table', $page_id), [
    ['menu' => '陶芸教室', 'price' => '大人 3,500円 / 小人 2,500円〜', 'duration' => '30分〜2時間'],
    ['menu' => 'ろくろ陶芸体験', 'price' => '3,800円〜（焼成料別の場合あり）', 'duration' => '約90分'],
    ['menu' => '創作和紙・押し花', 'price' => '800円〜1,500円', 'duration' => '40分〜2時間'],
    ['menu' => 'ランプシェード', 'price' => '3,500円〜', 'duration' => '3時間〜'],
    ['menu' => 'ガラス体験', 'price' => '1,500円〜15,000円', 'duration' => '内容により異なる'],
    ['menu' => '木工', 'price' => '2,000円〜', 'duration' => '内容により異なる'],
]);

$guide_items = yoshino_repeater_or_default(yoshino_field('guide_items', $page_id), [
    ['title' => '白山市観光情報センター「工芸の里」', 'body' => '園内にあり、白山市の観光情報をご案内しています（平成26年4月オープン）。'],
    ['title' => 'ふるさと工房', 'body' => '1階で工芸品の販売、2階展示室では常設展示を無料でご覧いただけます。'],
    ['title' => '総合案内・体験のお申込み', 'body' => '吉野工芸の里事務局（10:00〜17:00・火曜休） TEL ' . $phone],
]);

$visitor_notes = yoshino_repeater_or_default(yoshino_field('visitor_notes', $page_id), [
    ['text' => '展示作品には手を触れないでください。'],
    ['text' => '指定以外の場所での飲食・喫煙はご遠慮ください。'],
    ['text' => '撮影は個人利用の範囲でお願いします。作家・作品の商用利用目的の撮影はご遠慮ください。'],
    ['text' => '体験教室は事前予約をおすすめします（当日の空き状況によりご案内できない場合があります）。'],
    ['text' => '自然豊かな園内です。ゴミはお持ち帰りいただくか、指定の場所へお願いします。'],
    ['text' => 'ペットとのご入園については、事前にお問い合わせください（補助犬を除く）。'],
]);
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'      => $page_title,
    'subtitle'   => yoshino_field('hero_subtitle', $page_id, 'Guide'),
    'image_key'  => 'hero-guide',
    'post_id'    => $page_id,
]); ?>

<main class="py-5">
    <div class="container">

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-light">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-4 heading-accent">開館時間・休館日</h2>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <span class="fw-bold d-block">開館時間</span>
                                <span class="text-secondary"><?php echo esc_html(yoshino_field('hours_open', $page_id, '10:00 〜 17:00')); ?></span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold d-block">電話受付</span>
                                <span class="text-secondary"><?php echo esc_html(yoshino_field('hours_phone', $page_id, '10:00 〜 17:00（休館日を除く）')); ?></span>
                            </li>
                            <li>
                                <span class="fw-bold d-block text-danger">休館日</span>
                                <span class="text-secondary"><?php echo nl2br(esc_html(yoshino_field('hours_closed', $page_id, "毎週火曜日（祝日の場合は開館し、翌日が休館日）\n12月29日 〜 1月3日"))); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm bg-light">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-4 heading-accent">料金</h2>
                        <table class="table table-borderless mb-0">
                            <?php foreach ($fee_items as $row) : ?>
                            <tr>
                                <th class="ps-0 py-2 align-top" style="width: 42%;">
                                    <?php echo esc_html($row['label'] ?? ''); ?>
                                    <?php if (!empty($row['sublabel'])) : ?>
                                        <br><span class="fw-normal small text-muted"><?php echo esc_html($row['sublabel']); ?></span>
                                    <?php endif; ?>
                                </th>
                                <td class="py-2 text-secondary"><?php echo esc_html($row['value'] ?? ''); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php if ($fee_note = yoshino_field('fee_note', $page_id, '※体験は事前予約を優先しております。最新のメニュー・料金はお電話にてご確認ください。')) : ?>
                        <p class="small text-secondary mt-3 mb-2"><?php echo esc_html($fee_note); ?></p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($taiken_url); ?>" class="btn btn-sm btn-success rounded-pill fw-bold">
                            体験教室の詳細・予約
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="mb-5">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h5 fw-bold mb-4 heading-accent">所在地・お問い合わせ</h2>
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th class="bg-light ps-3" style="width: 30%;">施設名</th>
                                <td class="ps-3"><?php echo esc_html(yoshino_opt('site_name', '吉野工芸の里')); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">住所</th>
                                <td class="ps-3"><?php echo esc_html($address); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">電話</th>
                                <td class="ps-3">
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="text-decoration-none fw-bold"><?php echo esc_html($phone); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">FAX</th>
                                <td class="ps-3"><?php echo esc_html($fax); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">メール</th>
                                <td class="ps-3">
                                    <a href="mailto:<?php echo esc_attr($email); ?>" class="text-decoration-none"><?php echo esc_html($email); ?></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-body p-4">
                    <h2 class="h5 fw-bold mb-3 heading-accent">体験教室の料金目安</h2>
                    <p class="small text-secondary mb-3">内容・所要時間・人数により変動します。下表は参考価格です。</p>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0 bg-white">
                            <thead class="table-light">
                                <tr>
                                    <th>メニュー</th>
                                    <th>料金目安</th>
                                    <th>所要時間の目安</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php foreach ($price_table as $row) : ?>
                                <tr>
                                    <td><?php echo esc_html($row['menu'] ?? ''); ?></td>
                                    <td><?php echo esc_html($row['price'] ?? ''); ?></td>
                                    <td><?php echo esc_html($row['duration'] ?? ''); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5 bg-white p-4 rounded shadow-sm border">
            <h2 class="h5 fw-bold mb-4 heading-accent">駐車場のご案内</h2>
            <div class="row align-items-center">
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <i class="bi bi-p-square text-primary display-1"></i>
                </div>
                <div class="col-md-9">
                    <p class="fw-bold mb-1"><?php echo esc_html(yoshino_field('parking_title', $page_id, '無料駐車場')); ?></p>
                    <p class="text-secondary mb-0">
                        <?php echo nl2br(esc_html(yoshino_field('parking_text', $page_id, "乗用車：約40台（無料）\n園内各施設をご利用の方も同じ駐車場をご利用いただけます。"))); ?>
                    </p>
                </div>
            </div>
        </section>

        <section id="access" class="mb-5">
            <h2 class="h5 fw-bold mb-4 heading-accent">アクセス</h2>
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                        <iframe
                            src="<?php echo esc_url($map_embed); ?>"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="吉野工芸の里の地図"
                        ></iframe>
                    </div>
                    <p class="small text-secondary mt-2 mb-0"><?php echo esc_html($address); ?></p>
                </div>
                <div class="col-lg-5">
                    <div class="mb-4">
                        <h3 class="h6 fw-bold mb-2"><i class="bi bi-car-front me-2"></i>お車でお越しの方</h3>
                        <p class="small text-secondary mb-0">
                            <?php echo nl2br(esc_html(yoshino_field('access_car', $page_id, "北陸自動車道「白山IC」より国道157号線で南へ約50分\n金沢市内より約50分\n小松市内より約30分"))); ?>
                        </p>
                    </div>
                    <div>
                        <h3 class="h6 fw-bold mb-2"><i class="bi bi-bus-front me-2"></i>公共交通機関でお越しの方</h3>
                        <p class="small text-secondary mb-0">
                            <?php echo nl2br(esc_html(yoshino_field('access_transit', $page_id, "北陸鉄道「鶴来駅」より北鉄白山バス（上吉野経由・瀬女・白峰行き）\n「吉野工芸の里」バス停下車（徒歩すぐ）"))); ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h5 fw-bold mb-4 heading-accent border-bottom pb-3">園内のご案内</h2>
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($guide_items as $item) : ?>
                        <li class="mb-4">
                            <p class="fw-bold mb-1">● <?php echo esc_html($item['title'] ?? ''); ?></p>
                            <p class="ps-3 small text-secondary mb-0"><?php echo nl2br(esc_html($item['body'] ?? '')); ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h5 fw-bold mb-4 heading-accent border-bottom pb-3">お客様へのご注意とお願い</h2>
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($visitor_notes as $note) : ?>
                        <li class="d-flex align-items-start mb-2 small text-secondary">
                            <span class="me-2">・</span>
                            <span><?php echo esc_html($note['text'] ?? ''); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="text-center py-3 border-top">
            <a href="<?php echo esc_url($about_url); ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold me-2">吉野工芸の里について</a>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-link text-secondary">トップへ戻る</a>
        </section>

    </div>
</main>

<?php get_footer(); ?>
