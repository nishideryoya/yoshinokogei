<?php
/**
 * Template Name: 全体マップ
 */
get_header();

$spots    = yoshino_get_facilities();
$map_url  = yoshino_map_page_url();
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'      => '全体マップ',
    'subtitle'   => 'Village Map',
    'image_key'  => 'hero-map',
]); ?>

<main class="map-page">
    <section class="map-intro text-center py-5">
        <div class="container">
            <p class="map-intro__catch display-6 fw-bold mb-3">見て、ふれて、創る。</p>
            <p class="map-intro__lead text-secondary mb-0">
                自然と調和した工芸の里、北陸の伝統工芸を体感。<br class="d-none d-md-inline">
                マップのマークをタップすると、各施設の詳細ページへ移動します。
            </p>
        </div>
    </section>

    <section class="map-section pb-4">
        <div class="container-fluid px-lg-5">
            <?php get_template_part('template-parts/village', 'map', ['spots' => $spots]); ?>
        </div>
    </section>

    <section class="map-grid-section py-5 bg-white">
        <div class="container">
            <h2 class="h5 fw-bold text-center mb-4">施設一覧</h2>
            <div class="row g-3 g-md-4" id="map-spot-grid">
                <?php foreach ($spots as $spot) :
                    $img = !empty($spot['image'])
                        ? $spot['image']
                        : yoshino_img('facility-' . ($spot['slug'] ?? ''), 'default');
                ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <a
                        href="<?php echo esc_url($spot['url']); ?>"
                        class="map-spot-card text-decoration-none text-dark"
                        data-spot-id="<?php echo esc_attr($spot['id']); ?>"
                    >
                        <div class="map-spot-card__image ratio ratio-4x3 overflow-hidden">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($spot['title']); ?>" class="object-fit-cover w-100 h-100" loading="lazy">
                        </div>
                        <div class="map-spot-card__label d-flex align-items-center gap-2 px-2 py-2 bg-white border border-top-0">
                            <span class="map-spot-card__dot map-pin--<?php echo esc_attr($spot['color']); ?>">
                                <i class="bi bi-<?php echo esc_attr($spot['icon']); ?>"></i>
                            </span>
                            <span class="small fw-bold"><?php echo esc_html($spot['title']); ?></span>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
