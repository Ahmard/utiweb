window.APP = {};
/**
 * User interface helper
 * Core ui
 * Modal
 */
(function (ns) {
    ns.UI = {};

    let animatedDotInterval = [];

    let buttonLoadings = {};


    function faFactory(type, iconName, size) {
        size = size ? ' fa-' + size + 'x' : '';
        return '<i class="' + type + ' fa-' + iconName + size + '"></i>';
    }


    ns.UI.fa = function (iconName, size) {
        return faFactory('fa', iconName, size);
    };


    ns.UI.fas = function (iconName, size) {
        return faFactory('fas', iconName, size);
    };


    ns.UI.alert = function (type, message, closeable = false) {
        let openTag = '<div class="alert alert-' + type + '" role="alert">';
        let closeTag = '</div>';
        if (closeable) {
            openTag = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">';
            closeTag = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
        }
        return openTag + message + closeTag;
    };


    ns.UI.submitForm = function (form, options) {
        let button = form.querySelector('button[type="submit"]');
        ns.UI.waitButton(button, options);

        return ns.UI;
    };


    ns.UI.waitButton = function (button, options) {
        if (typeof button == 'string') {
            button = document.getElementById(button);
        }
        let willShow = true;
        if (options.required) {
            for (let i = 0; i < options.required.length; i++) {
                if ($(options.required[i]).val() === '') {
                    willShow = false;
                    break;
                }
            }
        }

        if (willShow) {
            button.setAttribute('class', button.getAttribute('class') + ' disabled');
            button.setAttribute('disabled', 'disabled');
            ns.UI.animDots(button, options);
        }

        return ns.UI;
    };


    ns.UI.showButtonLoader = function (button, text = '', faClass = '') {
        let $button = ns.UI.El.getJQ(button);
        //save current state
        let buttonId = $button.attr('id')
        if (buttonId) {
            buttonId = buttonId.replaceAll('-', '');
            buttonLoadings[buttonId] = $button.html();
        }

        $button.addClass('disabled')
            .html(ns.UI.fa('spinner fa-pulse ' + faClass) + ' ' + text)
            .attr('disabled', 'disabled');

        return ns.UI;
    };


    ns.UI.hideButtonLoader = function (button, text) {
        let $button = ns.UI.El.getJQ(button);
        $button.removeClass('disabled')
        //get stored text, if any
        let oldText;
        if (!text) {
            let buttonId = $button.attr('id').replaceAll('-', '');
            oldText = buttonLoadings[buttonId];
        }
        $button.html(oldText || text);
        $button.removeAttr('disabled');
        $button.find('.waves-ripple').remove();

        return ns.UI;
    };


    ns.UI.animDots = function (el, options) {
        let waitMsg = '';
        if (typeof el == 'string') {
            el = document.getElementById(el);
        }
        //if message is provided in second param instead of options
        if (typeof options == 'string') {
            waitMsg = options;
        }
        let numberOfDots = options.dots || 3;
        let timeInterval = options.interval || 200;
        if (options.text !== false) {
            waitMsg = options.text || waitMsg;
            waitMsg = waitMsg || 'please wait';
        }
        let dotClass = options.dotclass || 'text-warning';
        let textClass = options.textclass || 'text-white';

        //clear the element value
        if (el.hasChildNodes()) {
            el.innerHTML = null;
        }

        //Running animated dots
        let el_running = document.createElement("i");
        el_running.id = "running-animated-dots";

        //Run the dots
        let dotsCount = 0;
        let dot = '<b class="' + dotClass + '">.</b>';
        let text = '<i id="animated-dots-wait" class="' + textClass + '">' + waitMsg + '</i>';

        el_running.innerHTML = text;
        //if we don't need waiting message
        if (options.text === false) {
            el_running.innerHTML += dot;
            //we will use dot as default value instead
            text = dot;
        }

        //Set the child elements
        el.appendChild(el_running);

        animatedDotInterval[el.id] = setInterval(function () {
            if (dotsCount === numberOfDots) {
                dotsCount = -1;
                el_running.innerHTML = text;
            } else {
                el_running.innerHTML += dot;
            }
            dotsCount++;
        }, timeInterval);


    };//animatedDots


    ns.UI.stopAnimDots = function (elementId) {
        clearInterval(animatedDotInterval[elementId]);
        document.getElementById(elementId).innerHTML = '';
    };
})(window.APP);


/**
 * Form
 */
(function (ns) {
    ns.Form = {};

    let formLoadingButton = {};
    let formLoadingButtonText = {};


    ns.Form.submit = ns.submitForm;

    ns.Form.showLoader = function (form, text = 'Submitting') {
        if (typeof form == 'string') {
            form = document.getElementById(form)
        }

        let button = form.querySelector('[type="submit"]');

        //save state
        let formId = form.id.replaceAll('-', '');
        formLoadingButton[formId] = button;
        formLoadingButtonText[formId] = button.innerHTML;

        ns.showButtonLoader(button, text)

        return ns.Form;
    };


    ns.Form.hideLoader = function (formId, text) {
        if (typeof formId != 'string') {
            formId = formId.getAttribute('id');
        }

        formId = formId.replaceAll('-', '');
        let button = formLoadingButton[formId];

        let buttonText = text || formLoadingButtonText[formId];

        ns.hideButtonLoader(button, buttonText);

        return ns.Form;
    }
})(window.APP.UI);


