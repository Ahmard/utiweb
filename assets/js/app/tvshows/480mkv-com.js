$(function () {
    let $form = $('#form-femkvcom');
    let $inputUrl = $form.find('input[name="femkvcom-url"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');
    $form.submit(function (event) {
        let link = performBasicLinkAction(event, $inputUrl, $button, $linkExtractionStatus);

        if (link) {
            fetchLinkData('tvshows/480mkv-com/' + link)
                .then(function (episodes) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');

                    $linkExtractionStatus.html('');
                    episodes.forEach(function (episode) {
                        $linkExtractionStatus.append(templateLinkExtractionEpisodeItem(episode));
                    });

                })
                .catch(function (error) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');
                });
        }
    });
});