(function (ns) {
    function Ajax() {

        let successCallback, errorCallback;

        const __this = this;

        this.get = (url, parameters) => requestFactory(url, 'GET', parameters || {});
        this.post = (url, parameters) => requestFactory(url, 'POST', parameters || {});
        this.put = (url, parameters) => requestFactory(url, 'PUT', parameters || {});
        this.patch = (url, parameters) => requestFactory(url, 'PATCH', parameters || {});
        this.delete = (url, parameters) => requestFactory(url, 'DELETE', parameters || {});
        this.head = (url, parameters) => requestFactory(url, 'HEAD', parameters || {});

        /**
         * Submit html form
         * @param form form to submit
         * @param options Additional jquery ajax options
         * @returns {*}
         */
        this.submitForm = function (form, options = {}) {
            let request = this.request($.extend({
                form: form
            }, options));

            return applyCustomizations(request);
        };

        this.request = function (options) {
            let requestUrl = options.url;
            let requestData = options.data || {};
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
            if (options.files) {
                if (!(requestData instanceof FormData)) {
                    let objectKeys = Object.keys(requestData || {});
                    //If data already exists, set it to FormData
                    if (objectKeys.length > 0) {
                        let newData = new FormData();
                        objectKeys.forEach(function (key) {
                            newData.append(key, requestData[key]);
                        });
                        requestData = newData;
                    }
                }

                //If requestData is not instance of FormData, then initialize is.
                if (!(requestData instanceof FormData)) {
                    requestData = new FormData();
                }

                options.files.forEach(function (file) {
                    requestData.append(file.name, file.file);
                });

                //Indicate that we have file
                options.hasFile = true;
            }

            //Check if input data is set
            if (options["inputs"]) {
                options["inputs"].forEach(function (input) {
                    if (requestData instanceof FormData) {
                        requestData.append(input.name, input.value);
                    } else {
                        requestData[input.name] = input.value;
                    }
                });
            }

            requestUrl = url(requestUrl, {});

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
            let $request = $.ajax(options).retry(this.getRetryValue());

            /**
             * Modify successful request
             * We will snoop in to the request result
             * We will handle any success error, like server error...
             * @return Jquery ajax object
             */
            $request.then(getData);

            /**
             * Modify error request
             * We will snoop in to the request result
             * We will handle any error, like form validation...
             * @return Jquery ajax object
             */
            $request.fail(handleError);

            return $request;
        };

        let requestFactory = function (url, method, parameters) {
            let requestObject;
            if (typeof url === 'object') {
                requestObject = url;
                requestObject.data = parameters;
            } else {
                requestObject = $.extend({
                    url: url,
                    method: method,
                }, parameters);
            }

            let req = __this.request(requestObject);

            return applyCustomizations(req);
        };

        let applyCustomizations = function (response) {
            /**
             * Handles success response - this is response that has {success: true}
             * @param callback
             * @returns {*}
             */
            response.success = function (callback) {
                successCallback = callback;
                response.then(function (...arguments) {
                    if (arguments[0].success || arguments[0].success === undefined) {
                        let response = arguments[0];
                        let returnData = [...arguments];
                        returnData[0] = response.data;
                        returnData[0].__response = response;
                        successCallback(...returnData);
                    } else {
                        if (errorCallback) {
                            let response = arguments[0];
                            let returnData = [...arguments];
                            returnData[0] = response["responseJSON"];
                            returnData[0].__response = response;
                            errorCallback(...returnData);
                        }
                    }

                    return response;
                });

                return response;
            };

            /**
             * Handles error response - any error response or response with {success: false}
             * @param callback
             * @returns {*}
             */
            response.error = function (callback) {
                errorCallback = callback;
                response.fail(function (...arguments) {
                    let response = arguments[0];
                    let returnData = [...arguments];
                    returnData[0] = response["responseJSON"];
                    returnData[0].__response = response;
                    callback(...returnData);
                });

                return response;
            };

            return response;
        };

        let url = function (link, payload) {
            let url = link;
            if (link.indexOf('http://') === -1) {
                url = window.location.origin + '/api/' + link;
            }

            if (0 !== Object.keys(payload).length) {
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

        this.getRetryValue = function () {
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

        let getData = function (response) {
            if (response.error) {
                let errors = response.error.errors;
                let modal = new ns.UI.Modal('general');
                let html = '<div class="list-group">';
                if (typeof response.error === 'string'){
                    html += '<div class="font-weight-bold"><b class="text-danger">ERROR: </b>' + response.error + '</div>';
                }else {
                    html += '<div class="list-group-item">' + response.error.message + '</div>';
                    for (let errorName in errors) {
                        errors[errorName].forEach(function (errorMessage) {
                            html += '<div class="list-group-item"><b>' + errorName + ':</b> ' + errorMessage + '</div>';
                        });
                    }
                }
                html += '</div>';
                modal.header('Request Error');
                modal.footer(false).body(html).show();
            }

            return response;
        };

        let handleError = function (error) {
            let modal = new ns.UI.Modal('general');
            let html;

            if (error.status !== 200) {
                if (error["responseJSON"]) {
                    html = error["responseJSON"].message;
                } else {
                    error = error.statusText;
                }
            }

            if (!html) {
                html = 'An error occurred while executing your request, please try again.<br/>';
                html += 'If this error persist, report it to admin or create an issue on github.';
            }

            modal.setHeader('Request Error').footer(false);
            modal.body(html).show();

            return error;
        };
    }

    /**
     * Creates an instance of APP.Ajax object
     * @returns {Ajax}
     */
    Ajax.create = () => new Ajax();

    ns.Ajax = Ajax;
})(window.APP);

$ajax = APP.Ajax.create();