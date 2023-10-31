<?php

declare(strict_types=1);

/** @var string[] $validationErrorMessages */
/** @var string[] $postParams */
/** @var null|string $errorMessage */
/** @var bool $isSignedUp */
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Title</title>
</head>
<body class="h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-4">
                <h1 class="h3 mb-3 fw-normal">Create new account</h1>
                <?php if ($isSignedUp): ?>
                    <h4>You signed-up! Try to <a href="/">login</a></h4>
                <?php elseif ($errorMessage !== null): ?>
                    <h4><?= $errorMessage ?></h4>
                <?php endif ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputLogin" class="form-label">Login</label>
                        <input name="login" type="text"
                               class="form-control <?= array_key_exists('login', $validationErrorMessages) ? 'is-invalid' : '' ?>"
                               value="<?= $postParams['login'] ?? null ?>"
                               id="exampleInputLogin">
                        <?php if (array_key_exists('login', $validationErrorMessages)): ?>
                            <div class="invalid-feedback"><?= $validationErrorMessages['login'] ?></div>
                        <?php endif ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email"
                               class="form-control <?= array_key_exists('email', $validationErrorMessages) ? 'is-invalid' : '' ?>"
                               value="<?= $postParams['email'] ?? null ?>"
                               id="exampleInputEmail1">
                        <?php if (array_key_exists('email', $validationErrorMessages)): ?>
                            <div class="invalid-feedback"><?= $validationErrorMessages['email'] ?></div>
                        <?php endif ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password"
                               class="form-control <?= array_key_exists('password', $validationErrorMessages) ? 'is-invalid' : '' ?>"
                               value="<?= $postParams['password'] ?? null ?>"
                               id="exampleInputPassword1">
                        <?php if (array_key_exists('password', $validationErrorMessages)): ?>
                            <div class="invalid-feedback"><?= $validationErrorMessages['password'] ?></div>
                        <?php endif ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
