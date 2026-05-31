(function () {
    const map = document.getElementById('village-map');
    const grid = document.getElementById('map-spot-grid');
    if (!map || !grid) return;

    const pins = map.querySelectorAll('.map-pin');
    const cards = grid.querySelectorAll('.map-spot-card');

    const clearActive = () => {
        pins.forEach((el) => el.classList.remove('is-active'));
        cards.forEach((el) => el.classList.remove('is-active'));
    };

    const activate = (id) => {
        if (!id) return;
        clearActive();
        const pin = map.querySelector('.map-pin[data-spot-id="' + id + '"]');
        const card = grid.querySelector('.map-spot-card[data-spot-id="' + id + '"]');
        if (pin) pin.classList.add('is-active');
        if (card) card.classList.add('is-active');
    };

    pins.forEach((pin) => {
        pin.addEventListener('mouseenter', () => activate(pin.getAttribute('data-spot-id')));
        pin.addEventListener('focus', () => activate(pin.getAttribute('data-spot-id')));
    });

    cards.forEach((card) => {
        card.addEventListener('mouseenter', () => activate(card.getAttribute('data-spot-id')));
        card.addEventListener('focus', () => activate(card.getAttribute('data-spot-id')));
    });

    map.addEventListener('mouseleave', clearActive);
    grid.addEventListener('mouseleave', clearActive);
})();
