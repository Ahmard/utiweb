$(function () {
    let $form = $('#form-fzmovies');
    let $inputUrl = $form.find('input[name="fzmovies-url"]');
    let $selectChosenLink = $form.find('select[name="chosen"]');
    let $button = $form.find('button[type="submit"]');
    let $linkExtractionStatus = $('#link-extraction-status');

    handleSearchResultClick($form, $inputUrl);

    $form.submit(function (event) {
        let link = performBasicLinkAction(event, $inputUrl, $button, $linkExtractionStatus);
        let chosenLink = $selectChosenLink.val();

        if (link) {
            fetchLinkData('movies/fzmovies/' + chosenLink + '/' + link)
                .then(function (movie) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');

                    $linkExtractionStatus.html(templateLinkExtractionSuccess({
                        href: movie.url,
                        name: movie.name || 'Download'
                    }));
                })
                .catch(function (error) {
                    $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
                    $inputUrl.removeAttr('disabled');
                });
        }
    });
});