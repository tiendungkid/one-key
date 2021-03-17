const [logo, formLayout, button, spinner] = [$(`img[alt=logo]`), $(`form`), $(`button`), $(`img[alt=spinner]`)];
button.on('click', function () {
    formLayout.fadeOut();
    logo.fadeOut();
    spinner.fadeIn(2.5e3);
    setTimeout(function () {
        formLayout.submit();
    }, 3e3);
});
