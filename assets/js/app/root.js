
Handlebars.registerHelper('errorMessage', function (message) {
    if (! message){
        return 'Link extraction failed';
    }

    return message;
});

let ajaxErrorHandler = function (error) {
    console.log('Error occured');
    console.log(error);
};

let fetchLinkData = function (link) {
    return  new Promise(function (resolve, reject) {
        $ajax.get(link).success(function (...arguments) {
            resolve(...arguments);
        }).error(function (error) {
            reject(error);
        }).fail(function (error) {
            reject(error);
        });
    });
};

let performBasicLinkAction = function (event, $inputUrl, $button, $linkExtractionStatus) {
    event.preventDefault();
    if(! $inputUrl.val()){
        $linkExtractionStatus.html(templateLinkExtractionError({
            message: 'You must provide video url first!'
        }))
        $inputUrl.focus();
        return false;
    }

    $button.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-pulse"></i> Fetching');
    $inputUrl.attr('disabled', 'disabled');
    $linkExtractionStatus.html('');
    return btoa($inputUrl.val());
};