<?php

declare(strict_types=1);

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/login.js"></script>
    <title>Title</title>
</head>
<body class="h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-4">
                <h1 class="h3 mb-3 fw-normal">Please Sign up</h1>
                <form>
                    <div class="mb-3">
                        <label for="exampleInputLogin" class="form-label">Login</label>
                        <input type="text" class="form-control" id="exampleInputLogin" aria-describedby="loginHelp">
                        <div id="loginHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="passHelp">
                        <div id="passHelp" class="form-text"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/signup">Create account</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
