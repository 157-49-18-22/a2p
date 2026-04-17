(function() {
    // 1. Create the Black Overlay Element
    const overlay = document.createElement('div');
    overlay.id = 'protection-overlay';
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100vw';
    overlay.style.height = '100vh';
    overlay.style.backgroundColor = 'black';
    overlay.style.display = 'none';
    overlay.style.zIndex = '9999999';
    overlay.style.color = 'white';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.flexDirection = 'column';
    overlay.style.textAlign = 'center';
    overlay.style.fontFamily = 'Arial, sans-serif';
    overlay.innerHTML = `
        <div style="padding: 20px;">
            <h1 style="font-size: 24px;">Security Alert</h1>
            <p style="font-size: 16px;">Screenshot or screen capture detected. This content is protected.</p>
        </div>
    `;
    document.body.appendChild(overlay);

    // 2. Detect Window Focus/Blur
    // Most screenshot tools cause the window to lose focus
    window.addEventListener('blur', function() {
        overlay.style.display = 'flex';
    });

    window.addEventListener('focus', function() {
        // Slight delay to ensure the screenshot tool is closed
        setTimeout(() => {
            overlay.style.display = 'none';
        }, 500);
    });

    // 3. Block Keyboard Shortcuts (PrintScreen, F12, Ctrl+Shift+I, etc.)
    document.addEventListener('keydown', function(e) {
        // Block PrintScreen
        if (e.key === 'PrintScreen' || e.keyCode === 44) {
             overlay.style.display = 'flex';
             navigator.clipboard.writeText(""); // Clear clipboard
             alert("Screenshots are disabled for security reasons.");
             e.preventDefault();
        }

        // Block Ctrl+Shift+I (DevTools)
        if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'i')) {
            e.preventDefault();
        }

        // Block Ctrl+Shift+J (DevTools)
        if (e.ctrlKey && e.shiftKey && (e.key === 'J' || e.key === 'j')) {
            e.preventDefault();
        }

        // Block Ctrl+U (View Source)
        if (e.ctrlKey && (e.key === 'U' || e.key === 'u')) {
            e.preventDefault();
        }

        // Block Ctrl+S (Save Page)
        if (e.ctrlKey && (e.key === 'S' || e.key === 's')) {
            e.preventDefault();
        }

        // Block F12
        if (e.key === 'F12') {
            e.preventDefault();
        }
    });

    // 4. Disable Right Click
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // 5. Disable Image Dragging
    document.addEventListener('dragstart', function(e) {
        if (e.target.nodeName === 'IMG') {
            e.preventDefault();
        }
    });

    // 6. Additional CSS to protect images
    const style = document.createElement('style');
    style.innerHTML = `
        img {
            -webkit-user-drag: none;
            -khtml-user-drag: none;
            -moz-user-drag: none;
            -o-user-drag: none;
            user-drag: none;
            pointer-events: none; /* Recommended for pure display images */
        }
        /* Restore pointer-events for clickable images (links) if needed */
        a img, .allow-click img {
            pointer-events: auto;
        }
    `;
    document.head.appendChild(style);

})();
