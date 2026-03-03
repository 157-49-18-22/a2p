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

messaging.onBackgroundMessage((payload) => {
    // BULLETPROOF ICON LOGIC: Try relative first, then absolute
    const logoRel = 'assets/images/favicons/android-chrome-192x192.png';
    const logoAbs = self.location.origin + '/assets/images/favicons/android-chrome-192x192.png';

    const title = payload.data?.title || payload.notification?.title || "A2P RealTech";
    const body = payload.data?.body || payload.notification?.body || "New Update Available";

    const options = {
        body: body,
        icon: logoAbs,
        badge: logoAbs,
        tag: 'a2p-branded-push', // Group notifications
        renotify: true,         // Allows it to pop up again even with same tag
        requireInteraction: true,
        vibrate: [200, 100, 200],
        data: {
            url: payload.data?.link || '/'
        }
    };

    // If an image was provided in data, use it
    if (payload.data?.image) {
        options.image = payload.data.image;
    }

    return self.registration.showNotification(title, options);
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
