// public/js/alertConfirmPequena.js
function alertConfirmPequena(title, text, icon) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showConfirmButton: false,
        position: 'top-end',
        iconHtml: `<span style="font-size: 12px;">${icon}</span>`, // Ícone pequeno
        customClass: {
            icon: 'small-icon',
            popup: icon === 'success' ? 'swal-success-bg' : icon === 'error' ? 'swal-error-bg' : ''
        },
        toast: true,
        timer: 3000,
        timerProgressBar: true
    })
}
