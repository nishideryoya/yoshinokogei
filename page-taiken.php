<?php
/**
 * Template Name: 体験教室
 */
get_header();

$taiken_url = yoshino_taiken_page_url();

$sample_taiken = [
    [
        'title'    => '加賀の手漉き和紙体験',
        'excerpt'  => '伝統的な加賀の手漉き和紙を、職人の指導のもと自分の手で漉いてみましょう。世界に一つだけの和紙をお持ち帰りいただけます。',
        'price'    => '1,500円（材料費込）',
        'duration' => '約60分',
        'capacity' => '各回10名',
        'target'   => '小学生以上',
        'location' => '和紙漉き体験棟',
        'image'    => 'https://placehold.jp/24/8b4513/ffffff/640x360.png?text=%E5%92%8C%E7%B4%99%E4%BD%93%E9%A8%93',
    ],
    [
        'title'    => '木工ワークショップ',
        'excerpt'  => '地元の木材を使い、コースターなどの小物づくりに挑戦。初心者の方でも安心してご参加いただけます。',
        'price'    => '2,000円（材料費込）',
        'duration' => '約90分',
        'capacity' => '各回8名',
        'target'   => '中学生以上',
        'location' => '木工センター',
        'image'    => 'https://placehold.jp/24/6b8e23/ffffff/640x360.png?text=%E6%9C%A8%E5%B7%A5%E4%BD%93%E9%A8%93',
    ],
    [
        'title'    => '型染め体験',
        'excerpt'  => '加賀友禅の型を使った染物体験。ハンカチやトートバッグに、自分だけの模様を染め上げます。',
        'price'    => '1,800円（材料費込）',
        'duration' => '約75分',
        'capacity' => '各回12名',
        'target'   => '全年齢（未就学児は保護者同伴）',
        'location' => '体験工房',
        'image'    => 'https://placehold.jp/24/4682b4/ffffff/640x360.png?text=%E6%9F%93%E7%89%A9%E4%BD%93%E9%A8%93',
    ],
    [
        'title'    => '陶芸手びねり体験',
        'excerpt'  => 'ろくろを使わず、手びねりで自由な形の器づくり。釉薬選びも楽しめる人気のプログラムです。',
        'price'    => '2,500円（焼成・送料別）',
        'duration' => '約90分',
        'capacity' => '各回6名',
        'target'   => '小学生以上',
        'location' => '陶芸工房',
        'image'    => 'https://placehold.jp/24/cd853f/ffffff/640x360.png?text=%E9%99%B6%E8%8A%B8%E4%BD%93%E9%A8%93',
    ],
];

$taiken_query = new WP_Query([
    'post_type'      => 'taiken',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
]);
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'      => '体験教室',
    'subtitle'   => '',
    'image_key'  => 'hero-taiken',
]); ?>

