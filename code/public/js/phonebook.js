$(document).ready(function() {
    renderList();
    $('#newPhonebookItemForm button[type="submit"]').click(function(e) {
        sendNewPhonebookItemForm();
        return e.preventDefault();
    })

    $('body').on('click', '.view', function (e) {
        let image = '<img style="max-width: 100%;" src="' + $(this).data('imgurl') + '" alt="">';
        $('#imageModal .modal-body').html(image);
        $('#imageModal').modal('show');
        return e.preventDefault();
    });
    $('body').on('click', '.delete-phone', function () {
        let id = $(this).data('id');
        $.ajax({
            url: "/phonebook/delete-phonebook-item",
            type:'POST',
            dataType: 'json',
            data: {id: id},
        }).done(function (response) {
            if (response.is_success) {
                alert('Deleted!');
                renderList();
            }
        });
    });

    function sendNewPhonebookItemForm() {
        let $form = $('#newPhonebookItemForm');
        let formData = new FormData($form[0]);
        $.ajax({
            url: "/phonebook/add-phonebook-item",
            type:'POST',
            dataType: 'json',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (response) {
            if (response.isValid) {
                alert('Phone added!');
                $form.find('input[name]').val('');
                $form.find('.form-text').html('');
                renderList();
            } else {
                $form.find('.form-text').html('');
                if (typeof response.errorMessages === 'object') {
                    $.each(response.errorMessages, function(key, messages){
                        $input = $form.find('input[name="' + key + '"]');
                        $('#' + $input.attr('aria-describedby')).html(Object.values(messages)[0]);
                    });
                } else {
                    alert('Save or upload error');
                }
            }
        });
    }

    function renderList() {
        $.ajax({
            url: "/phonebook/get-list",
            dataType: 'json'
        }).done(function (list) {
            let html = '';
            $.each(list, function (index, item) {
                html+='<tr>' +
                    '<th scope="row">' + item.id + '</th>' +
                    '<td>' + item.name + '</td>' +
                    '<td>' + item.surname + '</td>' +
                    '<td>' + item.phone + '</td>' +
                    '<td>' + item.email + '</td>' +
                    '<td><img src="' + getImageUrl(item.image_name) + '" width="30px"></td>' +
                    '<td>' +
                        '<button class="btn btn-outline-success btn-sm view" data-imgurl="' + getImageUrl(item.image_name) + '">Переглянути картинку</button>' +
                        '<button class="btn btn-outline-danger btn-sm delete-phone" data-id="' + item.id + '">Видалити</button>' +
                    '</td>' +
                '</tr>';
            });
            $('#phonebookListTable tbody').html(html);
        });
    }

    /**
     * Get image url
     *
     * @param {string} imageName
     * @return {string}
     */
    function getImageUrl(imageName) {
        return '/phone_images/' + imageName;
    }
});