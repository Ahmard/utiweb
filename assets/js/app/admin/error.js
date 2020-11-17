let currentError;
let clickedErrorElement;
let $modal;

let viewError;
let deleteError;

$(function () {
    $modal = $('#modal_general');

    viewError = function (element) {
        clickedErrorElement = element;
        currentError = JSON.parse(element.getAttribute('data-error'));
        let html = '';
        for (const name in currentError) {
            html += `<div class="list-group-item"><b>${name}: </b> ${currentError[name]}</div>`;
        }

        $modal.find('.modal-title').html('View Error');
        $modal.find('.modal-body').html(html);
        $modal.find('.modal-footer').html(`
            <div class="d-flex justify-content-end">
                <button class="btn btn-md btn-danger" onclick="deleteError(this, currentError.name)">
                    <i class="fa fa-trash-alt"></i> Delete
                </button>
            </div>
        `);
        $modal.modal('show');
    };

    deleteError = function (button, errorName) {
        $(button).addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i> Marking');

        $ajax.delete(`admin/error/${TOKEN}?name=${errorName}`)
            .success(function (response) {
                $modal.modal('hide');
                swal('Error', 'Error log has been deleted.', 'success');

                //Remove the element
                $(clickedErrorElement).remove();
            });
    }
})