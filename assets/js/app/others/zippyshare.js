$(function () {
    let $form = $('#form-zippyshare');
    let $inputUrl = $form.find('input[name="zippyshare-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    $form.submit(function (event) {
        let link = performBasicLinkAction(event, $inputUrl, $button, $linkExtractionStatus);

        if (link) {
            fetchLinkData('others/zippyshare/' + link)
                .then(function (movie) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');

                    $linkExtractionStatus.html(templateLinkExtractionSuccess({
                        href: movie.url,
                        name: movie.name || 'Download'
                    }));
                }).catch(function (error) {
                $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                $inputUrl.removeAttr('disabled');
            });
        }
    });
});