$(function () {
    let $form = $('#form-mobiletvshows');
    let $inputUrl = $form.find('input[name="mobiletvshows-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    let templateMobileTvShowsExtraction = Handlebars.compile($('#template-link-extraction-mobiletvshows').html());

    handleSearchResultClick($form, $inputUrl)

    $form.submit(function (event) {
        $extractor.init(event, templateLinkExtractionError, $inputUrl, $button, $linkExtractionStatus);
        let link = $extractor.performBasicLinkAction();

        if (link) {
            $extractor.fetchLinkData('tvshows/mobiletvshows/' + link)
                .then(function (seasons) {
                    $extractor.stopExtraction();
                    seasons.forEach(function (season) {
                        console.log(season)
                        $linkExtractionStatus.append(templateMobileTvShowsExtraction(season));
                    });

                })
                .catch(function (error) {
                    $extractor.stopExtraction();
                });
        }
    });
});