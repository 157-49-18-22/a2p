// Basic Right-Click and Image Protection (No Blackout)
(function() {
    // 1. Disable Right Click on entire website
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // 2. Override Clipboard (Copies URL instead of content)
    document.addEventListener('copy', function(e) {
        e.clipboardData.setData('text/plain', window.location.href);
        e.preventDefault();
        alert("Content protection active. Only website URL copied.");
    });

    // 3. Disable Image Dragging
    document.addEventListener('dragstart', function(e) {
        if (e.target.nodeName === 'IMG') {
            e.preventDefault();
        }
    });

    // 3. Dynamic Watermark Overlay (Centered)
    const watermark = document.createElement('div');
    watermark.id = 'site-watermark';
    watermark.style.position = 'fixed';
    watermark.style.top = '50%';
    watermark.style.left = '50%';
    watermark.style.transform = 'translate(-50%, -50%) rotate(-30deg)';
    watermark.style.opacity = '0.07'; // Very faint, adjust if needed
    watermark.style.fontSize = '8vw';
    watermark.style.fontWeight = 'bold';
    watermark.style.color = 'black';
    watermark.style.pointerEvents = 'none'; // So users can't click it
    watermark.style.zIndex = '999999';
    watermark.style.whiteSpace = 'nowrap';
    watermark.style.userSelect = 'none';
    watermark.innerText = 'A2P REALTECH PRIVATE LIMITED';
    document.body.appendChild(watermark);

    // 4. CSS to disable user-selection and image-dragging
    const style = document.createElement('style');
    style.innerHTML = `
        img {
            -webkit-user-drag: none;
            user-drag: none;
            -webkit-touch-callout: none;
        }
        body {
            -webkit-user-select: none;
            user-select: none;
        }
    `;
    document.head.appendChild(style);
})();
