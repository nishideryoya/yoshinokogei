<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="sticky-top bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <a href="<?php echo home_url(); ?>" class="navbar-brand">
            <h1 class="h4 mb-0 fw-bold text-dark">吉野工芸の里</h1>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="<?php echo esc_url(yoshino_guide_page_url()); ?>" class="text-decoration-none text-secondary small d-flex align-items-center">
                <i class="bi bi-info-circle me-1"></i>ご利用の案内
            </a>
            <a href="<?php echo esc_url(yoshino_guide_page_url() . '#access'); ?>" class="text-decoration-none text-secondary small d-flex align-items-center">
                <i class="bi bi-geo-alt me-1"></i>アクセス
            </a>
        </div>
    </div>

    <nav class="border-top overflow-x-auto">
    <div class="container">
        <ul class="nav nav-justified text-nowrap py-2">
            <li class="nav-item">
                <a href="<?php echo esc_url(yoshino_taiken_page_url()); ?>" class="nav-link text-dark px-2">
                    <i class="bi bi-ticket-perforated d-block h4 mb-1 text-success"></i>
                    <span class="small fw-bold text-dark">体験教室</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo esc_url(yoshino_news_archive_url()); ?>" class="nav-link text-dark px-2">
                    <i class="bi bi-calendar-event d-block h4 mb-1 text-primary"></i>
                    <span class="small fw-bold text-dark">開催情報</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo esc_url(yoshino_map_page_url()); ?>" class="nav-link text-dark px-2">
                    <i class="bi bi-map d-block h4 mb-1 text-warning"></i>
                    <span class="small fw-bold text-dark">全体マップ</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo get_post_type_archive_link('sakka'); ?>" class="nav-link text-dark px-2">
                    <i class="bi bi-palette d-block h4 mb-1 text-info"></i>
                    <span class="small fw-bold text-dark">作家紹介</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
    
    <div class="bg-dark text-white text-center py-1 small fw-bold">
        年中無休（火曜休館） | 10:00〜17:00
    </div>
</header>