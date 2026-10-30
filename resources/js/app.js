import './bootstrap';

import Alpine from 'alpinejs';

// sweetalert2 se quitó del bundle el 30/10/2026: las vistas con carteles lo cargan desde el CDN (versión fijada)

window.Alpine = Alpine;

Alpine.start();
