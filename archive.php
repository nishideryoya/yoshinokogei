<?php
/**
 * カテゴリー・タグ等のアーカイブ（News & Events と同じデザイン）
 */
get_header();
?>

<?php get_template_part('template-parts/page', 'hero', [
    'title'      => 'News & Events',
    'subtitle'   => is_category() ? single_cat_title('', false) : 'お知らせ・開催情報',
    'image_key'  => 'hero-news',
]); ?>

<main class="py-5">
    <div class="container">
        <?php
        $categories = get_categories(['hide_empty' => true]);
        if ($categories) :
        ?>
        <div class="d-flex flex-wrap gap-2 mb-5 justify-content-center">
            <a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="btn btn-sm rounded-pill btn-outline-dark">すべて</a>
            <?php foreach ($categories as $cat) : ?>
                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="btn btn-sm rounded-pill <?php echo is_category($cat->term_id) ? 'btn-dark' : 'btn-outline-dark'; ?>"><?php echo esc_html($cat->name); ?></a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <div class="row g-4">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', 'news-card'); ?>
                <?php endwhile; ?>
            </div>

            <nav class="mt-5 d-flex justify-content-center" aria-label="ページネーション">
                <?php
                the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => '<i class="bi bi-chevron-left"></i>',
                    'next_text' => '<i class="bi bi-chevron-right"></i>',
                ]);
                ?>
            </nav>
        <?php else : ?>
            <p class="text-center text-secondary py-5">該当するお知らせはありません。</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="btn btn-outline-dark rounded-pill px-4">お知らせ一覧に戻る</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
