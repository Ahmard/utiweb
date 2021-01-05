$(function () {
    let $form = $('#form-mobiletvshows');
    let $inputUrl = $form.find('input[name="mobiletvshows-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    let templateMobileTvShowsExtraction = Handlebars.compile($('#template-link-extraction-mobiletvshows').html());

    if (localStorage.getItem('clicked-search-result')){
        setTimeout(function () {
            $inputUrl.val(localStorage.getItem('clicked-search-result'));
            $form.submit();
            localStorage.removeItem('clicked-search-result');
        }, 100);
    }

    $form.submit(function (event) {
        let link = performBasicLinkAction(event, $inputUrl, $button, $linkExtractionStatus);

        if (link) {
            fetchLinkData('tvshows/mobiletvshows/' + link)
                .then(function (response) {
                    let seasons = response.data;
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');

                    $linkExtractionStatus.html('');
                    seasons.forEach(function (season) {
                        $linkExtractionStatus.append(templateMobileTvShowsExtraction(season));
                    });

                })
                .catch(function (error) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');
                });
        }
    });
});