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
    watermark.style.opacity = '0.3'; // Visible during screenshot
    watermark.style.fontSize = '8vw';
    watermark.style.fontWeight = 'bold';
    watermark.style.color = '#000';
    watermark.style.pointerEvents = 'none';
    watermark.style.zIndex = '999999';
    watermark.style.whiteSpace = 'nowrap';
    watermark.style.display = 'none';
    watermark.innerText = 'A2P REALTECH PRIVATE LIMITED';
    document.body.appendChild(watermark);

    // 5. High-Speed Detection with Mouse Safety
    let isMouseInside = true;

    document.addEventListener('mouseenter', () => isMouseInside = true);
    document.addEventListener('mouseleave', () => isMouseInside = false);

    function checkProtection() {
        // Show watermark ONLY if focus is lost AND mouse is not inside
        // Or if the tab is hidden (visibilitychange)
        if ((!document.hasFocus() && !isMouseInside) || document.hidden) {
            watermark.style.display = 'block';
        } else {
            watermark.style.display = 'none';
        }
        requestAnimationFrame(checkProtection);
    }
    
    requestAnimationFrame(checkProtection);

    // Instant Response for common SS triggers
    window.onblur = () => { if(!isMouseInside) watermark.style.display = 'block'; };
    window.onfocus = () => watermark.style.display = 'none';
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
