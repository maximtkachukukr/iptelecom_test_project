$(document).ready(function() {
    function sendLoginRequest() {
        let $form = $('form');
        $.ajax({
            url: "/",
            type:'POST',
            dataType: 'json',
            data: {
                'login': $form.find('input[type="text"]').val(),
                'password': $form.find('input[type="password"]').val()
            },
        }).done(function (response) {
            if (response.isValid) {
                document.location.href = response.redirect_to;
            } else {
                $form.find('.form-text').html('');
                let inputs = {
                    'login': $form.find('input[type="text"]'),
                    'password': $form.find('input[type="password"]')
                }
                // todo check different response types
                $.each(inputs, function (key, $input) {
                    if (response.errorMessages[key] !== undefined) {
                        $('#' + $input.attr('aria-describedby')).html(
                            Object.values(response.errorMessages[key])[0]
                        );
                    }
                });
            }
        });
    }

    $('button[type="submit"]').click(function(e) {
        console.log('click');
        sendLoginRequest();
        return e.preventDefault();
    });
});

