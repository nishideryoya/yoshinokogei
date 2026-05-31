<?php get_header(); ?>

<main class="py-5 bg-white">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>" class="text-secondary text-decoration-none">TOP</a></li>
                <li class="breadcrumb-item"><a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="text-secondary text-decoration-none">お知らせ</a></li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>

        <article class="mx-auto" style="max-width: 900px;">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <header class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <time class="text-secondary fw-bold" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                            <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                        <?php
                        $categories = get_the_category();
                        if ($categories) :
                            foreach ($categories as $category) :
                                echo '<span class="badge rounded-pill bg-light text-dark border px-3 py-2 fw-normal">' . esc_html($category->name) . '</span>';
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <h1 class="display-6 fw-bold lh-base"><?php the_title(); ?></h1>
                </header>

                <div class="mb-5 ratio ratio-21x9 rounded overflow-hidden shadow-sm">
                    <img
                        src="<?php echo esc_url(yoshino_news_card_image(get_the_ID())); ?>"
                        alt="<?php the_title_attribute(); ?>"
                        class="object-fit-cover w-100 h-100"
                    >
                </div>

                <div class="entry-content lh-lg text-dark mb-5">
                    <?php the_content(); ?>
                </div>

                <footer class="border-top pt-5 mt-5">
                    <div class="d-flex justify-content-between">
                        <div class="prev-post">
                            <?php previous_post_link('%link', '<i class="bi bi-chevron-left me-1"></i> 前の記事', true); ?>
                        </div>
                        <div class="next-post">
                            <?php next_post_link('%link', '次の記事 <i class="bi bi-chevron-right ms-1"></i>', true); ?>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="btn btn-outline-dark rounded-pill px-5">
                            お知らせ一覧に戻る
                        </a>
                    </div>
                </footer>

            <?php endwhile; endif; ?>
        </article>
    </div>
</main>

<?php get_footer(); ?>