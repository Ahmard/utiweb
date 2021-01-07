(function () {
    let event = null;
    let $inputUrl = null;
    let $button = null;
    let $linkExtractionStatus = null;
    let templateLinkExtractionError = null;

    let isExtracting = false;

    let Extractor = function () {

        this.init = function (_event, _templateLinkExtractionError, _$inputUrl, _$button, _$linkExtractionStatus) {
            event = _event;
            templateLinkExtractionError = _templateLinkExtractionError;
            $inputUrl = _$inputUrl;
            $button = _$button;
            $linkExtractionStatus = _$linkExtractionStatus;
        };

        this.fetchLinkData = function (link) {
            isExtracting = true;
            return new Promise(function (resolve, reject) {
                $ajax.get(link).success(function (...arguments) {
                    resolve(...arguments);
                }).error(function (error) {
                    reject(error);
                }).fail(function (error) {
                    reject(error);
                });
            });
        };

        this.performBasicLinkAction = function () {
            event.preventDefault();
            if (!$inputUrl.val()) {
                $linkExtractionStatus.html(templateLinkExtractionError({
                    message: 'You must provide video url first!'
                }))
                $inputUrl.focus();
                return false;
            }

            $button.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-pulse"></i> Fetching');
            $inputUrl.attr('disabled', 'disabled');

            $linkExtractionStatus.addClass('mt-3').html(
                '<div class="alert alert-warning z-depth-1"><i class="fa fa-info-circle text-warning"></i> ' +
                'Please wait while your download link is being extracted.<br/>' +
                'Sometimes extraction may take a while ⌚</div>'
            );

            return btoa($inputUrl.val());
        };

        this.stopExtraction = function () {
            isExtracting = false;
            $linkExtractionStatus.removeClass('mt-3').html('');
            $button.removeAttr('disabled').html('<i class="fa fa-search"></i> Fetch');
            $inputUrl.removeAttr('disabled');
        };

        this.isExtracting = () => isExtracting;
    };

    Extractor.create = () => new Extractor();
    window.APP.Extractor = Extractor;
})();