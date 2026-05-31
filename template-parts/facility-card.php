<?php
/**
 * 施設カード（Facility スライダー・マップ一覧で共通）
 *
 * @var array $facility yoshino_get_facilities() の1件
 */
$facility = $args['facility'] ?? null;
if (empty($facility)) {
    return;
}
$img = !empty($facility['image'])
    ? $facility['image']
    : yoshino_img('facility-' . ($facility['slug'] ?? ''), 'default');
?>
<div class="swiper-slide h-auto">
    <a href="<?php echo esc_url($facility['url']); ?>" class="card h-100 border-secondary-subtle bg-white text-decoration-none text-dark facility-card">
        <div class="card-body p-3">
            <div class="d-flex align-items-center gap-2 border-bottom pb-2 mb-3">
                <span class="map-spot-card__dot map-pin--<?php echo esc_attr($facility['color']); ?>">
                    <i class="bi bi-<?php echo esc_attr($facility['icon']); ?>"></i>
                </span>
                <h3 class="h6 fw-bold mb-0"><?php echo esc_html($facility['title']); ?></h3>
            </div>
            <div class="ratio ratio-16x9 mb-3 bg-light rounded overflow-hidden">
                <img src="<?php echo esc_url($img); ?>" class="object-fit-cover w-100 h-100" alt="<?php echo esc_attr($facility['title']); ?>" loading="lazy">
            </div>
            <p class="small text-secondary mb-0"><?php echo esc_html($facility['excerpt']); ?></p>
        </div>
    </a>
</div>
