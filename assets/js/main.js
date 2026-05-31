const initSwiper = () => {
    const el = document.querySelector('.facility-swiper');
    if (el) {
        const swiper = new Swiper('.facility-swiper', {
            slidesPerView: 4,      // 常に4枚表示
            spaceBetween: 20,      // カード間の隙間
            loop: true,            // 無限ループ
            speed: 600,            // スライドの速度（0.6秒）
            autoplay: {
                delay: 3000,       // 3秒ごとに切り替え
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 4 }
            }
        });
        console.log("Swiper has started!"); // 動いているか確認用
    }
};

// ページの読み込み完了を待って実行
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSwiper);
} else {
    initSwiper();
}