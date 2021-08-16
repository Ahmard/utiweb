$(function () {
    let $form = $('#form-o2tvseriescoza');
    let $inputUrl = $form.find('input[name="o2tvseriescoza-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');

    $form.submit(function (event) {
        $extractor.init(event, templateLinkExtractionError, $inputUrl, $button, $linkExtractionStatus);
        let link = $extractor.performBasicLinkAction();

        if (link) {
            $extractor.fetchLinkData('tvshows/o2tvseries-co-za/' + link)
                .then(function (seasons) {
                    $extractor.stopExtraction();
                    seasons.forEach(function (season) {
                        $linkExtractionStatus.append(templateLinkExtractionO2TVSeries(season));
                    });
                })
                .catch(function (error) {
                    $extractor.stopExtraction();
                });
        }
    });
});