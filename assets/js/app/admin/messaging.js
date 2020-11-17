let currentMessage;
let clickedMessageElement;
let $modal;

let viewMessage;
let markMessageAsRead;
let deleteMessage;

$(function () {
    $modal = $('#modal_general');

    viewMessage = function (element) {
        clickedMessageElement = element;
        currentMessage = JSON.parse(element.getAttribute('data-message'));
        let html = '';
        for (const name in currentMessage) {
            html += `<div class="list-group-item"><b>${name}: </b> ${currentMessage[name]}</div>`;
        }

        $modal.find('.modal-title').html('View Message');
        $modal.find('.modal-body').html(html);
        $modal.find('.modal-footer').html(`
            <div class="d-flex justify-content-end">
                ${
                    (currentMessage.status === '0') ? 
                        (`<button class="btn btn-md btn-primary" onclick="markMessageAsRead(this, currentMessage.id)">
                            <i class="fa fa-eye"></i> Mark as read
                          </button>
                        `) : ('')
                }
                <button class="btn btn-md btn-danger" onclick="deleteMessage(this, currentMessage.id)">
                    <i class="fa fa-trash-alt"></i> Delete
                </button>
            </div>
        `);
        $modal.modal('show');
    };

    markMessageAsRead = function (button, messageId) {
        $(button).addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i> Deleting');

        $ajax.patch(`admin/message/${messageId}/${TOKEN}`)
            .success(function (response) {
                //$modal.modal('hide');
                swal('Message', 'Message has been marked as read.', 'success');

                //Remove the element
                $(clickedMessageElement).remove();
            });
    };

    deleteMessage = function (button, messageId) {
        $(button).addClass('disabled').html('<i class="fa fa-spinner fa-spin"></i> Marking');

        $ajax.delete(`admin/message/${messageId}/${TOKEN}`)
            .success(function (response) {
                $modal.modal('hide');
                swal('Message', 'Message has been deleted.', 'success');

                //Remove the element
                $(clickedMessageElement).remove();
            });
    }
})