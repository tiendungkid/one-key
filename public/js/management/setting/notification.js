let updating = false;

function checkboxOnClick(cb) {
    let changeType = cb.id;
    let switcher = cb.checked;
    changeNotification(changeType, switcher);
}

function changeNotification(changeType, switcher) {
    if (!updating) {
        updating = true;
        showProgressBar(true);
        disableCheckbox(changeType);
        setTimeout(() => {
            updating = false;
            showProgressBar(false);
            disableCheckbox();
            notifyUpdateStatus(true);
        }, 5000);
    }
}

function disableCheckbox() {
    let checkbox = $("input[type='checkbox']");
    if (updating) {
        checkbox.prop('disabled', true);
    } else {
        checkbox.prop('disabled', false);
    }
}

function notifyUpdateStatus(status) {
    if (status) {
        $.notify({
            message: 'Update success, notification has been updated',
            icon: 'far fa-check-circle'
        }, {
            allow_dismiss: false,
            delay: 2000,
            placement: {
                align: "center"
            },
            type: 'success',
            animate: {
                enter: 'animate__animated animate__flipInX',
                exit: 'animate__animated animate__flipOutX'
            }
        });
    } else {
        $.notify({
            message: 'Update failed, please try again later',
            icon: 'fas fa-exclamation'
        }, {
            delay: 2000,
            placement: {
                align: "center"
            },
            allow_dismiss: false,
            type: 'danger',
            animate: {
                enter: 'animate__animated animate__flipInX',
                exit: 'animate__animated animate__flipOutX'
            }
        });
    }
}
