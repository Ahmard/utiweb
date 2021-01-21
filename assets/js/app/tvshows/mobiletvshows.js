$(function () {
    let $form = $('#form-mobiletvshows');
    let $inputUrl = $form.find('input[name="mobiletvshows-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    let $extractionMessage = $('#extraction-message');
    let templateMobileTvShowsExtraction = Handlebars.compile($('#template-link-extraction-mobiletvshows').html());

    if (localStorage.getItem('clicked-search-result')){
        setTimeout(function () {
            $inputUrl.val(localStorage.getItem('clicked-search-result'));
            $form.submit();
            localStorage.removeItem('clicked-search-result');
        }, 100);
    }

    $form.submit(function (event) {
        $extractor.init(event, templateLinkExtractionError, $inputUrl, $button, $linkExtractionStatus);
        let link = $extractor.performBasicLinkAction();

        if (link) {
            $extractor.fetchLinkData('tvshows/mobiletvshows/' + link)
                .then(function (seasons) {
                    $extractor.stopExtraction();
                    seasons.forEach(function (season) {
                        $linkExtractionStatus.append(templateMobileTvShowsExtraction(season));
                    });

                })
                .catch(function (error) {
                    $extractor.stopExtraction();
                });
        }
    });
});