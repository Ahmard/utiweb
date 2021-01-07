$(function () {
    let $form = $('#form-fzmovies');
    let $inputUrl = $form.find('input[name="fzmovies-url"]');
    let $selectChosenLink = $form.find('select[name="chosen"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');

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
        let chosenLink = $selectChosenLink.val();

        if (link) {
            $extractor.fetchLinkData('movies/fzmovies/' + chosenLink + '/' + link)
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