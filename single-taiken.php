<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<section class="page-hero py-4 text-white text-center" style="<?php echo esc_attr(yoshino_hero_image_style(get_the_ID(), 'hero-taiken')); ?>">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center small mb-3">
                <li class="breadcrumb-item"><a href="<?php echo esc_url(yoshino_taiken_page_url()); ?>" class="text-white-50 text-decoration-none">体験教室</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-0"><?php the_title(); ?></h1>
    </div>
</section>

<main class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm mb-4">
                    <img src="<?php echo esc_url(yoshino_taiken_card_image(get_the_ID())); ?>" class="object-fit-cover w-100 h-100" alt="<?php the_title_attribute(); ?>">
                </div>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm bg-light sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h2 class="h6 fw-bold mb-4 heading-accent border-0 ps-0">体験概要</h2>
                        <dl class="row small mb-4">
                            <?php
                            $details = [
                                'price'    => ['label' => '料金', 'icon' => 'bi-currency-yen'],
                                'duration' => ['label' => '所要時間', 'icon' => 'bi-clock'],
                                'capacity' => ['label' => '定員', 'icon' => 'bi-people'],
                                'target'   => ['label' => '対象', 'icon' => 'bi-person'],
                                'location' => ['label' => '場所', 'icon' => 'bi-geo-alt'],
                            ];
                            foreach ($details as $key => $detail) :
                                $val = yoshino_taiken_meta(get_the_ID(), $key);
                                if (!$val) continue;
                            ?>
                                <dt class="col-4 fw-bold text-secondary"><?php echo esc_html($detail['label']); ?></dt>
                                <dd class="col-8 mb-3"><i class="bi <?php echo esc_attr($detail['icon']); ?> me-1 text-success"></i><?php echo esc_html($val); ?></dd>
                            <?php endforeach; ?>
                        </dl>
                        <a href="<?php echo esc_url(yoshino_taiken_page_url() . '#reserve'); ?>" class="btn btn-success w-100 rounded-pill fw-bold">この体験を予約する</a>
                        <a href="<?php echo esc_url(yoshino_taiken_page_url()); ?>" class="btn btn-outline-secondary w-100 rounded-pill mt-2">一覧に戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php endwhile; ?>

<?php get_footer(); ?>
