<?php get_header(); ?>
<main class="py-5 bg-white">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>" class="text-secondary text-decoration-none">TOP</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('sakka'); ?>" class="text-secondary text-decoration-none">作家紹介</a></li>
                <li class="breadcrumb-item active fw-bold" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="ratio ratio-1x1 mb-4 shadow-sm">
                        <img src="<?php echo esc_url(yoshino_sakka_avatar_image(get_the_ID())); ?>" class="object-fit-cover rounded w-100 h-100" alt="<?php the_title_attribute(); ?>">
                    </div>

                    <h1 class="h3 fw-bold mb-1"><?php the_title(); ?></h1>
                    <p class="text-secondary mb-4 small">工芸作家</p>

                    <div class="d-grid gap-2">
                        <?php if(get_field('sakka_instagram')): ?>
                        <a href="<?php the_field('sakka_instagram'); ?>" target="_blank" class="btn btn-outline-dark rounded-pill btn-sm py-2">
                            <i class="bi bi-instagram me-2"></i>Instagram
                        </a>
                        <?php endif; ?>

                        <?php if(get_field('sakka_website')): ?>
                        <a href="<?php the_field('sakka_website'); ?>" target="_blank" class="btn btn-outline-dark rounded-pill btn-sm py-2">
                            <i class="bi bi-globe me-2"></i>公式サイト
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <section class="mb-5">
                    <h2 class="h5 heading-accent">経歴・プロフィール</h2>
                    <div class="lh-lg text-secondary ps-2">
                        <?php 
                        $history = get_field('sakka_history');
                        echo $history ? $history : "経歴は現在準備中です。"; 
                        ?>
                    </div>
                </section>

                <section>
                    <h2 class="h5 heading-accent">代表的な作品</h2>
                    <div class="row g-3">
                        <?php 
                        $work_images = ['work_img_01', 'work_img_02', 'work_img_03'];
                        $has_work = false;
                        foreach($work_images as $img_field):
                            $img_url = get_field($img_field);
                            if($img_url): $has_work = true;
                        ?>
                        <div class="col-md-4 col-6">
                            <div class="ratio ratio-1x1">
                                <img src="<?php echo esc_url($img_url); ?>" class="object-fit-cover rounded shadow-sm" alt="作品">
                            </div>
                        </div>
                        <?php 
                            endif;
                        endforeach; 
                        if (!$has_work) :
                            $work_placeholders = ['facility-tenji-kan', 'facility-washi-taiken', 'facility-taiken-kobo'];
                            foreach ($work_placeholders as $work_key) :
                        ?>
                        <div class="col-md-4 col-6">
                            <div class="ratio ratio-1x1">
                                <img src="<?php echo esc_url(yoshino_img($work_key)); ?>" class="object-fit-cover rounded shadow-sm" alt="作品イメージ">
                            </div>
                        </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </section>

                <div class="mt-5 pt-5 text-center">
                    <a href="<?php echo get_post_type_archive_link('sakka'); ?>" class="text-dark fw-bold text-decoration-none border-bottom border-dark pb-1 small">
                        <i class="bi bi-arrow-left me-2"></i>作家一覧へ戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>