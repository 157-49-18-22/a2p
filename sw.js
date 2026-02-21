self.addEventListener('push', function(event) {
    const data = event.data ? event.data.json() : {};
    const title = data.title || 'A2P Realtech';
    const options = {
        body: data.body || 'New property update is here!',
        icon: 'assets/images/favicons/apple-touch-icon.png',
        badge: 'assets/images/favicons/favicon-16x16.png'
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow('/')
    );
});
