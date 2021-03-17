let requesting = false;
const [inputAvatar, inputBackdrop, avatarModal, backdropModal, userAvatar, userBackdrop] = [$("#input-avatar"), $("#input-backdrop"), $("#avatar-modal"), $("#backdrop-modal"), $("#user-avatar"), $("#user-backdrop")];
const [uploadAvatarButton, uploadBackdropButton, bigBackdrop, avatarLightBox, backdropLightBox] = [$("#upload-avatar-button"), $("#upload-backdrop-button"), $("#big-backdrop"), $("#avatar-light-box"), $("#backdrop-light-box")];
const avatarCroppie = $('#avatar-image-container').croppie({
    enableExif: true,
    viewport: {
        width: 250,
        height: 250,
        type: "circle"
    },
    boundary: {
        width: 300,
        height: 300
    }
});
const backdropCroppie = $('#backdrop-image-container').croppie({
    enableExif: true,
    viewport: {
        width: 300,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});
const cropAvatarSuccess = (result, button) => {
    if (!requesting) {
        requesting = true;
        showProgressBar();
        $.ajax('upload-avatar', {
            method: 'post',
            dataType: 'json',
            data: {image: result},
            success: (resultCode) => {
                avatarModal.modal('hide');
                if (resultCode.code === 1) {
                    userAvatar.attr('src', result);
                    avatarLightBox.attr('href', result);
                }
            },
            error: () => avatarModal.modal('hide'),
            complete: () => {
                disableUploadButton(button, false);
                showProgressBar(false);
                requesting = false;
            }
        });
    }
};
const cropBackdropSuccess = (result, button) => {
    if (!requesting) {
        requesting = true;
        showProgressBar();
        $.ajax('upload-backdrop', {
            method: 'post',
            dataType: 'json',
            data: {image: result},
            success: (resultCode) => {
                backdropModal.modal('hide');
                if (resultCode.code === 1) {
                    userBackdrop.attr('src', result);
                    bigBackdrop.css('background-image', `url('${result}')`);
                    backdropLightBox.attr('href', result);
                }
            },
            error: () => backdropModal.modal('hide'),
            complete: () => {
                disableUploadButton(button, false);
                showProgressBar(false);
                requesting = false;
            }
        });
    }
};
const disableUploadButton = (button, disable = true) => {
    if (disable) {
        button.prop('disabled', true);
        button.text("Uploading ...");
    } else {
        button.prop('disabled', false);
        button.text("Upload");
    }

};
inputAvatar.on('change', (e) => {
    if (!requesting) {
        if (window.FileReader) {
            let reader = new FileReader();
            let file = e.target.files[0];
            if (file) {
                if (file.type.match("image.*")) {
                    if (file.size < 1048576) {
                        reader.readAsDataURL(file);
                        reader.onloadend = (e) => {
                            avatarModal.modal("show");
                            setTimeout(() => {
                                avatarCroppie.croppie('bind', {url: reader.result});
                            }, 500);
                        };
                    } else {
                        alert('The size of the image must be less than 1MB !');
                    }
                } else {
                    alert('Support image file only !');
                }
            }
        }
    }
});
inputBackdrop.on('change', (e) => {
    if (!requesting) {
        if (window.FileReader) {
            let reader = new FileReader();
            let file = e.target.files[0];
            if (file) {
                if (file.type.match("image.*")) {
                    if (file.size < 10485760) {
                        reader.readAsDataURL(file);
                        reader.onloadend = (e) => {
                            backdropModal.modal("show");
                            setTimeout(() => {
                                backdropCroppie.croppie('bind', {url: reader.result});
                            }, 500);
                        };
                    } else {
                        alert('The size of the image must be less than 10MB !');
                    }
                } else {
                    alert('Support image file only !');
                }
            }
        }
    }
});
uploadAvatarButton.on('click', function () {
    let button = $(this);
    disableUploadButton(button, true);
    avatarCroppie.croppie('result', {
        size: {
            width: 500,
            height: 500
        },
        circle: true,
        format: "png"
    }).then(result => cropAvatarSuccess(result, button));
});
uploadBackdropButton.on('click', function () {
    let button = $(this);
    disableUploadButton(button, true);
    backdropCroppie.croppie('result', {
        size: {
            width: 1848,
            height: 1248
        },
        format: "png"
    }).then(result => cropBackdropSuccess(result, button));
});
