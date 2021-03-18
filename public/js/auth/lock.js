function notifyErrorCode() {
    $.notify({
        message: 'Your password invalid !',
        icon: 'fas fa-exclamation'
    }, {
        delay: 4000,
        placement: {
            align: "right"
        },
        allow_dismiss: false,
        type: 'danger',
        animate: {
            enter: 'animate__animated animate__flipInX',
            exit: 'animate__animated animate__flipOutX'
        }
    });
}