/**
 * Modal
 */
(function (ns) {


    function Modal(id) {
        this.setId(id);
    }


    let proto = Modal.prototype;

    /**
     * Stores modal id
     * @let string
     */
    proto.modalId = null;

    /**
     * Close button id
     * This id will be adjusted,
     * proto.modalId will added at its beginning
     * Example: 'general_header_close_button'
     * @let string
     */
    proto.closeButtonIdentifier = '_header_close_button';
    proto.closeButtonId = null;

    /**
     * Will indicate weather the respected attrs are hidden
     * @let Boolean
     */
    proto.isHeaderHidden = false;

    proto.isFooterHidden = false;

    proto.isShown = false;

    proto.setId = function (mId) {
        //set modal id
        this.modalId = "#modal_" + mId;
        //set footer id
        this.closeButtonId = this.modalId + this.closeButtonIdentifier;
        //let modal handleUpdate
        $(this.modalId).modal('handleUpdate');

        return this;
    };


    proto.getId = function () {
        return this.modalId;
    };


    proto.useGeneral = function () {
        return new Modal('general');
    };


    proto.on = function (onEvent, callback) {
        let obj = this;
        $(this.getId()).on(onEvent + '.bs.modal', function (e) {
            return callback(obj);
        });

        return this;
    };


    proto.one = function (onEvent, callback) {
        let obj = this;
        $(this.getId()).one(onEvent + '.bs.modal', function (e) {
            return callback(obj);
        });

        return this;
    };


    proto.off = function (onEvent) {
        $(this.getId()).off(onEvent + '.bs.modal');

        return this;
    };


    proto.decideId = function (mId) {
        if (!mId) {
            return this.modalId;
        }
        return mId;
    };


    proto.show = function (modalId = '') {
        $(this.getId()).modal('show');

        this.isShown = true;

        return this;
    };


    proto.hide = function (modalId = '') {
        $(this.getId()).modal('hide');

        return this;
    };


    proto.close = function (modalId = '') {
        $(this.getId()).modal('dispose');

        return this;
    };


    proto.actOnHF = function (element, action) {
        switch (action) {
            case false:
                element.hide();
                break;
            case true:
                element.show();
                break;
        }

        return this;
    };


    proto.showLoader = function (showHeaderAndFooter, willShowFooter) {
        showHeaderAndFooter = showHeaderAndFooter || false;
        if (!this.modalId) {
            this.useGeneral();
        }
        //if we'll hide header and footer
        if (willShowFooter !== undefined) {
            this.footer(willShowFooter);
            if (showHeaderAndFooter) {
                this.header(showHeaderAndFooter);
            }
        } else {
            this.header(showHeaderAndFooter).footer(showHeaderAndFooter);
        }

        this.setBody('<div class="text-center"><i class="m-3 fa fa-3x text-info fa-spinner fa-pulse"></i><br/>Loading...</div>');
        this.show();

        return this;
    };


    proto.hideLoader = function (willNotCloseModal) {
        this.header(true).footer(true);
        if (willNotCloseModal) {
            this.hide();
        }

        return this;
    };


    proto.closeButton = function (action) {
        if (action === true || action === undefined) {
            this.getCloseButton().show();
        } else {
            this.getCloseButton().hide();
        }

        return this;
    };


    proto.getHeaderCloseButton = function () {
        return $(this.closeButtonId);
    };


    proto.header = function (actionOrHtml) {
        if (typeof actionOrHtml == 'boolean') {
            this.isHeaderHidden = true;
            return this.actOnHF($(this.getId()).find('.modal-header'), actionOrHtml);
        }

        return this.setHeader(actionOrHtml);
    };


    proto.body = function (html) {
        return this.setBody(html);
    };


    proto.footer = function (actionOrHtml) {
        if (typeof actionOrHtml == 'boolean') {
            this.isFooterHidden = true;
            return this.actOnHF($(this.getId()).find('.modal-footer'), actionOrHtml);
        }

        return this.setFooter(actionOrHtml);
    };


    proto.setHeader = function (content) {
        $(this.getId()).find('.modal-title').html(content);

        return this;
    };


    proto.setBody = function (content) {
        $(this.getId()).find('.modal-body').html(content);

        return this;
    };

    proto.setFooter = function (content) {
        $(this.getId()).find('.modal-footer').html(content);

        return this;
    };

    ns.UI.Modal = Modal;
})(window.APP);


(function (ns) {
    ns.UI.El = {};

    ns.UI.El.getJQ = function (element) {
        switch (typeof element) {
            case 'string':
                if (element.indexOf('#') > -1) {
                    return $(element);
                }

                //we have to put #
                return $('#' + element);
            case 'object':
                if (element instanceof jQuery) {
                    return element;
                }
                return $(element);
        }
    }
})(window.APP);
