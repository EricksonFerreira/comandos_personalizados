function alertConfirm(title, text, icon, confirmText, cancelText, confirmCallback, cancelCallback = () => {}) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            confirmCallback();
        } else if (result.isDismissed) {
            cancelCallback();
        }
    });
}
