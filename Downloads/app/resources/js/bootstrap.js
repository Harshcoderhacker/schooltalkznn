// Load plugins
import helper from "./helper";
import axios from "axios";
import * as Popper from "@popperjs/core";
import dom from "@left4code/tw-starter/dist/js/dom";
import Echo from 'laravel-echo';


// Set plugins globally
window.helper = helper;
window.axios = axios;
window.Popper = Popper;
window.$ = dom;
window.$ = window.jQuery = require('jquery');
window.Pusher = require('pusher-js');


// CSRF token
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}




window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});



//window.Echo = new Echo({
    // broadcaster: 'pusher',
    // key: process.env.MIX_PUSHER_APP_KEY,
    // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    // wsHost: process.env.MIX_PUSHER_HOST,
    // wsPort: 6001,
    // forceTLS: false,
    // disableStats: true,
    // scheme: process.env.MIX_PUSHER_SCHEME


    // broadcaster: "pusher",
    // key: process.env.MIX_PUSHER_APP_KEY,
    // wsHost: window.location.hostname,
    // wsPort: 6001,
    // disableStats: true,
    // forceTLS: false

    // broadcaster: "pusher",
    // key: process.env.MIX_PUSHER_APP_KEY,
    // wsHost: window.location.hostname,
    // wsPort: 6001,
    // wssPort: 6001,
    // disableStats: true,
    // enabledTransports: ['ws', 'wss'],
//});