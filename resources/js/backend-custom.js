$(document).on('change', '.form-check-input.toggle-status', function () {
    let me =$(this);
    let id = $(this).data('id');
    let status = $(this).is(':checked') ? 1 : 0;
    let url = $(this).data('url');
    const token = document.querySelector('meta[name="csrf-token"]').content;

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: token,
            id: id,
            status: status
        },
        success: function (response) {
            toastr.success(response.message);
            me.closest('.form-switch').find('.form-check-label').text(status? 'Enabled' : 'Disabled');
        },
        error: function () {
            toastr.error('Failed to update status.');
        }
    });
});