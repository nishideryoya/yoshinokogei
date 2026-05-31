<?php
/**
 * イラスト風マップ（SVG背景 + クリック可能ピン）
 */
$spots = isset($args['spots']) ? $args['spots'] : yoshino_get_facilities();
if (empty($spots)) {
    return;
}

$map_svg = get_stylesheet_directory_uri() . '/assets/images/village-map.svg';
?>
<div class="village-map" id="village-map">
    <div class="village-map__canvas">
        <img
            class="village-map__bg"
            src="<?php echo esc_url($map_svg); ?>"
            alt="吉野工芸の里 園内イラストマップ"
            width="1000"
            height="620"
            decoding="async"
        />

        <?php foreach ($spots as $spot) : ?>
            <a
                href="<?php echo esc_url($spot['url']); ?>"
                class="map-pin map-pin--<?php echo esc_attr($spot['color']); ?>"
                style="left: <?php echo esc_attr($spot['x']); ?>%; top: <?php echo esc_attr($spot['y']); ?>%;"
                data-spot-id="<?php echo esc_attr($spot['id']); ?>"
                title="<?php echo esc_attr($spot['title']); ?>"
                aria-label="<?php echo esc_attr($spot['title']); ?>"
            >
                <span class="map-pin__icon"><i class="bi bi-<?php echo esc_attr($spot['icon']); ?>"></i></span>
            </a>
        <?php endforeach; ?>
    </div>
</div>
