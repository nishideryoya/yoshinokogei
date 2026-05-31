<?php get_header(); ?>

<main>
    <section class="position-relative overflow-hidden" style="height: 70vh;">
        <img
            src="<?php echo esc_url(yoshino_img('hero-main')); ?>"
            alt="吉野工芸の里"
            class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
            decoding="async"
        >
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(rgba(0,0,0,0.25), rgba(0,0,0,0.45));"></div>
        
        <div class="position-absolute bottom-0 start-0 m-4">
            <a href="<?php echo esc_url(yoshino_taiken_page_url() . '#reserve'); ?>" class="btn btn-success btn-lg rounded-pill shadow px-4 py-3 fw-bold">
                <span class="small d-block text-start">ネットで予約がスムーズ！</span>
                体験教室の申し込みはこちら
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
                    'posts_per_page' => 3,
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
                  <img src="<?php echo esc_url(yoshino_img('facility-tenji-kan')); ?>" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" alt="吉野工芸の里の施設">
                  <div class="position-absolute top-0 start-0 m-4">
                      <span class="bg-white px-3 py-2 fw-bold small shadow-sm">施設案内</span>
                  </div>
              </div>

              <div class="col-md-5 bg-light p-5 d-flex flex-column justify-content-center">
                  <h2 class="h3 fw-bold mb-4">
                      吉野工芸の里について
                      <span class="d-block small text-secondary fw-normal mt-2">About us</span>
                  </h2>
                  <p class="text-secondary lh-lg mb-4">
                      白山の豊かな自然に囲まれた「吉野工芸の里」は、伝統工芸の継承と新たな創造の場です。
                      展示館での鑑賞、職人の技を体験できるワークショップ、広大な公園での散策など、
                      五感で工芸に触れるひとときをお過ごしいただけます。
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
        <h2 class="h4 fw-bold mb-4">施設情報 <span class="small text-secondary ms-2">Facility</span></h2>
        
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
                1024: { slidesPerView: 4 } // ここでPC4枚を指定
            }
        });
    } else {
        console.error("Swiperが読み込まれていません。functions.phpを確認してください。");
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
                                // 最新のお知らせを2件取得
                                $news_args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 2,
                                );
                                $news_query = new WP_Query($news_args);
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
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h2 class="h4 fw-bold mb-0">Instagram</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-2">
                                <?php 
                                // インスタグラム部分はそのまま維持（ダミー画像6枚）
                                for($i=1; $i<=6; $i++): 
                                ?>
                                <div class="col-4">
                                    <div class="ratio ratio-1x1 bg-light">
                                        <img src="<?php echo esc_url(yoshino_img('instagram-' . $i)); ?>" class="object-fit-cover shadow-sm rounded-1 w-100 h-100" alt="Instagram画像">
                                    </div>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>