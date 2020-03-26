// var siteUrl = '{!! url("/") !!}';

// 
// urlB64ToUint8Array is a magic function that will encode the base64 public key
// to Array buffer which is needed by the subscription option
const urlB64ToUint8Array = base64String => {
    const padding = '='.repeat((4 - (base64String.length % 4)) % 4)
    const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/')
    const rawData = atob(base64)
    const outputArray = new Uint8Array(rawData.length)
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i)
    }
    return outputArray
}
// saveSubscription saves the subscription to the backend
const saveSubscription = async subscription => {
    const SERVER_URL = 'http://localhost:4000/save-subscription'
    const response = await fetch(SERVER_URL, {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(subscription),
    })
    return response.json()
}
self.addEventListener('activate', async () => {
    // This will be called only once when the service worker is activated.
    try {
        const applicationServerKey = urlB64ToUint8Array(
            'BI_xwT_BB3Yx4LJpPePW2thXStg4jDffvthy2wVK1PKv_xtlKokofXacWnvCgeqnI7VlClAqorg9S6BoIVBwyPc'
        )
        const options = { applicationServerKey, userVisibleOnly: true }
        const subscription = await self.registration.pushManager.subscribe(options)
        const response = await saveSubscription(subscription)
        console.log(response)
    } catch (err) {
        console.log('Error', err)
    }
})
// lissten to push
// self.addEventListener("push", function (event) {
//     console.log(event, 'eventData');
//     console.log("Push event!! ", event.data.text());

//     console.log(event, 'event data');
//     if (event.data) {
//         console.log("Push event!! ", event.data.text());
//         showLocalNotification("Phần mềm hội nghị truyền hình", event.data.text(), self.registration);
//     } else {
//         console.log("Push event but no data");
//     }
// });

self.addEventListener('push', function (event) {
    console.log('Received a push message', event.srcElement.registration.scope);
    var body = '';

    var title = 'Phần mềm hội nghị truyền hình.';
    var status = event.data.text();
    switch (status) {
        case 'missCall':
            body = "Bạn có cuộc gọi nhỡ";
            break;

        default:
            break;
    }
    var icon = '/images/icon-192x192.png';
    var tag = 'simple-push-demo-notification-tag';
    var data = {
        scopeUrl: event.srcElement.registration.scope
    };

    event.waitUntil(
        self.registration.showNotification(title, {
            body: body,
            icon: icon,
            tag: tag,
            data: data
        })
    );
});

self.addEventListener('notificationclick', function (event) {
    console.log(event, 'dataEvent');
    // var doge = event.notification.data.doge;
    // clients.openWindow(siteUrl);
    var url = event.notification.data.scopeUrl + '?#/jitsiLogin';
    console.log(url)

    event.waitUntil(clients.openWindow(url));

});
// notify
const showLocalNotification = (title, status, swRegistration) => {
    console.log(status)
    var body = "";
    switch (status) {
        case 'missCall':
            body = "Bạn có cuộc gọi nhỡ";
            break;

        default:
            break;
    }
    const options = {
        body,
        // here you can add more properties like icon, image, vibrate, etc.
    };

    swRegistration.showNotification(title, options);

};
