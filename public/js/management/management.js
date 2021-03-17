$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function notifyAdmin(type, message, duration = 2000, allow_dismiss = false) {
    $.notify({
        message: message
    }, {
        type: type,
        placement: {
            from: "top",
            align: "right"
        },
        allow_dismiss: allow_dismiss,
        delay: duration,
        animate: {
            enter: 'animate__animated animate__fadeInDown',
            exit: 'animate__animated animate__fadeOutUp'
        }
    });
}

function showProgressBar(visible = true) {
    visible ? $(`.ok-progress`).fadeIn() : $(`.ok-progress`).fadeOut();
}
