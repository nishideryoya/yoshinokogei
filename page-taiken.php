<?php
/**
 * Template Name: 体験教室
 */
$page_id    = yoshino_get_page_id('taiken');
$page_title = yoshino_get_page_title('taiken', '体験教室');

get_header();
$taiken_url = yoshino_taiken_page_url();
$phone      = yoshino_opt('contact_phone', '076-255-5319');

$reserve_notes = yoshino_repeater_or_default(yoshino_field('reserve_notes', $page_id), [
    ['text' => 'キャンセルは開催日の3日前までにお電話にてご連絡ください。'],
    ['text' => '定員に達し次第、受付を終了させていただきます。'],
    ['text' => '団体（20名以上）のご予約はご利用の案内をご確認のうえお問い合わせください。'],
]);

$taiken_query = new WP_Query([
    'post_type'      => 'taiken',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
]);
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'     => $page_title,
    'subtitle'  => 'Workshop',
    'image_key' => 'hero-taiken',
    'post_id'   => $page_id,
]); ?>

<main class="py-5">
    <div class="container">

        <section class="mb-5 text-center">
            <a href="#reserve" class="btn btn-success btn-lg rounded-pill shadow px-5 py-3 fw-bold">
                <span class="small d-block"><?php echo esc_html(yoshino_field('cta_sub', $page_id, 'ネットで予約がスムーズ！')); ?></span>
                <?php echo esc_html(yoshino_field('cta_label', $page_id, '体験教室の申し込みはこちら')); ?>
            </a>
        </section>

        <section id="taiken" class="mb-5 pb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                <div>
                    <h2 class="h4 fw-bold mb-1 border-0 ps-0">体験教室</h2>
                    <p class="text-secondary small mb-0">Workshop</p>
                </div>
                <p class="text-secondary small mb-0"><?php echo esc_html(yoshino_field('section_intro', $page_id, '職人の指導のもと、伝統工芸の技に触れる体験プログラムです。')); ?></p>
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
                                            ['icon' => 'bi-currency-yen', 'key' => 'price'],
                                            ['icon' => 'bi-clock', 'key' => 'duration'],
                                            ['icon' => 'bi-people', 'key' => 'capacity'],
                                            ['icon' => 'bi-geo-alt', 'key' => 'location'],
                                        ];
                                        foreach ($meta_items as $item) :
                                            $val = yoshino_taiken_meta(get_the_ID(), $item['key']);
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
                    <div class="col-12">
                        <p class="text-center text-secondary py-4">体験教室は管理画面の「体験教室」から追加できます。</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section id="reserve" class="mb-2">
            <div class="card border-0 shadow-sm bg-light overflow-hidden">
                <div class="row g-0 align-items-stretch">
                    <div class="col-lg-5 bg-success text-white p-4 p-md-5 d-flex flex-column justify-content-center">
                        <h2 class="h5 fw-bold mb-3"><?php echo esc_html(yoshino_field('reserve_title', $page_id, '体験教室のご予約')); ?></h2>
                        <p class="small mb-0 opacity-75"><?php echo esc_html(yoshino_field('reserve_lead', $page_id, '事前予約制のプログラムがございます。お電話またはWebフォームよりお申し込みください。')); ?></p>
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
                                        <p class="small text-secondary mb-1"><?php echo esc_html(yoshino_field('reserve_phone_hours', $page_id, '10:00〜17:00（火曜休）')); ?></p>
                                        <p class="fw-bold mb-0"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="text-decoration-none text-dark"><?php echo esc_html($phone); ?></a></p>
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
                                        <?php $web_url = yoshino_field('reserve_web_url', $page_id, '#'); ?>
                                        <a href="<?php echo esc_url($web_url); ?>" class="btn btn-success btn-sm rounded-pill px-4"<?php echo $web_url === '#' ? '' : ' target="_blank" rel="noopener noreferrer"'; ?>>予約フォームへ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-unstyled small text-secondary mb-0">
                            <?php foreach ($reserve_notes as $note) : ?>
                            <li class="mb-2"><i class="bi bi-check-circle me-2 text-success"></i><?php echo esc_html($note['text'] ?? ''); ?></li>
                            <?php endforeach; ?>
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
