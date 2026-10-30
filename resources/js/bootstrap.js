window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

window.Swal = require('sweetalert2');

// axios se quitó el 30/10/2026: ningún código lo usaba (los buscadores usan fetch) y la versión 0.21 tenía CVE

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
