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

    // 4. Dynamic Watermark Overlay (Hidden by Default)
    const watermark = document.createElement('div');
    watermark.id = 'site-watermark';
    watermark.style.position = 'fixed';
    watermark.style.top = '50%';
    watermark.style.left = '50%';
    watermark.style.transform = 'translate(-50%, -50%) rotate(-30deg)';
    watermark.style.opacity = '0.3'; // Visible during screenshot attempt
    watermark.style.fontSize = '8vw';
    watermark.style.fontWeight = 'bold';
    watermark.style.color = 'black';
    watermark.style.pointerEvents = 'none';
    watermark.style.zIndex = '999999';
    watermark.style.whiteSpace = 'nowrap';
    watermark.style.display = 'none'; // Initially hidden
    watermark.innerText = 'A2P REALTECH PRIVATE LIMITED';
    document.body.appendChild(watermark);

    // 5. Smart Protection Logic (Show on Blur/Mouseout)
    const showWatermark = () => watermark.style.display = 'block';
    const hideWatermark = () => watermark.style.display = 'none';

    window.addEventListener('blur', showWatermark);
    window.addEventListener('focus', hideWatermark);
    document.addEventListener('mouseleave', showWatermark);
    document.addEventListener('mouseenter', hideWatermark);
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) showWatermark();
        else hideWatermark();
    });

    // 6. CSS to disable dragging
    const style = document.createElement('style');
    style.innerHTML = `
        img {
            -webkit-user-drag: none;
            user-drag: none;
            -webkit-touch-callout: none;
        }
    `;
    document.head.appendChild(style);
})();
