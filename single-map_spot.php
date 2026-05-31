<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $color = get_post_meta(get_the_ID(), 'map_color', true) ?: 'coral';
    $icon  = get_post_meta(get_the_ID(), 'map_icon', true) ?: 'geo-alt';
    $slug  = get_post_field('post_name', get_the_ID());
    $spot_img = has_post_thumbnail()
        ? get_the_post_thumbnail_url(get_the_ID(), 'large')
        : yoshino_img('facility-' . $slug, 'default');
?>
<section class="page-hero py-4 text-white text-center" style="<?php echo esc_attr(yoshino_hero_bg_style('hero-map')); ?>">
    <div class="container py-3">
        <h1 class="h3 fw-bold mb-0"><?php the_title(); ?></h1>
    </div>
</section>
<main class="py-5 bg-white">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>" class="text-secondary text-decoration-none">TOP</a></li>
                <li class="breadcrumb-item"><a href="<?php echo esc_url(yoshino_map_page_url()); ?>" class="text-secondary text-decoration-none">全体マップ</a></li>
                <li class="breadcrumb-item active fw-bold" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-7">
                <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm mb-4">
                    <img src="<?php echo esc_url($spot_img); ?>" class="object-fit-cover w-100 h-100" alt="<?php the_title_attribute(); ?>">
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="map-spot-card__dot map-pin--<?php echo esc_attr($color); ?> map-spot-card__dot--lg">
                        <i class="bi bi-<?php echo esc_attr($icon); ?>"></i>
                    </span>
                    <p class="h5 fw-bold mb-0 text-secondary">施設のご案内</p>
                </div>

                <?php if (has_excerpt()) : ?>
                    <p class="lead text-secondary"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>

                <div class="entry-content text-secondary lh-lg">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm bg-light sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h2 class="h6 fw-bold mb-3 heading-accent border-0 ps-0">施設情報</h2>
                        <p class="small text-secondary mb-4">マップ上の位置からアクセスできます。営業時間は施設により異なります。</p>
                        <a href="<?php echo esc_url(yoshino_map_page_url()); ?>" class="btn btn-outline-dark w-100 rounded-pill fw-bold mb-2">
                            <i class="bi bi-map me-1"></i>全体マップに戻る
                        </a>
                        <a href="<?php echo esc_url(yoshino_taiken_page_url()); ?>" class="btn btn-success w-100 rounded-pill fw-bold">
                            体験教室を見る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php endwhile; ?>

<?php get_footer(); ?>