<main class="py-5">
    <div class="container">

        <section class="mb-5 text-center">
            <a href="#reserve" class="btn btn-success btn-lg rounded-pill shadow px-5 py-3 fw-bold">
                <span class="small d-block">ネットで予約がスムーズ！</span>
                体験教室の申し込みはこちら
            </a>
        </section>

        <section id="taiken" class="mb-5 pb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                <div>
                    <h2 class="h4 fw-bold mb-1 border-0 ps-0">体験教室</h2>
                    <p class="text-secondary small mb-0">Workshop</p>
                </div>
                <p class="text-secondary small mb-0">職人の指導のもと、伝統工芸の技に触れる体験プログラムです。</p>
            </div>

            <div class="row g-4">
                <?php if ($taiken_query->have_posts()) : ?>
                    <?php while ($taiken_query->have_posts()) : $taiken_query->the_post(); ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100 border-0 shadow-sm hover-up taiken-card">
                                <div class="ratio ratio-16x9 bg-light overflow-hidden">
                                    <img src="<?php echo esc_url(yoshino_taiken_card_image(get_the_ID())); ?>" class="object-fit-cover w-100 h-100" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <h3 class="h6 fw-bold mb-2"><?php the_title(); ?></h3>
                                    <p class="small text-secondary mb-3 flex-grow-1"><?php echo esc_html(get_the_excerpt()); ?></p>
                                    <ul class="list-unstyled small mb-3 taiken-meta">
                                        <?php
                                        $meta_items = [
                                            ['icon' => 'bi-currency-yen', 'key' => 'taiken_price'],
                                            ['icon' => 'bi-clock', 'key' => 'taiken_duration'],
                                            ['icon' => 'bi-people', 'key' => 'taiken_capacity'],
                                            ['icon' => 'bi-geo-alt', 'key' => 'taiken_location'],
                                        ];
                                        foreach ($meta_items as $item) :
                                            $val = get_post_meta(get_the_ID(), $item['key'], true);
                                            if (!$val) continue;
                                        ?>
                                            <li class="mb-1"><i class="bi <?php echo esc_attr($item['icon']); ?> me-2 text-success"></i><?php echo esc_html($val); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark btn-sm rounded-pill align-self-start">詳しく見る</a>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php foreach ($sample_taiken as $item) : ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="card h-100 border-0 shadow-sm hover-up taiken-card">
                                <div class="ratio ratio-16x9 bg-light">
                                    <img src="<?php echo esc_url($item['image']); ?>" class="object-fit-cover" alt="<?php echo esc_attr($item['title']); ?>">
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <h3 class="h6 fw-bold mb-2"><?php echo esc_html($item['title']); ?></h3>
                                    <p class="small text-secondary mb-3 flex-grow-1"><?php echo esc_html($item['excerpt']); ?></p>
                                    <ul class="list-unstyled small mb-0 taiken-meta">
                                        <li class="mb-1"><i class="bi bi-currency-yen me-2 text-success"></i><?php echo esc_html($item['price']); ?></li>
                                        <li class="mb-1"><i class="bi bi-clock me-2 text-success"></i><?php echo esc_html($item['duration']); ?></li>
                                        <li class="mb-1"><i class="bi bi-people me-2 text-success"></i><?php echo esc_html($item['capacity']); ?></li>
                                        <li class="mb-1"><i class="bi bi-person me-2 text-success"></i><?php echo esc_html($item['target']); ?></li>
                                        <li><i class="bi bi-geo-alt me-2 text-success"></i><?php echo esc_html($item['location']); ?></li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <section id="reserve" class="mb-2">
            <div class="card border-0 shadow-sm bg-light overflow-hidden">
                <div class="row g-0 align-items-stretch">
                    <div class="col-lg-5 bg-success text-white p-4 p-md-5 d-flex flex-column justify-content-center">
                        <h2 class="h5 fw-bold mb-3">体験教室のご予約</h2>
                        <p class="small mb-0 opacity-75">事前予約制のプログラムがございます。お電話またはWebフォームよりお申し込みください。</p>
                    </div>
                    <div class="col-lg-7 p-4 p-md-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:48px;height:48px;">
                                        <i class="bi bi-telephone-fill text-success h5 mb-0"></i>
                                    </div>
                                    <div>
                                        <h3 class="h6 fw-bold mb-1">お電話での予約</h3>
                                        <p class="small text-secondary mb-1">9:00〜17:00（年中無休）</p>
                                        <p class="fw-bold mb-0">0761-XX-XXXX</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width:48px;height:48px;">
                                        <i class="bi bi-globe2 text-primary h5 mb-0"></i>
                                    </div>
                                    <div>
                                        <h3 class="h6 fw-bold mb-1">Web予約</h3>
                                        <p class="small text-secondary mb-2">24時間いつでもお申し込み可能</p>
                                        <a href="#" class="btn btn-success btn-sm rounded-pill px-4">予約フォームへ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-unstyled small text-secondary mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-success"></i>キャンセルは開催日の3日前までにお電話にてご連絡ください。</li>
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-success"></i>定員に達し次第、受付を終了させていただきます。</li>
                            <li><i class="bi bi-check-circle me-2 text-success"></i>団体（20名以上）のご予約は<a href="<?php echo esc_url(yoshino_guide_page_url()); ?>" class="text-decoration-none">ご利用の案内</a>をご確認のうえお問い合わせください。</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5 text-center">
            <p class="text-secondary small mb-3">イベント・最新情報は News &amp; Events をご覧ください</p>
            <a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-calendar-event me-1"></i>開催情報・お知らせ一覧
            </a>
        </section>

    </div>
</main>

<?php get_footer(); ?>
