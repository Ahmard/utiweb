$(function () {
    let $form = $('#form-coolmoviez');
    let $inputUrl = $form.find('input[name="coolmoviez-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    $form.submit(function (event) {
        $extractor.init(event, templateLinkExtractionError, $inputUrl, $button, $linkExtractionStatus);
        let link = $extractor.performBasicLinkAction();

        if (link) {
            $extractor.fetchLinkData('movies/coolmoviez/' + link)
                .then(function (movie) {
                    $extractor.stopExtraction();
                    $linkExtractionStatus.html(templateLinkExtractionSuccess({
                        href: movie.url,
                        name: movie.name || 'Download'
                    }));
                }).catch(function (error) {
                    $extractor.stopExtraction();
                });
        }
    });
});