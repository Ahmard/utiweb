$(function () {
    let $form = $('#form-fzmovies');
    let $inputUrl = $form.find('input[name="fzmovies-url"]');
    let $selectChosenLink = $form.find('select[name="chosen"]');
    let $selectChosenQuality = $form.find('select[name="quality"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');

    handleSearchResultClick($form, $inputUrl);

    $form.submit(function (event) {
        $extractor.init(event, templateLinkExtractionError, $inputUrl, $button, $linkExtractionStatus);
        let link = $extractor.performBasicLinkAction();
        let chosenLink = $selectChosenLink.val();
        let chosenQuality = $selectChosenQuality.val();

        if (link) {
            $extractor.fetchLinkData('movies/fzmovies/' + chosenLink + '/' + chosenQuality + '/' + link)
                .then(function (movie) {
                    $extractor.stopExtraction();
                    $linkExtractionStatus.html(templateLinkExtractionSuccess({
                        href: movie.url,
                        name: movie.name || 'Download'
                    }));
                })
                .catch(function (error) {
                    $extractor.stopExtraction();
                });
        }
    });
});