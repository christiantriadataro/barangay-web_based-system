<?php
// front-end
include_once("../../components/admin/base.php");
include_once("../../components/admin/header.php");
include_once("../../components/admin/sidebar.php");

require_once "../../modules/resident.php";
require_once "../../modules/authentication.php";

$residents = Resident::getInstance();
[$residents, $pagination] = $residents->getResidentsPagination();
$authentication = Authentication::getInstance();
?>


    <div class="ms-5 mt-4">
        <h3>Residents Table</h3>
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-end " style="width: 90%; padding-bottom: 0;">
                <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
                        data-bs-target="#add-resident-authentication">
                    Add Resident
                </button>
            </div>
            <!--Table-->
            <table class="table table-hover table-sm align-self-center mt-3" style="width: 85%; ">
                <thead style="font-size: 18px;">
                <tr class="">
                    <th scope="col" class="p-3">Name</th>
                    <th scope="col" class="p-3">Birth Date</th>
                    <th scope="col" class="p-3">Birth Place</th>
                    <th scope="col" class="p-3">Contact Details</th>
                    <th scope="col" class="p-3">Address</th>
                    <th scope="col" class="p-3">Status</th>
                </tr>
                </thead>
                <tbody style="font-size: 14px;">
                <?php foreach ($residents as $resident) { ?>
                    <tr>
                        <th class="p-3"><?php echo $resident["resident_given_name"] . " " . $resident["resident_middle_name"] . " " . $resident["resident_last_name"] ?></th>
                        <td class="p-3"><?php echo $resident["resident_birth_date"] ?></td>
                        <td class="p-3"><?php echo $resident["resident_birth_place"] ?></td>
                        <td class="p-3"><?php echo $resident["resident_number"] ?></td>
                        <td class="p-3"><?php echo $resident["resident_address"] ?></td>
                        <td class="px-3 pb-3 pt-2">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-resident-<?= $resident['resident_id'] ?>">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete-resident-<?= $resident['resident_id'] ?>">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            <!--                            Edit modal-->
                            <form action="residents.php" method="post">
                                <?php [$resident['authen_email'], $resident['authen_password']] = $authentication->getAuthentication($resident['resident_id']); ?>
                                <div class="modal fade modal-xl" id="edit-resident-<?= $resident['resident_id'] ?>"
                                     tabindex="-1" aria-labelledby="modal-title"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title fw-bold">Edit Resident</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="email" class="form-control"  autocomplete="off" placeholder=" "
                                                                       name="authen_email" value="<?= @$resident['authen_email'] ?>">
                                                                <label for="floatingInput">Email address</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="password" class="form-control" autocomplete="off" placeholder=" "
                                                                       name="authen_password" value="<?= @$resident['authen_password'] ?>">
                                                                <label for="floatingInput">Password: </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="text" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_given_name" value="<?= @$resident['resident_given_name'] ?>">
                                                                <label for="floatingInput">Given Name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="text" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_middle_name" value="<?= @$resident['resident_middle_name'] ?>">
                                                                <label for="floatingInput">Middle Name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="text" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_last_name" value="<?= @$resident['resident_last_name'] ?>">
                                                                <label for="floatingInput">Last Name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="date" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_birth_date" value="<?= @$resident['resident_birth_date'] ?>">
                                                                <label for="floatingInput">Birthdate</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="text" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_birth_place" value="<?= @$resident['resident_birth_place'] ?>">
                                                                <label for="floatingInput">Birth Place</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="number" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_number" value="<?= @$resident['resident_number'] ?>">
                                                                <label for="floatingInput">Contact Number</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 offset-2">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="text" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_address" value="<?= @$resident['resident_address'] ?>">
                                                                <label for="floatingInput">Street Address</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col offset-2">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="hidden" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                       name="resident_id" value="<?= @$resident['resident_id'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-light" name="updateResident">Save
                                                    changes
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
<!--                            Delete modal-->
                            <form action="residents.php" method="post">
                                <div class="modal fade modal-xs" id="delete-resident-<?= $resident['resident_id'] ?>"
                                     tabindex="-1" aria-labelledby="modal-title"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title fw-bold">Delete Resident</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mt-1">
                                                    <div class="col-12">
                                                        <h6 class="modal-title fw-bold">Are you sure you want to Delete?</h6>
                                                    </div>
                                                </div>
                                                <div class="col offset-2">
                                                    <div class="form-group">
                                                        <div class="form-floating mb-3">
                                                            <input required type="hidden" class="form-control" id="floatingInput" autocomplete="off" placeholder=" "
                                                                   name="resident_id" value="<?= @$resident['resident_id'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" name="deleteResident">Confirm</button>
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <!--Alert-->

            <!--Pagination-->
            <nav aria-label="Page navigation example" style="margin-left: 118px;">
                <ul class="pagination pagination-sm">
                    <li class="page-item">
                        <a class="page-link <?= ($pagination['page_no'] <= 1) ? 'disabled' : "" ?>"
                            <?= ($pagination['page_no'] > 1) ? 'href=?page_no=' . $pagination['previous_page'] : ''; ?>
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($count = 1; $count <= $pagination['total']; $count++) { ?>
                        <li class="page-item">
                            <a class="page-link <?= ($pagination['page_no'] == $count) ? "active" : "" ?>"
                               href="?page_no=<?= $count; ?>"><?= $count; ?>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link <?= ($pagination['page_no'] >= $pagination['total']) ? 'disabled' : "" ?>"
                            <?= ($pagination['page_no'] < $pagination['total']) ? 'href=?page_no=' . $pagination['next_page'] : ''; ?>
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                <div class="">
                    <p>Page <?= $pagination['page_no']; ?> of <?= $pagination['total'] ?></p>
                </div>
            </nav>
        </div>
    </div>
    <!--Modal-->
    <form action="residents.php" method="post">
        <div class="modal  fade modal-lg" id="add-resident-authentication" tabindex="-1" aria-labelledby="modal-title"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header m-3">
                        <h4 class="modal-title fw-bold">Sign up a Resident</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <div class="col-8">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="email" class="form-control" id="authen_email"
                                               placeholder=" " name="authen_email">
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="password" class="form-control" id="authen_password"
                                               placeholder="Password:" name="authen_password">
                                        <label for="floatingInput">Password: </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="password" class="form-control" id="confirm_password"
                                               placeholder="Password:" name="confirm_password">
                                        <label for="floatingInput">Confirm Password: </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer m-3">
                        <button type="button" class="btn btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#add-resident"
                                onclick="transferValue()"
                                id="next" disabled
                        >Sign up
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--   Add Resident Modal     -->
        <div class="modal fade modal-xl" id="add-resident" tabindex="-1" aria-labelledby="modal-title"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fw-bold">Add Resident</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="email" class="form-control" id="authen_email_read"
                                               readonly>
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="password" class="form-control" id="authen_password_read"
                                               readonly>
                                        <label for="floatingInput">Password: </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="text" class="form-control" id="floatingInput"
                                               placeholder=" " name="resident_given_name">
                                        <label for="floatingInput">Given Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="text" class="form-control" id="floatingInput"
                                               placeholder=" " name="resident_middle_name">
                                        <label for="floatingInput">Middle Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="text" class="form-control" id="floatingInput"
                                               placeholder=" " name="resident_last_name">
                                        <label for="floatingInput">Last Name</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="date" class="form-control"
                                               id="floatingInput" placeholder=" "
                                               name="resident_birth_date"
                                        >
                                        <label for="floatingInput">Birthdate</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="text" class="form-control" id="floatingInput"
                                               placeholder=" "
                                               name="resident_birth_place"
                                        >
                                        <label for="floatingInput">Birth Place</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="number" class="form-control" id="floatingInput"
                                               placeholder=" "
                                               name="resident_number"
                                        >
                                        <label for="floatingInput">Contact Number</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="text" class="form-control" id="floatingInput"
                                               placeholder=" "
                                               name="resident_address"
                                        >
                                        <label for="floatingInput">Street Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-light" name="addResident">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


<?php
include_once("../../components/admin/footer.php");
require_once "../../modules/authentication.php";
$residents = Resident::getInstance();
$authentication = Authentication::getInstance();

if (isset($_POST['addResident'])) {
    // Retrieve data from the first modal form
    @$authen_email = $_POST['authen_email'];
    @$authen_password = $_POST['authen_password'];

    // Retrieve data from the second modal form (inside the first modal)
    @$given_name = $_POST['resident_given_name'];
    @$middle_name = $_POST['resident_middle_name'];
    @$last_name = $_POST['resident_last_name'];
    @$birth_date = $_POST['resident_birth_date'];
    @$birth_place = $_POST['resident_birth_place'];
    @$number = $_POST['resident_number'];
    @$address = $_POST['resident_address'];

    $residents->createResident($given_name, $middle_name, $last_name, $birth_date, $birth_place, $number, $address);
    $authentication->createAuthentication($authen_email, $authen_password);
}

if (isset($_POST['updateResident'])) {
    @$resident_id = $_POST['resident_id'];
    // Retrieve data from the first modal form
    @$authen_email = $_POST['authen_email'];
    @$authen_password = $_POST['authen_password'];

    // Retrieve data from the second modal form (inside the first modal)
    @$given_name = $_POST['resident_given_name'];
    @$middle_name = $_POST['resident_middle_name'];
    @$last_name = $_POST['resident_last_name'];
    @$birth_date = $_POST['resident_birth_date'];
    @$birth_place = $_POST['resident_birth_place'];
    @$number = $_POST['resident_number'];
    @$address = $_POST['resident_address'];

    $residents->updateResident($resident_id, $given_name, $middle_name, $last_name, $birth_date, $birth_place, $number, $address);
    $authentication->updateAuthentication($resident_id, $authen_email, $authen_password);
}

if (isset($_POST['deleteResident'])) {
    @$resident_id = $_POST['resident_id'];
    $residents->deleteResident($resident_id);
    $authentication->deleteAuthentication($resident_id);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>