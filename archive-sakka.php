<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'hero', [
    'title'      => '作家紹介',
    'subtitle'   => 'Artists',
    'image_key'  => 'hero-sakka',
]); ?>
<main class="py-5">
    <div class="container">
        <h2 class="h4 fw-bold mb-5 border-bottom pb-3">所属作家紹介</h2>
        <div class="row g-4">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-up text-center p-3">
                    <div class="ratio ratio-1x1 mb-3">
                        <img src="<?php echo esc_url(yoshino_sakka_avatar_image(get_the_ID())); ?>" class="rounded-circle object-fit-cover w-100 h-100" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    </div>
                    <h3 class="h6 fw-bold"><?php the_title(); ?></h3>
                    <p class="small text-secondary mb-3"><?php echo esc_html(yoshino_field('sakka_genre', get_the_ID(), '工芸作家')); ?></p>
                    <a href="<?php the_permalink(); ?>" class="stretched-link"></a>
                </div>
            </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>