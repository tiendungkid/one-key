/**
 * @Declaration variable
 * @Description init selector
 */
let [processing, liveSearchCurrent] = [false, ""];
const [serviceDetailModal, serviceDetailClose, serviceDetailSaveButton, serviceDetailSaveText, serviceDetailSaving, serviceDetailDelete, serviceDetailTag] = [$(`#service-detail-modal`), $(`#service-detail-close`), $(`#service-detail-save`), $(`#service-detail-save-text`), $(`#service-detail-saving`), $(`#service-detail-delete`), $(`#service-detail-link`)];
const [serviceDetailId, serviceDetailMainName, serviceDetailName, serviceDetailHomeLink, serviceDetailLogoLink, serviceDetailDescription, serviceDetailImage] = [$(`#service-detail-id`), $(`#service-detail-main-name`), $(`#service-detail-name`), $(`#service-detail-home-link`), $(`#service-detail-logo-link`), $(`#service-detail-description`), $(`#service-detail-img`)];
const [serviceDetailDeleteCard, serviceDetailConfirm] = [$(`#service-detail-delete-card`), $(`#service-detail-confirm`)];
const [addServiceModal, closeModalButton] = [$(`#add-service-modal`), $(`#add-service-close`)];
const [inputServiceName, inputServiceHome, inputServiceLogo, inputServiceDescription] = [$(`#add-service-name`), $(`#add-service-home-link`), $(`#add-service-logo-link`), $(`#add-service-description`)];
const [saveNewServiceButton, saveNewServiceButtonText, saveNewServiceSaving] = [$(`#add-service-save`), $(`#add-service-save-text`), $(`#add-service-saving`)];
const [storeServiceLink, searchServiceLink, findServiceLink, updateServiceLink, deleteServiceLink, serviceDetailLink] = [$(`meta[name=store-link]`).attr('content'), $(`meta[name=live-search-service-link]`).attr('content'), $(`meta[name=find-service-link]`).attr('content'), $(`meta[name=update-service-link]`).attr('content'), $(`meta[name=delete-service-link]`).attr('content'), $(`meta[name=service-detail-link]`).attr('content').replace('0', '')];
const [searchBox, serviceList, placeholderService] = [$(`#search-service`), $(`#service-list`), $(`#service-info-placeholder`)];
/**
 * @Function
 * @Description
 */
const delay = (callback, ms) => {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
};
const visibilitySavingService = (visibleLoader = false) => {
    if (visibleLoader) {
        [inputServiceName, inputServiceHome, inputServiceLogo, inputServiceDescription].forEach(e => e.prop("disabled", true));
        saveNewServiceButtonText.addClass('d-none');
        saveNewServiceSaving.removeClass('d-none');
        [serviceDetailName, serviceDetailHomeLink, serviceDetailLogoLink, serviceDetailDescription].forEach(e => e.prop("disabled", true));
        serviceDetailSaveText.addClass('d-none');
        serviceDetailSaving.removeClass('d-none');
    } else {
        [inputServiceName, inputServiceHome, inputServiceLogo, inputServiceDescription].forEach(e => e.prop("disabled", false));
        saveNewServiceButtonText.removeClass('d-none');
        saveNewServiceSaving.addClass('d-none');
        [serviceDetailName, serviceDetailHomeLink, serviceDetailLogoLink, serviceDetailDescription].forEach(e => e.prop("disabled", false));
        serviceDetailSaving.addClass('d-none');
        serviceDetailSaveText.removeClass('d-none');
    }
};
const serviceCardGenerator = (services = []) => {
    serviceList.empty();
    serviceList.append(services.map(service => `<div class="service-card col-xl-3 col-lg-4 col-sm-6" data-id="${service['hashId']}"><div class="service-inner"><div class="service-logo">${service['name'].charAt(0).toUpperCase()}${service['name'].substring(1, service['name'].length)}</div><div class="service-info"><div class="row"><div class="col-md-12"><div class="service-count"><div class="count">${service['accounts_count']}</div></div><a href="${service['home_link']}">${service['home_link']}</a></div></div></div></div></div>`));
};
const liveSearchService = (query = "") => {
    if (!processing) {
        liveSearchCurrent = query;
        visibleSearching(true);
        $.ajax(searchServiceLink, {
            dataType: "json",
            data: {query: query},
            success: function (data) {
                if (data['status']) serviceCardGenerator(data['data']);
            },
            complete: () => {
                setTimeout(function () {
                    visibleSearching(false);
                }, 1e3);
            }
        });
    }
};
const serviceDetailGenerator = (service) => {
    serviceDetailId.val(service['hashId']);
    serviceDetailName.val(service['name']);
    serviceDetailHomeLink.val(service['home_link']);
    serviceDetailLogoLink.val(service['logo_link']);
    serviceDetailDescription.val(service['description']);
    serviceDetailDeleteCard.addClass('d-none');
    serviceDetailConfirm.val('');
    serviceDetailConfirm.prop("disabled", false);
    serviceDetailTag.attr('href', `${serviceDetailLink}${service['hashId']}`);
    service['home_link'] ? serviceDetailMainName.html(`<a href="${service['home_link'].includes('http') ? service['home_link'] : ("//" + service['home_link'])}" target="_blank">${service['name']}</a>`) : serviceDetailMainName.text(service['name']);
    service['logo_link'] ? serviceDetailImage.attr('src', service['logo_link']).removeClass('d-none') : serviceDetailImage.addClass('d-none');
    serviceDetailDelete.html(`<i class="fas fa-trash"></i>`);
    serviceDetailModal.modal("show");
};
const deleteService = () => {
    if (!processing) {
        processing = true;
        $.ajax(deleteServiceLink, {
            method: "post",
            dataType: "json",
            data: {id: serviceDetailId.val()},
            success: (response) => {
                (response['status']) ?
                    notifyAdmin('success', 'Deleted service !') :
                    notifyAdmin('danger', 'Delete service failed !');
            },
            complete: () => {
                processing = false;
                liveSearchService();
                serviceDetailClose.trigger("click");
            }
        })
    }
};
const visibleSearching = (visible = false) => {
    if (visible) {
        serviceList.hide();
        placeholderService.removeClass('d-none');
    } else {
        placeholderService.addClass('d-none');
        serviceList.fadeIn();
    }
};
/**
 * @Event
 * @Description Click + keyup
 */
