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

// Ultimate background handler
messaging.onBackgroundMessage((payload) => {
    console.log('SW received message:', payload);

    // Fallback values if notification object is missing
    const title = payload.notification?.title || payload.data?.title || "New Notification";
    const body = payload.notification?.body || payload.data?.body || "Click to view details";
    const image = payload.notification?.image || payload.data?.image || null;

    const notificationOptions = {
        body: body,
        icon: 'https://cdn-icons-png.flaticon.com/512/3119/3119338.png', // Fallback icon
        image: image,
        badge: 'https://cdn-icons-png.flaticon.com/512/3119/3119338.png',
        data: {
            url: payload.data?.link || payload.notification?.click_action || '/'
        },
        tag: 'fcm-notification-' + Date.now(), // Unique tag to prevent grouping
        requireInteraction: true // Keeps notification visible until clicked
    };

    return self.registration.showNotification(title, notificationOptions);
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    const urlToOpen = event.notification.data.url;

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (clientList) {
            for (let client of clientList) {
                if (client.url === urlToOpen && 'focus' in client) return client.focus();
            }
            if (clients.openWindow) return clients.openWindow(urlToOpen);
        })
    );
});
