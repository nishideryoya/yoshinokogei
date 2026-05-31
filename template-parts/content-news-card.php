<?php
/**
 * お知らせ・イベントカード
 */
$categories = get_the_category();
$badge_class = 'bg-primary';
if ($categories) {
    $slug = $categories[0]->slug;
    $badge_map = [
        'event'   => 'bg-primary',
        'info'    => 'bg-success',
        'notice'  => 'bg-secondary',
    ];
    $badge_class = $badge_map[$slug] ?? 'bg-primary';
}
?>
<div class="col-md-4">
    <article class="card h-100 border-0 shadow-sm hover-up position-relative">
        <div class="ratio ratio-16x9 bg-light overflow-hidden">
            <img
                src="<?php echo esc_url(yoshino_news_card_image(get_the_ID())); ?>"
                alt="<?php the_title_attribute(); ?>"
                class="object-fit-cover w-100 h-100"
                loading="lazy"
            >
        </div>
        <div class="card-body">
            <?php if ($categories) : ?>
                <span class="badge <?php echo esc_attr($badge_class); ?> mb-2"><?php echo esc_html($categories[0]->name); ?></span>
            <?php endif; ?>
            <p class="small text-muted mb-1"><?php echo get_the_date('Y.m.d'); ?></p>
            <h3 class="h6 card-title fw-bold mb-0"><?php the_title(); ?></h3>
        </div>
        <a href="<?php the_permalink(); ?>" class="stretched-link" aria-label="<?php the_title_attribute(); ?>"></a>
    </article>
</div>
