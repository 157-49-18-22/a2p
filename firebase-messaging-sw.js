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

// Aggressive Background Handler (Always show notification)
messaging.onBackgroundMessage((payload) => {

    const notificationTitle = payload.notification?.title || payload.data?.title || "RealTech Update";
    const notificationOptions = {
        body: payload.notification?.body || payload.data?.body || "Click to view full details",
        icon: 'assets/images/resources/logo-1.png',
        image: payload.notification?.image || payload.data?.image || null,
        badge: 'assets/images/resources/logo-1.png',
        tag: 'a2p-realtech-notif', // THIS PREVENTS DUPLICATES
        data: {
            url: payload.data?.link || '/'
        },
        requireInteraction: true,
        vibrate: [200, 100, 200]
    };

    return self.registration.showNotification(notificationTitle, notificationOptions);
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
