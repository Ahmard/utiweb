$(function () {
    let $form = $('#form-netnaija');
    let $inputUrl = $form.find('input[name="netnaija-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');

    handleSearchResultClick($form, $inputUrl);

    $form.submit(function (event) {
        $extractor.init(event, templateLinkExtractionError, $inputUrl, $button, $linkExtractionStatus);
        let link = $extractor.performBasicLinkAction();

        if (link) {
            $extractor.fetchLinkData('movies/netnaija/' + link)
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