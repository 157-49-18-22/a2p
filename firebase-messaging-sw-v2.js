importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging-compat.js');

const firebaseConfig = {
    apiKey: "AIzaSyCUpT22o_EQV4uuyOn84zawWemlWqzmsOA",
    authDomain: "a2p-realtech-29ced.firebaseapp.com",
    projectId: "a2p-realtech-29ced",
    storageBucket: "a2p-realtech-29ced.firebasestorage.app",
    messagingSenderId: "796136362818",
    appId: "1:796136362818:web:37d0a918debf7ce7a5aedb",
    measurementId: "G-DYGC70ZNSK"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

// GURANTEED ONE NOTIFICATION LOGIC (A2P Branded)
messaging.onBackgroundMessage((payload) => {
    // USE HIGH-RES SQUARE LOGO FROM FAVICONS (BETTER FOR PUSH)
    const absoluteLogo = 'https://pink-sheep-796549.hostingersite.com/assets/images/favicons/android-chrome-192x192.png';

    const title = payload.data?.title || payload.notification?.title || "A2P RealTech";
    const body = payload.data?.body || payload.notification?.body || "Click to see details";

    const options = {
        body: body,
        icon: absoluteLogo, // This shows as the main image in small UI
        badge: absoluteLogo, // This shows in the status bar on Android
        tag: 'a2p-branded-push',
        renotify: false,
        requireInteraction: true,
        vibrate: [200, 100, 200],
        data: {
            url: payload.data?.link || '/'
        }
    };

    return self.registration.showNotification(title, options);
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
