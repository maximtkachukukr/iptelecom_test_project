<?php

declare(strict_types=1);

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/phonebook.js"></script>
    <title>Phonebook</title>
</head>
<body class="h-100">
    <div class="container h-100">
        <div class="row">
            <div class="col-12">
                <h1>Phonebook</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h4>Add new phone</h4>
                <form id="newPhonebookItemForm" enctype="multipart/form-data" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Ім'я</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp">
                        <div id="nameHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Прізвище</label>
                        <input type="text" class="form-control" name="surname" aria-describedby="surnameHelp">
                        <div id="surnameHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Номер телефону</label>
                        <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp">
                        <div id="phoneHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Електронна пошта</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Картинка</label>
                        <input alt="" type="file" class="form-control-file" id="image" name="image" aria-describedby="imageHelp">
                        <div id="imageHelp" class="form-text"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-8">
                <h4>Phonebook list</h4>
                <table id="phonebookListTable" class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ім'я</th>
                        <th scope="col">Прізвище</th>
                        <th scope="col">Номер телефону</th>
                        <th scope="col">Електронна пошта</th>
                        <th scope="col">Картинка</th>
                        <th scope="col">Дія</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="imageModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image</h5>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

</body>
</html>
