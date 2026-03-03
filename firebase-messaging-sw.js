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

// Ultimate background handler - THIS SHOWS THE WINDOWS/ANDROID TOAST
messaging.onBackgroundMessage((payload) => {
    console.log('[SW] Background Message Received:', payload);

    const title = payload.notification?.title || payload.data?.title || "Real Estate Update";
    const body = payload.notification?.body || payload.data?.body || "New property or update available.";
    const image = payload.notification?.image || payload.data?.image || null;

    const notificationOptions = {
        body: body,
        icon: 'https://cdn-icons-png.flaticon.com/512/3119/3119338.png',
        image: image,
        badge: 'https://cdn-icons-png.flaticon.com/512/3119/3119338.png',
        data: {
            url: payload.data?.link || payload.notification?.click_action || '/'
        },
        tag: 'property-update-' + Date.now(),
        requireInteraction: true // This keeps it in the notification panel until dismissed
    };

    return self.registration.showNotification(title, notificationOptions);
});

// Click handler to open the link
self.addEventListener('notificationclick', function (event) {
    console.log('[SW] Notification Clicked:', event.notification.tag);
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
