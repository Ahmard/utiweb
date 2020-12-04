(function (editor) {
    function Notification() {

        let notifications = {};

        this.initCreateForm = function () {
            const templateNotification = Handlebars.compile($('#template-notification').html());

            let params = new URLSearchParams(location.search);
            if (params.has('view')){
                this.view(document.getElementById(`notification-${params.get('view')}`));
            }

            $(function () {
                const form = document.getElementById('form-create-notification');

                form.onsubmit = function (event) {
                    event.preventDefault();
                    APP.UI.Form.showLoader(form, 'Creating');

                    const inputs = {
                        inputs: [{
                            name: 'notification',
                            value: editor.getValue()
                        }]
                    };

                    $ajax.post(form.getAttribute('action'), inputs)
                        .success(function (response) {
                            let notif = {
                                id: response.id,
                                notification: editor.getValue(),
                                status: 1
                            };

                            notif.json = JSON.stringify(notif);

                            $('#notifications').append(templateNotification({
                                notification: notif
                            }));

                            APP.UI.Form.hideLoader(form);
                        })
                        .error(function (error) {
                            APP.UI.Form.hideLoader(form);
                        });
                }
            })
        };

        this.initUpdateForm = function () {
            let $form = $('#form-update-notification');
            const form = document.getElementById('form-update-notification');

            form.onsubmit = function (event) {
                event.preventDefault();
                APP.UI.Form.showLoader(form, 'Updating');

                const inputs = {
                    inputs: [{
                        name: 'notification',
                        value: editor.getValue()
                    }]
                };

                $ajax.post(form.getAttribute('action'), inputs)
                    .success(function (response) {
                        swal('Update Notification', response.message, 'success');
                        $modal.hide();
                        APP.UI.Form.hideLoader(form);
                    })
                    .error(function (error) {
                        APP.UI.Form.hideLoader(form);
                    })
            };
        };

        this.view = function (element) {
            const templateViewNotification = Handlebars.compile($('#template-view-notification').html());
            let notification = JSON.parse(element.getAttribute('data-notif'));
            //Pass auth token to template
            notification.token = TOKEN;

            notifications[notification.id] = notification;

            $modal.find('.modal-title').html('View Notification');
            $modal.find('.modal-body').html(templateViewNotification(notification));
            $modal.find('.modal-footer').hide();
            $modal.modal('show');

        };

        this.delete = function (a) {
            APP.UI.showButtonLoader(a, 'Deleting');
            let notificationId = a.getAttribute('data-id');

            $ajax.delete(`admin/notification/${notificationId}/${TOKEN}`)
                .success(function (response) {
                    delete notifications[notificationId];
                    swal('Delete Notification', response.message, 'success');
                    $(`#notification-${notificationId}`).remove();
                    $modal.modal('hide');
                })
                .error(function () {
                    $modal.modal('hide');
                });
        };
    }

    window.APP.notification = new Notification();
})(editor);