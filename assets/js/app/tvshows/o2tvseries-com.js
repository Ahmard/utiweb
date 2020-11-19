$(function () {
    let $form = $('#form-o2tvseriescom');
    let $inputUrl = $form.find('input[name="o2tvseriescom-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');

    $form.submit(function (event) {
        let link = performBasicLinkAction(event, $inputUrl, $button, $linkExtractionStatus);

        if (link) {
            fetchLinkData('tvshows/o2tvseries-com/' + link)
                .then(function (seasons) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');

                    $linkExtractionStatus.html('');
                    seasons.forEach(function (season) {
                        $linkExtractionStatus.append(templateLinkExtractionO2TVSeries(season));
                    });

                })
                .catch(function (error) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');
                });
        }
    });
});