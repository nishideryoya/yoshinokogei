<!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
    <meta charset="<? bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? wp_head(); ?>
</head>
<body <? body_class(); ?>>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="<? echo esc_url(home_url('/')); ?>">
                    吉野工芸の里
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#">施設案内</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">工芸体験</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">アクセス</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>