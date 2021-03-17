class AccountInstance {

    static requesting = false;
    static currentQuery = "";

    static toggle2FaCode(context) {
        $(`#two-fa-code`).prop('disabled', !$(context).prop("checked"));
    }

    static visiblePlaceholder(visible = true) {
        visible ? placeholder.fadeIn() : placeholder.fadeOut();
    }

    static delayGetSearchValue(callback, ms) {
        var timer = 0;
        return function () {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        }
    }

    static visibleNoRecord(visible = true) {
        visible ? noRecord.removeClass('d-none') : noRecord.addClass('d-none');
    }

    static queryAccount(query) {
        this.requesting = true;
        this.removeOldAccount();
        this.visiblePlaceholder();
        AccountInstance.visibleNoRecord(false);
        $.ajax(searchLink, {
            dataType: 'json',
            data: {query: query},
            success: function (data) {
                if (data['status']) {
                    setTimeout(function () {
                        if (data['data'].length === 0) {
                            AccountInstance.visibleNoRecord(true)
                        } else {
                            AccountInstance.visibleNoRecord(false);
                            AccountInstance.appendNewAccount(data['data']);
                        }
                    }, 1000);
                }
            },
            complete: function () {
                AccountInstance.requesting = false;
                AccountInstance.visiblePlaceholder(false);
            }
        });
    }

    static capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    static removeOldAccount() {
        allAccountList.empty();
    }

    static appendNewAccount(accounts = []) {
        allAccountList.append(accounts.map(function (account) {
            return `<li class="list-group-item px-0 animate__animated animate__fadeIn">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="avatar rounded-circle"
                              style="background-color: ${account['background'] ? account['background'] : '#7cc7e6'}">
                        </span>
                    </div>
                    <div class="col ml--2">
                        <h4 class="mb-0">
                            ${account['user_name']}
                        </h4>
                        <span class="text-success">●</span>
                        <small>${AccountInstance.capitalizeFirstLetter(account['service']['name'])}</small>
                    </div>
                    <div class="col-auto">
                        <a href="${detailAccountLink}${account['hashId']}" class="btn btn-sm btn-primary" target="_blank">View</a>
                        <a href="${editAccountLink}${account['hashId']}" class="btn btn-sm btn-info" target="_blank">Edit</a>
                    </div>
                </div>
            </li>`
        }));
    }
}

const [checkBox2FA] = [$(`#enable_2fa`)];
const [placeholder, searchInput, searchLink, noRecord, allAccountList, detailAccountLink, editAccountLink] = [
    $(`#all-account-search-placeholder`), $(`#all-account-search-input`),
    $(`meta[name=search-account-link]`).attr('content'),
    $(`#all-account-search-no-record`), $(`#all-account-list`),
    $(`meta[name=view-account-link]`).attr('content')?.replace("ONE-KEY-DEFAULT", ""),
    $(`meta[name=edit-account-link]`).attr('content')?.replace("ONE-KEY-DEFAULT", ""),
];
checkBox2FA.on('change', function () {
    AccountInstance.toggle2FaCode(this)
});
searchInput.placeholderTypewriter({text: ["keyword", "keyword @service:facebook", "keyword @service:google"]});
searchInput.keyup(AccountInstance.delayGetSearchValue(function () {
    if (!AccountInstance.requesting) {
        let _value = $(this).val();
        if (_value !== AccountInstance.currentQuery) {
            AccountInstance.currentQuery = _value;
            if (_value !== "") AccountInstance.queryAccount(_value);
        }
    }
}, 500));
