$(function () {
    let $form = $('#form-femkvcom');
    let $inputUrl = $form.find('input[name="femkvcom-url"]');
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

        if (link) {
            $extractor.fetchLinkData('tvshows/480mkv-com/' + link)
                .then(function (episodes) {
                    $extractor.stopExtraction();
                    episodes.forEach(function (episode) {
                        $linkExtractionStatus.append(templateLinkExtractionEpisodeItem(episode));
                    });
                })
                .catch(function (error) {
                    $extractor.stopExtraction();
                });
        }
    });
});