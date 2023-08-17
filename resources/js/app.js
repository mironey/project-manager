import './bootstrap';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

document.addEventListener("DOMContentLoaded", function() {
    flatpickr("#start_date");
    flatpickr("#end_date");
    flatpickr("#due_date");
});


