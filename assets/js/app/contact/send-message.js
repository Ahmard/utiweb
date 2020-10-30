$(function () {
    let form = document.getElementById('form-send-message');
    form.onsubmit = function (event) {
        event.preventDefault();
        APP.UI.Form.showLoader(form, '<i class fa fa-spinner fa-spin></i> Sending Your Message');

        $ajax.submitForm(form)
            .success(function (response) {
                let divMessage = document.createElement('div');
                divMessage.innerHTML = response.message;
                divMessage.classList.add('font-weight-bold');
                divMessage.setAttribute('style', 'font-size:15px');

                swal({
                    title: 'Message',
                    icon: 'success',
                    content: divMessage
                });

                APP.UI.Form.hideLoader(form);

                form.reset();
            })
            .error(function (...error) {
                APP.UI.Form.hideLoader(form);
            });
    };
})