<?php
/**
 * ページヒーロー
 *
 * @var string $title
 * @var string $subtitle
 * @var string $image_key yoshino_img のキー
 */
$title      = $args['title'] ?? '';
$subtitle   = $args['subtitle'] ?? '';
$image_key  = $args['image_key'] ?? 'hero-main';
$style      = yoshino_hero_bg_style($image_key);
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
