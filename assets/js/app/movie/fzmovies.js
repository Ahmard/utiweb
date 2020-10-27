$(function () {
    let $form = $('#form-fzmovies');
    let $inputUrl = $form.find('input[name="fzmovies-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    $form.submit(function (event) {
        event.preventDefault();

        $button.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-pulse"></i> Fetching');
        $inputUrl.attr('disabled', 'disabled');
        $linkExtractionStatus.html('');
        let link = btoa($inputUrl.val());

        $.ajax({
            url: '/api/movies/fzmovies/' + link,
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