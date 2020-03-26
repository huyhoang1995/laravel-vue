importScripts('https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.12.0/firebase-messaging.js');

firebase.initializeApp({
  apiKey: "AIzaSyB1BkM5qMRqqDlKSsvSZ-gXIwjfry45018",
  authDomain: "callkeep-a0cea.firebaseapp.com",
  databaseURL: "https://callkeep-a0cea.firebaseio.com",
  projectId: "callkeep-a0cea",
  storageBucket: "callkeep-a0cea.appspot.com",
  messagingSenderId: "946243652799",
  appId: "1:946243652799:web:6e15884c9369eeb7cc0a0a",
  measurementId: "G-JHJ0W68LJ2",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
// //     // alert(1234)
// //     console.log('[firebase-messaging-sw.js] Received background message ', payload);
// //     // Customize notification here
// //     var notificationTitle = 'Background Message Title';
// //     var notificationOptions = {
// //       body: 'Background Message body.',
// //     };
  
// //     return self.registration.showNotification(notificationTitle,
// //       notificationOptions);
  });