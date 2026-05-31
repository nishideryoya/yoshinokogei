<?php
/**
 * Template Name: 吉野工芸の里について
 */
get_header();

$map_url    = yoshino_map_page_url();
$taiken_url = yoshino_taiken_page_url();
$guide_url  = yoshino_guide_page_url();
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'      => '吉野工芸の里について',
    'subtitle'   => 'About Yoshino Kougei no Sato',
    'image_key'  => 'hero-about',
]); ?>

<main class="py-5">
    <div class="container" style="max-width: 900px;">

        <section class="mb-5">
            <p class="lead text-secondary lh-lg">
                白山麓の豊かな自然に抱かれた「吉野工芸の里」は、石川県白山市吉野に広がる、
                工芸と文化の体験型施設です。陶芸・ガラス・和紙・木工など、さまざまな分野の作家が集い、
                作品の展示・販売はもちろん、制作体験を通じて「ものづくり」のよろこびに触れていただけます。
            </p>
        </section>

        <section class="mb-5">
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm bg-light">
                        <img src="<?php echo esc_url(yoshino_img('about-nature')); ?>" class="object-fit-cover" alt="白山麓の風景">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="h4 fw-bold heading-accent">ごあいさつ</h2>
                    <p class="text-secondary lh-lg small mb-0">
                        当施設は、昭和60年（1985年）に旧吉野谷村が地域振興を目的として設立し、
                        国の補助を得て芸術文化の振興に取り組んできました。
                        現在は運営母体が「白山吉野地域振興協議会」へ移行し、
                        これまでと変わらぬ志のもと、地域に根ざした文化づくりを続けています。
                        地元の方々、作家の方々、そして多くの来館者のご支援に支えられ、
                        吉野工芸の里は今日まで歩みを重ねてきました。
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-5 py-4 px-4 bg-light rounded">
            <h2 class="h4 fw-bold heading-accent mb-4">3つの魅力</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center px-2">
                        <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm mb-3">
                            <img src="<?php echo esc_url(yoshino_img('about-nature')); ?>" class="object-fit-cover" alt="白山の自然">
                        </div>
                        <h3 class="h6 fw-bold">白山の自然</h3>
                        <p class="small text-secondary mb-0">
                            樹齢660余年を誇る国指定天然記念物「御仏供（おぼけ）杉」をはじめ、
                            芝生の広場や散策路で四季の山あいの風景をお楽しみいただけます。
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center px-2">
                        <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm mb-3">
                            <img src="<?php echo esc_url(yoshino_img('about-craft')); ?>" class="object-fit-cover" alt="工芸体験">
                        </div>
                        <h3 class="h6 fw-bold">匠の技に触れる</h3>
                        <p class="small text-secondary mb-0">
                            ろくろ陶芸、和紙漉き、ランプシェードづくり、押し花アートなど、
                            作家の指導のもとで体験できる教室を開催しています（要予約）。
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center px-2">
                        <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm mb-3">
                            <img src="<?php echo esc_url(yoshino_img('about-salon')); ?>" class="object-fit-cover" alt="鶉荘">
                        </div>
                        <h3 class="h6 fw-bold">歴史と文化の継承</h3>
                        <p class="small text-secondary mb-0">
                            江戸中期の民家を移築した文化交流サロン「鶉荘（うずらそう）」では、
                            工芸と自然のなかで、創造と交流の場を提供しています。
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="h4 fw-bold heading-accent mb-4">園内の主な施設</h2>
            <p class="text-secondary small mb-4">
                野外ギャラリー「パフォーマンス広場」では多数の作家作品が展示され、
                「ふるさと工房」では美術工芸品の展示・販売（2階展示室は無料で鑑賞可能）を行っています。
                平成26年には、園内に白山市観光情報センター「工芸の里」がオープンし、
                市内の観光情報もご案内しています。
            </p>
            <ul class="list-group list-group-flush border rounded shadow-sm">
                <li class="list-group-item d-flex gap-3 align-items-start py-3">
                    <i class="bi bi-brightness-high text-warning fs-5"></i>
                    <div>
                        <strong>パフォーマンス広場</strong>
                        <p class="small text-secondary mb-0">野外ギャラリー。芝生の広場で作品と自然を一体としてお楽しみください。</p>
                    </div>
                </li>
                <li class="list-group-item d-flex gap-3 align-items-start py-3">
                    <i class="bi bi-tree text-success fs-5"></i>
                    <div>
                        <strong>御仏供杉（おぼけすぎ）</strong>
                        <p class="small text-secondary mb-0">国指定天然記念物。樹齢660余年の巨木は、園内散策のハイライトです。</p>
                    </div>
                </li>
                <li class="list-group-item d-flex gap-3 align-items-start py-3">
                    <i class="bi bi-shop text-primary fs-5"></i>
                    <div>
                        <strong>ふるさと工房</strong>
                        <p class="small text-secondary mb-0">作家の工房・教室・ギャラリー。常設展示と工芸品の販売を行っています。</p>
                    </div>
                </li>
                <li class="list-group-item d-flex gap-3 align-items-start py-3">
                    <i class="bi bi-house text-secondary fs-5"></i>
                    <div>
                        <strong>文化交流サロン 鶉荘（うずらそう）</strong>
                        <p class="small text-secondary mb-0">富山県利賀村の江戸中期の民家を移築。文化情報の収集・発信の拠点です。</p>
                    </div>
                </li>
                <li class="list-group-item d-flex gap-3 align-items-start py-3">
                    <i class="bi bi-brush text-info fs-5"></i>
                    <div>
                        <strong>アート＆クラフト交流館</strong>
                        <p class="small text-secondary mb-0">作家との交流会や体験教室の会場。ご予約・お問い合わせは事務局まで。</p>
                    </div>
                </li>
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
                陶芸（ろくろ体験）、和紙を使ったランプシェードづくり、押し花アートなど、
                個人・少人数グループ・学校単位での参加が可能です。
                <strong>事前予約を優先</strong>しておりますので、お早めにお申し込みください。
            </p>
            <a href="<?php echo esc_url($taiken_url); ?>" class="btn btn-success rounded-pill px-4 fw-bold">
                体験教室の一覧・予約
            </a>
        </section>

        <section class="mb-5">
            <h2 class="h4 fw-bold heading-accent mb-4">基本情報</h2>
            <table class="table table-bordered bg-white shadow-sm mb-0">
                <tbody>
                    <tr>
                        <th class="bg-light ps-3" style="width: 28%;">施設名</th>
                        <td class="ps-3">吉野工芸の里（ヨシノコウゲイノサト）</td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">所在地</th>
                        <td class="ps-3">〒920-2321 石川県白山市吉野春29番地</td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">電話</th>
                        <td class="ps-3"><a href="tel:0762555319" class="text-decoration-none">076-255-5319</a>（10:00〜17:00）</td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">FAX</th>
                        <td class="ps-3">076-255-5360</td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">開館時間</th>
                        <td class="ps-3">10:00〜17:00</td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">休館日</th>
                        <td class="ps-3">毎週火曜日（祝日の場合は翌日）<br>12月29日〜1月3日</td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">駐車場</th>
                        <td class="ps-3">約40台（無料）</td>
                    </tr>
                    <tr>
                        <th class="bg-light ps-3">公式サイト</th>
                        <td class="ps-3">
                            <a href="http://www.kougeinosato.or.jp" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                www.kougeinosato.or.jp <i class="bi bi-box-arrow-up-right small"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="mb-5" id="access">
            <h2 class="h4 fw-bold heading-accent mb-4">アクセス</h2>
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                        <iframe
                            src="https://www.google.com/maps?q=%E5%90%89%E9%87%8E%E5%B7%A5%E8%8A%B8%E3%81%AE%E9%87%8C+%E7%9F%B3%E5%B7%9D%E7%9C%8C%E7%99%BD%E5%B1%B1%E5%B8%82&hl=ja&z=15&output=embed"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="吉野工芸の里の地図"
                        ></iframe>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h3 class="h6 fw-bold mb-2"><i class="bi bi-car-front me-2"></i>お車でお越しの方</h3>
                    <p class="small text-secondary mb-4">
                        北陸自動車道「白山IC」より国道157号線で南へ約50分<br>
                        金沢市内より約50分 / 小松市内より約30分
                    </p>
                    <h3 class="h6 fw-bold mb-2"><i class="bi bi-bus-front me-2"></i>公共交通機関でお越しの方</h3>
                    <p class="small text-secondary mb-0">
                        北陸鉄道白山バス「上吉野経由・瀬女・白峰行き」<br>
                        「吉野工芸の里」バス停下車
                    </p>
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
