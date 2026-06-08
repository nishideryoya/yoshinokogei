<?php
get_header();

$front_id = (int) get_option('page_on_front');
$hero_img = yoshino_image_url(yoshino_field('hero_image', $front_id), yoshino_img('hero-main'));
$hero_cta_url = yoshino_field('hero_cta_url', $front_id, yoshino_taiken_page_url() . '#reserve');
$news_count = (int) yoshino_field('news_count', $front_id, 3);
$news_count = max(1, min(12, $news_count));
$ig_urls = yoshino_gallery_urls(
    yoshino_field('instagram_gallery', $front_id),
    ['instagram-1', 'instagram-2', 'instagram-3', 'instagram-4', 'instagram-5', 'instagram-6']
);
?>

<main>
    <section class="position-relative overflow-hidden" style="height: 70vh;">
        <img
            src="<?php echo esc_url($hero_img); ?>"
            alt="<?php echo esc_attr(yoshino_opt('site_name', '吉野工芸の里')); ?>"
            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
            decoding="async"
        >
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.45));"></div>

        <div class="position-absolute bottom-0 start-0 m-4">
            <a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn-success btn-lg rounded-pill shadow px-4 py-3 fw-bold">
                <span class="small d-block text-start"><?php echo esc_html(yoshino_field('hero_cta_sub', $front_id, 'ネットで予約がスムーズ！')); ?></span>
                <?php echo esc_html(yoshino_field('hero_cta_label', $front_id, '体験教室の申し込みはこちら')); ?>
            </a>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold mb-0">News & Events</h2>
                <a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="text-secondary small text-decoration-none">More <i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="row g-4">
                <?php
                $events_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => $news_count,
                ]);
                if ($events_query->have_posts()) :
                    while ($events_query->have_posts()) : $events_query->the_post();
                        get_template_part('template-parts/content', 'news-card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    for ($i = 1; $i <= 3; $i++) :
                ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-up">
                        <div class="ratio ratio-16x9 overflow-hidden">
                            <img src="<?php echo esc_url(yoshino_img('news-' . $i)); ?>" class="object-fit-cover w-100 h-100" alt="">
                        </div>
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">イベント</span>
                            <p class="small text-muted mb-1">2026.04.23</p>
                            <h5 class="card-title fw-bold">春の工芸体験フェア開催のお知らせ</h5>
                        </div>
                    </div>
                </div>
                <?php
                    endfor;
                endif;
                ?>
            </div>
        </div>
    </section>
    <section class="py-5 bg-white">
      <div class="container">
          <div class="row g-0 align-items-stretch shadow-sm rounded overflow-hidden">
              
              <div class="col-md-7 position-relative overflow-hidden" style="min-height: 400px;">
                  <img src="<?php echo esc_url(yoshino_image_url(yoshino_field('about_image', $front_id), yoshino_img('about-main'))); ?>" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" alt="吉野工芸の里の施設">
                  <div class="position-absolute top-0 start-0 m-4">
                      <span class="bg-white px-3 py-2 fw-bold small shadow-sm"><?php echo esc_html(yoshino_field('about_label', $front_id, '施設案内')); ?></span>
                  </div>
              </div>

              <div class="col-md-5 bg-light p-5 d-flex flex-column justify-content-center">
                  <h2 class="h3 fw-bold mb-4">
                      <?php echo esc_html(yoshino_field('about_title', $front_id, '吉野工芸の里について')); ?>
                      <span class="d-block small text-secondary fw-normal mt-2"><?php echo esc_html(yoshino_field('about_subtitle', $front_id, 'About us')); ?></span>
                  </h2>
                  <p class="text-secondary lh-lg mb-4">
                      <?php echo nl2br(esc_html(yoshino_field('about_text', $front_id, '白山の豊かな自然に囲まれた「吉野工芸の里」は、伝統工芸の継承と新たな創造の場です。展示館での鑑賞、職人の技を体験できるワークショップ、広大な公園での散策など、五感で工芸に触れるひとときをお過ごしいただけます。'))); ?>
                  </p>
                  <div>
                      <a href="<?php echo esc_url(yoshino_about_page_url()); ?>" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
                          詳しく見る <i class="bi bi-arrow-right ms-2"></i>
                      </a>
                  </div>
              </div>

          </div>
      </div>
    </section>
    <section class="py-5 bg-light">
    <div class="container">
        <h2 class="h4 fw-bold mb-4">
            <?php echo esc_html(yoshino_field('facility_title', $front_id, '施設情報')); ?>
            <span class="small text-secondary ms-2"><?php echo esc_html(yoshino_field('facility_subtitle', $front_id, 'Facility')); ?></span>
        </h2>
        
        <div class="swiper facility-swiper pb-5">
            <div class="swiper-wrapper">
                <?php foreach (yoshino_get_facilities() as $facility) : ?>
                    <?php get_template_part('template-parts/facility', 'card', ['facility' => $facility]); ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="text-center mt-5">
              <a href="<?php echo esc_url(yoshino_map_page_url()); ?>" class="d-inline-flex align-items-center justify-content-center bg-white border border-dark text-dark px-5 py-3 rounded-pill text-decoration-none hover-dark-btn transition shadow-sm">
                  <i class="bi bi-map-fill me-2 h5 mb-0 text-warning"></i>
                  <span class="fw-bold">イラストマップで全体を見る</span>
                  <i class="bi bi-chevron-right ms-3 small"></i>
              </a>
            </div>
        </div>
    </div>
</section>

<script>
window.addEventListener('load', function() {
    if (typeof Swiper !== 'undefined') {
        new Swiper('.facility-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: { delay: 3000 },
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 4 }
            }
        });
    }
});
</script>
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card h-100 border-secondary-subtle">
                        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                            <h2 class="h4 fw-bold mb-0">
                                おしらせ <span class="small text-secondary ms-2">News & topics</span>
                            </h2>
                            <a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="text-secondary small text-decoration-none">More <i class="bi bi-chevron-right"></i></a>
                        </div>
                        <div class="card-body p-4">
                            <ul class="list-unstyled mb-0">
                                <?php
                                $news_query = new WP_Query([
                                    'post_type'      => 'post',
                                    'posts_per_page' => 2,
                                ]);
                                ?>

                                <?php if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); ?>
                                    <li class="mb-4 pb-3 border-bottom border-dotted">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none d-flex align-items-start text-dark hover-green">
                                            <span class="text-success me-2">■</span>
                                            <div class="flex-grow-1">
                                                <div class="small text-secondary mb-1"><?php echo get_the_date('Y.m.d'); ?></div>
                                                <span><?php the_title(); ?></span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endwhile; wp_reset_postdata(); else : ?>
                                    <li class="text-secondary small">現在お知らせはありません。</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card h-100 border-secondary-subtle">
                        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                            <h2 class="h4 fw-bold mb-0"><?php echo esc_html(yoshino_field('instagram_title', $front_id, 'Instagram')); ?></h2>
                            <?php if ($ig_link = yoshino_field('instagram_link', $front_id, yoshino_opt('instagram_url'))) : ?>
                                <a href="<?php echo esc_url($ig_link); ?>" target="_blank" rel="noopener noreferrer" class="text-secondary small text-decoration-none">Follow <i class="bi bi-box-arrow-up-right"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-2">
                                <?php foreach ($ig_urls as $ig_url) : ?>
                                <div class="col-4">
                                    <div class="ratio ratio-1x1 bg-light">
                                        <img src="<?php echo esc_url($ig_url); ?>" class="object-fit-cover shadow-sm rounded-1 w-100 h-100" alt="Instagram画像">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
