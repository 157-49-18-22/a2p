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

    // 2. Detect Window Focus/Blur & Visibility Change
    // Aggressive Blackout
    const enableProtection = () => overlay.style.display = 'flex';
    const disableProtection = () => {
        setTimeout(() => {
            overlay.style.display = 'none';
        }, 300);
    };

    window.addEventListener('blur', enableProtection);
    window.addEventListener('focus', disableProtection);
    
    // Detect when tab is switched or minimized (often happens with SS tools)
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            enableProtection();
        } else {
            disableProtection();
        }
    });

    // 3. Block Keyboard Shortcuts
    document.addEventListener('keydown', function(e) {
        // Block PrintScreen (for some browsers)
        if (e.key === 'PrintScreen' || e.keyCode === 44 || e.key === 'Snapshot') {
             enableProtection();
             alert("Screenshots are strictly prohibited on this platform.");
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
