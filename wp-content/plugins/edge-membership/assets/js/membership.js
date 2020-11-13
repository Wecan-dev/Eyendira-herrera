(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof edge !== 'undefined' ) {
        edge.modules.socialLogin = socialLogin;
    }

    socialLogin.edgeUserLogin = edgeUserLogin;
    socialLogin.edgeUserRegister = edgeUserRegister;
    socialLogin.edgeUserLostPassword = edgeUserLostPassword;
    socialLogin.edgeInitLoginWidgetModal = edgeInitLoginWidgetModal;
    socialLogin.edgeUpdateUserProfile = edgeUpdateUserProfile;

    $(document).ready(edgeOnDocumentReady);
    $(window).load(edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeInitLoginWidgetModal();
        edgeUserLogin();
        edgeUserRegister();
        edgeUserLostPassword();
        edgeUpdateUserProfile();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
    }

    /**
     * Initialize login widget modal
     */
    function edgeInitLoginWidgetModal() {

        var modalOpener = $('.edge-login-opener'),
            modalHolder = $('.edge-login-register-holder');

        if (modalOpener) {
            var tabsHolder = $('.edge-login-register-content');

            //Init opening login modal
            modalOpener.on('click', function (e) {
                e.preventDefault();
                modalHolder.fadeIn(300);
                modalHolder.addClass('opened');
            });

            //Init closing login modal
            modalHolder.on('click', function (e) {
                if (modalHolder.hasClass('opened')) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
            $('.edge-login-register-content').on('click', function (e) {
                e.stopPropagation();
            });
            // on esc too
            $(window).on('keyup', function (e) {
                if (modalHolder.hasClass('opened') && e.keyCode === 27) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });

            //Init tabs
            tabsHolder.tabs();
        }
    }

    /**
     * Login user via Ajax
     */
    function edgeUserLogin() {
        $('.edge-login-form').on('submit', function (e) {
            e.preventDefault();
            var ajaxData = {
                action: 'edge_membership_login_user',
                security: $(this).find('#edge-login-security').val(),
                login_data: $(this).serialize()
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: EdgeAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    edgeRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }

            });
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function edgeUserRegister() {

        $('.edge-register-form').on('submit', function (e) {

            e.preventDefault();
            var ajaxData = {
                action: 'edge_membership_register_user',
                security: $(this).find('#edge-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: EdgeAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    edgeRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function edgeUserLostPassword() {

        var lostPassForm = $('.edge-reset-pass-form');
        lostPassForm.submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'edge_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: EdgeAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    edgeRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function edgeRenderAjaxResponseMessage(response) {

        var responseHolder = $('.edge-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.edge-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'edge-membership-message-succes';
        } else {
            messageClass = 'edge-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Update User Profile
     */
    function edgeUpdateUserProfile() {
        var updateForm = $('#edge-membership-update-profile-form');
        if ( updateForm.length ) {
            var btnText = updateForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            updateForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'edge_membership_update_user_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: EdgeAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        edgeRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);