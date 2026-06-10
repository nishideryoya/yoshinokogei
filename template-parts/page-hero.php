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

$img_url = yoshino_page_hero_url($post_id, $image_key);
?>
<section class="page-hero position-relative overflow-hidden py-5 text-white text-center">
    <img
        src="<?php echo esc_url($img_url); ?>"
        alt=""
        class="page-hero__bg w-100 h-100 object-fit-cover"
        decoding="async"
        aria-hidden="true"
    >
    <div class="page-hero__overlay position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></div>
    <div class="container py-4 position-relative">
        <?php if ($title) : ?>
            <h1 class="display-5 fw-bold"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>
        <?php if ($subtitle) : ?>
            <p class="mb-0 opacity-75"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
    </div>
</section>
