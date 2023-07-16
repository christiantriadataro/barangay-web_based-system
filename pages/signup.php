<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
    </style>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            background-color: var($ --bs-primary);
            display: flex;
            width: 100%;
            padding: 100px 0px 318px 0px;
            justify-content: center;
            align-items: center;
        }

        .content1 {
            display: flex;
            width: 20%;
            flex-direction: column;
            align-items: flex-start;
            gap: 32px;
            flex-shrink: 0;
        }

        .content2 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            align-self: stretch;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
            align-self: stretch;
        }

        .header2 {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            align-self: stretch;
        }

        .form_figma {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            align-self: stretch;
        }

        .row_figma {
            display: flex;
            padding: 0px 0px 8px 0px;
            justify-content: space-between;
            align-items: center;
            align-self: stretch;
        }
        .row_figma2 {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
            align-self: stretch;
        }
    </style>
    <title>Document</title>
</head>
<body>
<div class="content1">
    <div class="header">
        <h1>Barangay </h1>
        <div class="header2">
            <h2>Sign up an account.</h2>
            <p>Welcome! Enter your details.</p>
        </div>
    </div>
    <div class="content2">
        <form style="width: 100%; display: flex; flex-direction: column;" >
            <div class="form_figma">
                <div class="form-group mb-3" style="width: 100%">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>
                <div class="form-group mb-3" style="width: 100%">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
            </div>
            <div class="row_figma">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Remember Me?
                        </label>
                    </div>
                <a href="">Forgot Password?</a>
            </div>
            <div class="actions">
                <div class="d-grid">
                    <button class="btn btn-lg btn-primary" type="button"><a href="login.php">Signup</a></button>
                </div>
            </div>
        </form>
    </div>
    <div class="row_figma2">
        <p>Already have an account?</p>
        <p><a href="login.php">Login</a></p>
    </div>
</div>
</body>
</html>
<?php
