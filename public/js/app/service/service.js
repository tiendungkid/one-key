/**
 * -------------------------------
 * Variable declaration
 * -------------------------------
 */
const serviceTable = $(`#service-table`);
const URIs = {
    datatable: $(`meta[name="service-datatable"]`).attr('content'),
    show: $(`meta[name="service-show"]`).attr('content'),
    accountList: $(`meta[name="service-account-list"]`).attr('content'),
};
const serviceDatatable = serviceTable.DataTable({
    searching: true,
    serverSide: true,
    processing: true,
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50, 75, 100],
    buttons: false,
    ajax: URIs.datatable,
    columns: [
        {data: 'id'},
        {
            data: 'name',
            render(data, type, row) {
                return `<a href="${URIs.show.replace('services/0', `services/${row['id']}`)}">${data}</a>`;
            }
        },
        {data: 'home_link'},
        {
            data: 'accounts_count',
            render(data, type, row) {
                return `<a href="${URIs.accountList.replace('accounts/list/0', `accounts/list/${row['id']}`)}">${data}</a>`;
            },
            searchable: false
        },
        {
            data: 'created_at',
            render(data) {
                if (data) {
                    return `${moment(moment()).diff(data, 'days')} days ago`;
                }
                return '';
            }
        }
    ],
    language: {
        paginate: {
            previous: `<i class='fas fa-angle-left'>`,
            next: `<i class='fas fa-angle-right'>`
        }
    }
});
