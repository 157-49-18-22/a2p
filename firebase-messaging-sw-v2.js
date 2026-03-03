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

// FINAL LOGO FIX - USE FAVICON.ICO AS PRIMARY LOGO (ABSOLUTE URL)
messaging.onBackgroundMessage((payload) => {
    const title = payload.data?.title || payload.notification?.title || "A2P RealTech";
    const body = payload.data?.body || payload.notification?.body || "Click to see details";

    // Absolute path to the favicon being used in Chatbot/Main site
    const faviconUrl = 'https://pink-sheep-796549.hostingersite.com/assets/images/favicons/favicon.ico';
    const highResUrl = 'https://pink-sheep-796549.hostingersite.com/assets/images/favicons/android-chrome-192x192.png';

    const options = {
        body: body,
        icon: highResUrl, // Large square icon for branding
        badge: faviconUrl, // Status bar icon
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
