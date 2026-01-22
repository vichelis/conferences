import './bootstrap';
import moment from 'moment';

document.addEventListener('DOMContentLoaded', () => {
    const output = document.getElementById('time-output');
    if (output) {
        setInterval(() => {
            output.textContent = moment().format('MMMM Do YYYY, h:mm:ss A');
        }, 1000);
    }
});
