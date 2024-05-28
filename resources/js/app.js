import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';


import.meta.glob([
    '../img/**'
])

// MODALE ORDINI

document.addEventListener('DOMContentLoaded', function() {
    // Nascondi tutti i modali all'avvio della pagina
    let modals = document.querySelectorAll('.order_modal');
    modals.forEach(function(modal) {
        modal.style.display = 'none';
    });

    // Evento di clic sull'occhio per mostrare il modale corrispondente
    let eyeIcons = document.querySelectorAll('.eye-icon');
    eyeIcons.forEach(function(icon) {
        icon.addEventListener('click', function() {
            let orderId = this.id.split('-')[2]; 
            var modal = document.getElementById('orderDetailsModal-' + orderId);
            modal.style.display = 'flex'; // Mostra il modale corrispondente
        });
    });

    // Chiusura modale quando l'utente clicca fuori dal modale o sul pulsante di chiusura
    let closeButtons = document.querySelectorAll('.close-order');
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var modal = this.closest('.order_modal');
            modal.style.display = 'none'; // Nascondi il modale corrente
        });
    });

    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('order_modal')) {
            event.target.style.display = 'none'; // Nascondi il modale se l'utente clicca fuori
        }
    });
});

// document.addEventListener('DOMContentLoaded', function() {
//     // Nascondi tutti i modali all'avvio della pagina
//     let modals = document.querySelectorAll('.order_modal');
//     modals.forEach(function(modal) {
//         modal.style.display = 'none';
//     });

//     // Evento di clic sull'occhio per mostrare il modale corrispondente
//     let eyeIcons = document.querySelectorAll('.eye-icon');
//     eyeIcons.forEach(function(icon) {
//         icon.addEventListener('click', function() {
//             let orderId = this.id.split('-')[2]; 
//             var modal = document.getElementById('orderDetailsModal-' + orderId);
//             modal.style.display = 'flex'; // Mostra il modale corrispondente
//         });
//     });

//     // Chiusura modale quando l'utente clicca fuori dal modale o sul pulsante di chiusura
//     let closeButtons = document.querySelectorAll('.close-order');
//     closeButtons.forEach(function(button) {
//         button.addEventListener('click', function() {
//             var modal = this.closest('.order_modal');
//             modal.style.display = 'none'; // Nascondi il modale corrente
//         });
//     });

//     window.addEventListener('click', function(event) {
//         let modals = document.querySelectorAll('.order_modal');
//         modals.forEach(function(modal) {
//             if (modal.style.display === 'flex' && !modal.contains(event.target)) {
//                 modal.style.display = 'none'; // Nascondi il modale se l'utente clicca fuori
//             }
//         });
//     });
// });

