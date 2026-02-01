import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

// Global Uppercase Transformation for inputs (Excluded on Login Page)
document.addEventListener('input', (event) => {
    if (document.body.classList.contains('login-page')) return;

    if (event.target.tagName === 'INPUT' && (event.target.type === 'text' || event.target.type === 'search') || event.target.tagName === 'TEXTAREA') {
        const start = event.target.selectionStart;
        const end = event.target.selectionEnd;
        event.target.value = event.target.value.toUpperCase();
        event.target.setSelectionRange(start, end);
    }
});
