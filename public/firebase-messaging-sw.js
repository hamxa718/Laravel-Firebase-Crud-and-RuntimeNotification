// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyDmVP8PRrlqz-8yRr2GpEUyEF35oED6IAo",
    authDomain: "ecommerce-2f0ee.firebaseapp.com",
    databaseURL: "https://ecommerce-2f0ee-default-rtdb.firebaseio.com",
    projectId: "ecommerce-2f0ee",
    storageBucket: "ecommerce-2f0ee.appspot.com",
    messagingSenderId: "651388433361",
    appId: "1:651388433361:web:e08b9ccbadb26dd781a6f0",
    measurementId: "G-V8KMX0BHES"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});