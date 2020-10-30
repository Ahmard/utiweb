(function (ns) {
    let obj = ns.Ajax = {};

    let errorCallback;

    obj.requestFactory = function (url, method, params) {
        let requestObject;
        if(typeof url === 'object'){
            requestObject = url;
            requestObject.data = params;
        }else{
            requestObject = {
                url: url,
                method: method,
                data: params
            };
        }

        let req = obj.request(requestObject);

        return obj.applyCustomizations(req);
    };

    obj.get = (url, params) => obj.requestFactory(url, 'GET', params || {});
    obj.post = (url, params) => obj.requestFactory(url, 'POST', params || {});
    obj.put = (url, params) => obj.requestFactory(url, 'PUT', params || {});
    obj.patch = (url, params) => obj.requestFactory(url, 'PATCH', params || {});
    obj.delete = (url, params) => obj.requestFactory(url, 'DELETE', params || {});
    obj.head = (url, params) => obj.requestFactory(url, 'HEAD', params || {});


    obj.submitForm = function (form, options = {}) {
        let req = obj.request($.extend({
            form: form
        }, options));

        return obj.applyCustomizations(req);
    };


    obj.applyCustomizations = function (req) {
        req.success = function (callback) {
            req.then(function (...args) {
                if(args[0].success){
                    if (args[0].success || args[0].success === undefined) {
                        let response = args[0];
                        let returnData = [...args];
                        returnData[0] = response.data;
                        returnData[0].__response = response;
                        callback(...returnData);
                    }
                }
            })

            return req;
        }

        req.error = function (callback) {
            req.then(function (...args) {
                if(! args[0].success){
                    let response = args[0];
                    let returnData = [...args];
                    returnData[0] = response.error;
                    returnData[0].__response = response;
                    callback(...returnData);
                }
            });

            return req;
        }

        return req;
    };


    obj.request = function (options) {
        let requestUrl = options.url;
        let requestData = options.data;
        let requestMethod = options.method || 'GET';
        let requestDataType = options.dataType;// || 'JSON';

        //if form element is passed
        if (options.form) {
            let $form = APP.UI.El.getJQ(options.form);

            //if no url is passed, use form action attr value
            if (!requestUrl) {
                requestUrl = $form.attr('action');
            }

            //if request method is specified, use it
            if ($form.attr('method')) {
                requestMethod = $form.attr('method');
            }

            //blacklisted inputs
            let without = options.without || [];

            if (requestMethod.toLowerCase() === 'get') {
                //Prepare data for get transfer
                requestData = {};
                $.each($form.serializeArray(), function () {
                    if (without.indexOf(this.name) === -1) {
                        requestData[this.name] = this.value;
                    }
                });
            } else {
                //Prepare data for transfer
                let $inputsTypeFile = $form.find('[type="file"]');

                //if we have file
                if ($inputsTypeFile.length !== 0) {
                    requestData = new FormData();
                    options.hasFile = true;
                    let fileInputs = [];
                    $inputsTypeFile.each(function () {
                        if (without.indexOf(this.name) === -1) {
                            fileInputs.push(this.name);
                            requestData.append(this.name, this.files[0]);
                        }
                    });
                    $.each($form.serializeArray(), function () {
                        if (without.indexOf(this.name) === -1 && fileInputs.indexOf(this.name) === -1) {
                            requestData.append(this.name, this.value);
                        }
                    });
                } else {
                    requestData = {};
                    $.each($form.serializeArray(), function () {
                        if (without.indexOf(this.name) === -1) {
                            requestData[this.name] = this.value;
                        }
                    });
                }
            }
        }

        //Check if we have files to upload that are not in input fields
        if(options.files){
            if (! (requestData instanceof  FormData)){
                let objectKeys = Object.keys(requestData || {});
                //If data already exists, set it to FormData
                if(objectKeys.length > 0){
                    let newData = new FormData();
                    objectKeys.forEach(function (key) {
                        newData.append(key, requestData[key]);
                    });
                    requestData = newData;
                }
            }

            //If requestData is not instance of FormData, then initialize is.
            if(! (requestData instanceof  FormData)){
                requestData = new FormData();
            }

            options.files.forEach(function (file) {
                requestData.append(file.name, file.file);
            });

            //Indicate that we have file
            options.hasFile = true;
        }

        //Check if input data is set
        if(options.inputs){
            options.inputs.forEach(function (input){
                if(requestData instanceof FormData){
                    requestData.append(input.name, input.value);
                }else{
                    requestData[input.name] = input.value;
                }
            });
        }

        requestUrl = obj.url(requestUrl, {});

        //check if we have file to upload
        if (options.hasFile) {
            options.cache = false;
            options.processData = false;
            options.contentType = false;
        }

        //Replace the sensitive data with modified one
        options.url = requestUrl;
        options.data = requestData;
        options.method = requestMethod;
        options.dataType = requestDataType;

        //Delete unnecessary properties
        delete options.form;
        delete options.hasFile;

        //Send request
        let $request = $.ajax(options).retry(obj.getRetryValue());

        /**
         * Modify successful request
         * We will snoop in to the request result
         * We will handle any success error, like server error...
         * @return Jquery ajax object
         */
        $request.then(obj.getData);

        /**
         * Modify error request
         * We will snoop in to the request result
         * We will handle any error, like form validation...
         * @return Jquery ajax object
         */
        $request.fail(obj.handleError);

        return $request;
    };


    obj.url = function (link, payload) {
        let url = link;
        if (link.indexOf('http://') === -1) {
            url = window.location.origin + '/api/' + link;
        }
        if (payload) {
            //append payload
            let param = $.param(payload);
            if (link.indexOf('?') > -1) {
                url = url + '&' + param;
            } else {
                url = url + '?' + param;
            }
        }

        return url;
    };


    obj.getRetryValue = function () {
        //503 = service unavailable
        //599 network connect timeout
        return {
            times: 3,
            timeout: 5000,
            statusCodes: [
                503,
                599
            ]
        };
    };


    //attach ajax token in the data
    obj.withToken = function (data = {}) {
        let token = localStorage.getItem('token');
        if (token) {
            data.token = token;
        }
        return data;
    };


    obj.getData = function (response) {
        if (response.error) {
            let errors = response.error.errors;
            let modal = new ns.UI.Modal('general');
            let html = '<div class="list-group">';
            html += '<div class="list-group-item">' + response.error.message + '</div>';
            for (let errorName in errors) {
                errorName[0] = errorName[0].toLocaleUpperCase();
                errors[errorName].forEach(function (errorMessage) {
                    html += '<div class="list-group-item"><b>' + errorName + ':</b> ' + errorMessage + '</div>';
                });
            }
            modal.header('Request Error');
            modal.body(html).show();
        }

        return response;
    };

    obj.handleError = function (error) {
        let modal = new ns.UI.Modal('general');
        let html;

        if(error.status !== 200){
            if(error.responseJSON){
                html = error.responseJSON.message;
            }else{
                error = error.statusText;
            }
        }

        modal.setHeader('Request Error').footer(false);
        modal.body(html).show();

        return error;
    };
})(window.APP);

$ajax = window.APP.Ajax;