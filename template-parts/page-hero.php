<?php
/**
 * ページヒーロー
 *
 * @var string $title
 * @var string $subtitle
 * @var string $image_key yoshino_img のキー
 * @var int    $post_id ACF hero_image 取得用
 */
$title     = $args['title'] ?? '';
$subtitle  = $args['subtitle'] ?? '';
$image_key = $args['image_key'] ?? 'hero-main';
$post_id   = $args['post_id'] ?? 0;

if (!$post_id) {
    $post_id = get_queried_object_id();
}

if ($post_id && yoshino_acf_active()) {
    $acf_subtitle = yoshino_field('hero_subtitle', $post_id, '');
    if ($acf_subtitle && empty($args['subtitle'])) {
        $subtitle = $acf_subtitle;
    }
}

$style = yoshino_hero_image_style($post_id, $image_key);
?>
<section class="page-hero py-5 text-white text-center" style="<?php echo esc_attr($style); ?>">
    <div class="container py-4">
        <?php if ($title) : ?>
            <h1 class="display-5 fw-bold"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>
        <?php if ($subtitle) : ?>
            <p class="mb-0 opacity-75"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
    </div>
</section>
