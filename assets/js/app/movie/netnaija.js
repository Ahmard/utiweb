$(function () {
    let $form = $('#form-netnaija');
    let $inputUrl = $form.find('input[name="netnaija-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    $form.submit(function (event) {
        event.preventDefault();

        $button.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-pulse"></i> Fetching');
        $inputUrl.attr('disabled', 'disabled');
        $linkExtractionStatus.html('');
        let link = btoa($inputUrl.val());

        $.ajax({
            url: '/api/movies/netnaija/' + link,
            error: ajaxErrorHandler
        }).then(function (response) {
            $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
            $inputUrl.removeAttr('disabled');

            $linkExtractionStatus.html(templateLinkExtractionSuccess({
                href: response.data.url,
                name: response.data.name || 'Download'
            }));

            console.log(response);
        });
    });
});