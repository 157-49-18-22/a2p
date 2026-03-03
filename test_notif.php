<!DOCTYPE html>
<html>
<head>
    <title>FCM Local Panel Test</title>
    <style>
        body { font-family: sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; background: #f0f2f5; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; }
        button { background: #c00415; color: white; border: none; padding: 15px 30px; font-size: 18px; border-radius: 8px; cursor: pointer; transition: 0.3s; }
        button:hover { background: #a00312; transform: scale(1.05); }
        .status { margin-top: 20px; color: #666; }
    </style>
</head>
<body>

<div class="card">
    <h2>🔔 Panel Notification Test</h2>
    <p>Is button ko dabane ke baad browser minimize karein.<br>Agar setup sahi hai, toh 3 second mein notification aayega.</p>
    <button onclick="triggerLocalTest()">TEST NOTIFICATION NOW</button>
    <div class="status" id="status">Status: Ready to test</div>
</div>

<script>
    async function triggerLocalTest() {
        const status = document.getElementById('status');
        
        // 1. Request Permission
        status.innerText = "Requesting permission...";
        const permission = await Notification.requestPermission();
        
        if (permission !== 'granted') {
            status.innerText = "Error: Permission Denied! Please allow notifications.";
            return;
        }

        // 2. Wait 3 seconds so you can minimize
        status.innerText = "Minimize now! Sending in 3 seconds...";
        
        setTimeout(async () => {
            const registration = await navigator.serviceWorker.getRegistration();
            
            if (registration) {
                registration.showNotification("A2P RealTech Test", {
                    body: "Bhai, agar ye dikh raha hai toh panel setup perfect hai! ✅",
                    icon: 'https://cdn-icons-png.flaticon.com/512/3119/3119338.png',
                    requireInteraction: true,
                    vibrate: [200, 100, 200]
                });
                status.innerText = "Command Sent! Check your panel.";
            } else {
                status.innerText = "Error: Service Worker not found. Please refresh main site first.";
            }
        }, 3000);
    }
</script>

</body>
</html>
