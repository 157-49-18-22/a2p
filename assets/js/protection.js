// Basic Right-Click and Image Protection (No Blackout)
(function() {
    // 1. Disable Right Click on entire website
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // 2. Disable Image Dragging (Prevents dragging to desktop/tab)
    document.addEventListener('dragstart', function(e) {
        if (e.target.nodeName === 'IMG') {
            e.preventDefault();
        }
    });

    // 3. CSS to disable user-selection and image-dragging
    const style = document.createElement('style');
    style.innerHTML = `
        img {
            -webkit-user-drag: none;
            user-drag: none;
            -webkit-touch-callout: none; /* Disables long-press menu on iOS */
        }
        body {
            -webkit-user-select: none;
            user-select: none;
        }
    `;
    document.head.appendChild(style);
})();
