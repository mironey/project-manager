import './bootstrap';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

document.addEventListener("DOMContentLoaded", function() {
    let start_date = flatpickr("#start_date", {
        minDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            end_date.set('minDate', dateStr);
        }
    });
    let end_date = flatpickr("#end_date");
    flatpickr("#due_date");
});