closeModalButton.on("click", () => {
    addServiceModal.modal("hide");
});
serviceDetailClose.on("click", () => {
    serviceDetailModal.children().removeClass('animate__backInUp').addClass('animate__bounceOutDown');
    setTimeout(() => {
        serviceDetailModal.modal("hide");
        serviceDetailModal.children().removeClass('animate__bounceOutDown').addClass('animate__backInUp');
    }, 500);
});
saveNewServiceButton.on("click", () => {
    if (!processing) {
        processing = true;
        visibilitySavingService(true);
        let [serviceName, serviceLink, serviceLogo, serviceDescription] = [inputServiceName, inputServiceHome, inputServiceLogo, inputServiceDescription].map(item => item.val());
        $.ajax(storeServiceLink, {
            method: "post",
            dataType: "json",
            data: {
                name: serviceName,
                home_link: serviceLink,
                logo_link: serviceLogo,
                description: serviceDescription
            },
            success: (data) => {
                data['status'] ? notifyAdmin('success', 'Add new service successfully !') : notifyAdmin('danger', 'Add new service failed !');
            },
            complete: () => {
                processing = false;
                visibilitySavingService();
                closeModalButton.trigger("click");
                liveSearchService();
            }
        });
    }
});
serviceDetailSaveButton.on("click", () => {
    if (!processing) {
        processing = true;
        visibilitySavingService(true);
        let [serviceId, serviceName, serviceLink, serviceLogo, serviceDescription] = [serviceDetailId, serviceDetailName, serviceDetailHomeLink, serviceDetailLogoLink, serviceDetailDescription].map(item => item.val());
        $.ajax(updateServiceLink, {
            method: "post",
            dataType: "json",
            data: {
                id: serviceId,
                name: serviceName,
                home_link: serviceLink,
                logo_link: serviceLogo,
                description: serviceDescription
            },
            success: (data) => {
                data['status'] ? notifyAdmin('success', 'Update service successfully !') : notifyAdmin('danger', 'Update service failed !');
            },
            complete: () => {
                processing = false;
                visibilitySavingService();
                serviceDetailClose.trigger("click");
                liveSearchService();
            }
        });
    }
});
searchBox.keyup(delay(function () {
    let _query = $(this).val();
    if (_query !== liveSearchCurrent) {
        liveSearchCurrent = _query;
        if (_query?.length !== 0) liveSearchService(_query);
    }
}, 500));
serviceDetailDelete.on("click", () => {
    if (serviceDetailDeleteCard.hasClass('d-none')) {
        serviceDetailDeleteCard.removeClass('d-none');
    } else {
        if (serviceDetailConfirm.val() === serviceDetailMainName.text().toLowerCase()) {
            serviceDetailConfirm.removeClass('text-red');
            serviceDetailConfirm.prop("disabled", true);
            serviceDetailDelete.text('Deleting...');
            deleteService();
        } else serviceDetailConfirm.addClass('text-red');
    }
});
$(document).on('click', '.service-card', function (e) {
    e.preventDefault();
    if (!processing) {
        processing = true;
        let cardService = $(this);
        let serviceId = $(this).attr('data-id');
        cardService.children().children().first().addClass('animate__animated animate__infinite animate__flash text-danger');
        $.ajax(findServiceLink, {
            dataType: "json",
            data: {id: serviceId},
            success: (result) => {
                result['status'] ?
                    serviceDetailGenerator(result['data']) :
                    notifyAdmin('warning', 'Get service detail failed, Please try again !');
            },
            error: () => {
                notifyAdmin('danger', 'Get service detail failed, Please try again !');
            },
            complete: function () {
                processing = false;
                cardService.children().children().first().removeClass('animate__animated animate__infinite animate__flash text-danger');
            }
        });
    }
});
