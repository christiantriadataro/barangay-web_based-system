<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
</head>
<body>


<div class="mb-5 container">
    <div class="header">
        <h1>Barangay </h1>
        <div class="header2">
            <h2>Sign up an account.</h2>
            <p>Welcome! Enter your details.</p>
        </div>
    </div>

    <form id="registrationForm" method="post">
        <div class="row">
            <div class="col-4">
                <div class="mt-4 form-floating">
                    <input type="text" name="given_name" class="form-control" id="floatingInput"
                           value="<?php echo $_POST["given_name"] ?? ""; ?>">
                    <label for="floatingInput">Given Name</label>
                </div>
            </div>
            <div class="col-4">
                <div class="mt-4 form-floating">
                    <input type="text" name="middle_name" class="form-control" id="floatingInput"
                           value="<?php echo $_POST['middle_name'] ?? ""; ?>">
                    <label for="floatingInput">Middle Name</label>
                </div>
            </div>
            <div class="col-4">
                <div class="mt-4 form-floating">
                    <input type="text" name="last_name" class="form-control" id="floatingInput"
                           value="<?php echo $_POST['last_name'] ?? ""; ?>">
                    <label for="floatingInput">Last Name</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mt-4 form-floating">
                    <input type="email" class="form-control" id="floatingInput" name="email_address"
                           value="<?php echo $_POST['email_address'] ?? ""; ?>">
                    <label for="floatingInput">Email address</label>
                </div>
            </div>
            <div class="col-6">
                <div class="mt-4 form-floating">
                    <input type="date" class="form-control" id="floatingBirthday" placeholder="Birthday"
                           name="birthday" value="<?php echo $_POST['birthday'] ?? ""; ?>">
                    <label for="floatingBirthday">Birthday</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mt-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput"
                           name="first_address" value="<?php echo $_POST['first_address'] ?? ""; ?>">
                    <label for="floatingInput">Address (Unit No./House/Bldg Name)</label>
                </div>
            </div>
            <div class="col-6">
                <div class="mt-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput"
                           name="second_address" value="<?php echo $_POST['second_address'] ?? ""; ?>">
                    <label for="floatingInput">Address (Street/Village/Subdiv)</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mt-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput"
                           name="city" value="<?php echo $_POST['city'] ?? ""; ?>">
                    <label for="floatingInput">City</label>
                </div>
            </div>
            <div class="col-4">
                <div class="mt-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput"
                           name="zip_code" value="<?php echo $_POST['zip_code'] ?? ""; ?>">
                    <label for="floatingInput">Zip Code</label>
                </div>
            </div>
            <div class="col-4">
                <div class="mt-4 form-floating">
                    <input type="text" class="form-control" id="floatingInput"
                           name="region" value="<?php echo $_POST['region'] ?? ""; ?>">
                    <label for="floatingInput">Country/Region</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mt-4 form-floating">
                    <input type="number" class="form-control" id="floatingInput"
                           name="contact" value="<?php echo $_POST['contact'] ?? ""; ?>">
                    <label for="floatingInput">Contact</label>
                </div>
            </div>
            <div class="col-3">
                <div class="mt-4 p-2  input-group">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio"
                               aria-label="Radio button for following text input"
                               name="gender" value="Male" <?php echo (@$_POST["gender"] == 'Male') ? "checked" : "" ?>>
                    </div>
                    <label class="form-control" aria-label="Text input with radio button">Male</label>
                </div>
            </div>
            <div class="col-3">
                <div class="mt-4 p-2 input-group">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio"
                               aria-label="Radio button for following text input"
                               name="gender" value="Female"
                            <?php echo (@$_POST["gender"] == 'Female') ? "checked" : "" ?>>
                    </div>
                    <label class="form-control" aria-label="Text input with radio button">Female</label>
                </div>
            </div>
        </div>
        <p class="mt-5">Family members</p>
        <!-- Dependents area that have software patterns and can optimize using for loops   -->
        <?php for ($i = 0; $i < 4; $i++) { ?>
            <div class="row">
                <div class="col-3">
                    <div class="mt-4 form-floating">
                        <input type="text" class="form-control" id="floatingInput"
                               name="<?php echo "given_names[]" ?>"
                               value="<?php echo $user["dependents"]["given_names"][$i] ?? ""; ?>">
                        <label for="floatingInput"> Given Name </label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mt-4 form-floating">
                        <input type="text" class="form-control" id="floatingInput"
                               name="<?php echo "middle_names[]" ?>"
                               value="<?php echo $user["dependents"]["middle_names"][$i] ?? ""; ?>">
                        <label for="floatingInput"> Middle Name </label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mt-4 form-floating">
                        <input type="text" class="form-control" id="floatingInput"
                               name="<?php echo "last_names[]" ?>"
                               value="<?php echo $user["dependents"]["last_names"][$i] ?? ""; ?>">
                        <label for="floatingInput"> Last Name</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mt-4 form-floating">
                        <input type="date" class="form-control" id="floatingBirthday"
                               name="<?php echo "birthdays[]" ?>"
                               value="<?php echo $user["dependents"]["birthdays"][$i] ?? ""; ?>">
                        <label for="floatingBirthday"> Birthday</label>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--        button-->
        <div class="row">
            <div class="mt-3 col-12">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">I agree of the following information is
                    correct.</label>
            </div>
            <div class="mt-2 col-12">
                <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>

            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>

</body>
</html>