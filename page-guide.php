<?php
/**
 * Template Name: ご利用の案内
 */
get_header();

$taiken_url = yoshino_taiken_page_url();
$about_url  = yoshino_about_page_url();
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'      => 'ご利用の案内',
    'subtitle'   => 'Guide',
    'image_key'  => 'hero-guide',
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
                                <span class="text-secondary">10:00 〜 17:00</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold d-block">電話受付</span>
                                <span class="text-secondary">10:00 〜 17:00（休館日を除く）</span>
                            </li>
                            <li>
                                <span class="fw-bold d-block text-danger">休館日</span>
                                <span class="text-secondary">
                                    毎週火曜日（祝日の場合は開館し、翌日が休館日）<br>
                                    12月29日 〜 1月3日
                                </span>
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
                            <tr>
                                <th class="ps-0 py-2 align-top" style="width: 42%;">園内入場</th>
                                <td class="py-2"><span class="fw-bold text-success">無料</span></td>
                            </tr>
                            <tr>
                                <th class="ps-0 py-2 align-top">ふるさと工房<br><span class="fw-normal small text-muted">2階展示室</span></th>
                                <td class="py-2 text-secondary">鑑賞無料</td>
                            </tr>
                            <tr>
                                <th class="ps-0 py-2 align-top">体験教室</th>
                                <td class="py-2 text-secondary">
                                    プログラムにより異なります<br>
                                    <span class="small">（例：陶芸 3,500円〜 / 和紙 800円〜 / ガラス 1,500円〜）</span>
                                </td>
                            </tr>
                        </table>
                        <p class="small text-secondary mt-3 mb-2">
                            ※体験は事前予約を優先しております。最新のメニュー・料金はお電話にてご確認ください。
                        </p>
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
                                <td class="ps-3">吉野工芸の里</td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">住所</th>
                                <td class="ps-3">〒920-2321 石川県白山市吉野春29番地</td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">電話</th>
                                <td class="ps-3">
                                    <a href="tel:0762555319" class="text-decoration-none fw-bold">076-255-5319</a>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">FAX</th>
                                <td class="ps-3">076-255-5360</td>
                            </tr>
                            <tr>
                                <th class="bg-light ps-3">メール</th>
                                <td class="ps-3">
                                    <a href="mailto:kougei@asagaotv.ne.jp" class="text-decoration-none">kougei@asagaotv.ne.jp</a>
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
                                <tr>
                                    <td>陶芸教室</td>
                                    <td>大人 3,500円 / 小人 2,500円〜</td>
                                    <td>30分〜2時間</td>
                                </tr>
                                <tr>
                                    <td>ろくろ陶芸体験</td>
                                    <td>3,800円〜（焼成料別の場合あり）</td>
                                    <td>約90分</td>
                                </tr>
                                <tr>
                                    <td>創作和紙・押し花</td>
                                    <td>800円〜1,500円</td>
                                    <td>40分〜2時間</td>
                                </tr>
                                <tr>
                                    <td>ランプシェード</td>
                                    <td>3,500円〜</td>
                                    <td>3時間〜</td>
                                </tr>
                                <tr>
                                    <td>ガラス体験</td>
                                    <td>1,500円〜15,000円</td>
                                    <td>内容により異なる</td>
                                </tr>
                                <tr>
                                    <td>木工</td>
                                    <td>2,000円〜</td>
                                    <td>内容により異なる</td>
                                </tr>
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
                    <p class="fw-bold mb-1">無料駐車場</p>
                    <p class="text-secondary mb-0">
                        乗用車：約40台（無料）<br>
                        園内各施設をご利用の方も同じ駐車場をご利用いただけます。
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
                            src="https://www.google.com/maps?q=%E5%90%89%E9%87%8E%E5%B7%A5%E8%8A%B8%E3%81%AE%E9%87%8C+%E7%9F%B3%E5%B7%9D%E7%9C%8C%E7%99%BD%E5%B1%B1%E5%B8%82&hl=ja&z=15&output=embed"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="吉野工芸の里の地図"
                        ></iframe>
                    </div>
                    <p class="small text-secondary mt-2 mb-0">
                        〒920-2321 石川県白山市吉野春29番地
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="mb-4">
                        <h3 class="h6 fw-bold mb-2"><i class="bi bi-car-front me-2"></i>お車でお越しの方</h3>
                        <p class="small text-secondary mb-0">
                            北陸自動車道「白山IC」より国道157号線で南へ約50分<br>
                            金沢市内より約50分<br>
                            小松市内より約30分
                        </p>
                    </div>
                    <div>
                        <h3 class="h6 fw-bold mb-2"><i class="bi bi-bus-front me-2"></i>公共交通機関でお越しの方</h3>
                        <p class="small text-secondary mb-0">
                            北陸鉄道「鶴来駅」より北鉄白山バス（上吉野経由・瀬女・白峰行き）<br>
                            「吉野工芸の里」バス停下車（徒歩すぐ）
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
                        <li class="mb-4">
                            <p class="fw-bold mb-1">● 白山市観光情報センター「工芸の里」</p>
                            <p class="ps-3 small text-secondary mb-0">
                                園内にあり、白山市の観光情報をご案内しています（平成26年4月オープン）。
                            </p>
                        </li>
                        <li class="mb-4">
                            <p class="fw-bold mb-1">● ふるさと工房</p>
                            <p class="ps-3 small text-secondary mb-0">
                                1階で工芸品の販売、2階展示室では常設展示を無料でご覧いただけます。
                            </p>
                        </li>
                        <li>
                            <p class="fw-bold mb-1">● 総合案内・体験のお申込み</p>
                            <p class="ps-3 small text-secondary mb-0">
                                吉野工芸の里事務局（10:00〜17:00・火曜休）<br>
                                TEL <a href="tel:0762555319" class="text-decoration-none">076-255-5319</a>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h5 fw-bold mb-4 heading-accent border-bottom pb-3">お客様へのご注意とお願い</h2>
                    <ul class="list-unstyled mb-0">
                        <?php
                        $notes = [
                            '展示作品には手を触れないでください。',
                            '指定以外の場所での飲食・喫煙はご遠慮ください。',
                            '撮影は個人利用の範囲でお願いします。作家・作品の商用利用目的の撮影はご遠慮ください。',
                            '体験教室は事前予約をおすすめします（当日の空き状況によりご案内できない場合があります）。',
                            '自然豊かな園内です。ゴミはお持ち帰りいただくか、指定の場所へお願いします。',
                            'ペットとのご入園については、事前にお問い合わせください（補助犬を除く）。',
                        ];
                        foreach ($notes as $note) :
                        ?>
                        <li class="d-flex align-items-start mb-2 small text-secondary">
                            <span class="me-2">・</span>
                            <span><?php echo esc_html($note); ?></span>
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
