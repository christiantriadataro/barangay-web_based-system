<?php
// front-end
include_once("../../components/admin/base.php");
include_once("../../components/admin/header.php");
include_once("../../components/admin/sidebar.php");

require_once "../../modules/request.php";
require_once "../../modules/resident.php";
require_once "../../modules/authentication.php";

$request = Request::getInstance();
$residents = Request::getInstance()->getResidentsName();
$status = Request::getInstance()->displayStatus();
$types = Request::getInstance()->displayRequestedType();
[$requests, $pagination] = $request->getRequestsPagination();
$authentication = Authentication::getInstance();
?>
    <div class="ms-5 mt-4">
        <h3>Requests Table</h3>
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-end " style="width: 90%; padding-bottom: 0;">
                <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal"
                        data-bs-target="#add-request">
                    Add Request
                </button>
            </div>
            <!--Table-->
            <table class="table table-hover table-sm align-self-center mt-3" style="width: 85%; ">
                <thead style="font-size: 18px;">
                <tr class="">
                    <th scope="col" class="p-3">Name</th>
                    <th scope="col" class="p-3">Status</th>
                    <th scope="col" class="p-3">Requested Date</th>
                    <th scope="col" class="p-3">Due Date</th>
                    <th scope="col" class="p-3">Request Type</th>
                    <th scope="col" class="p-3">Status</th>
                </tr>
                </thead>
                <tbody style="font-size: 14px;">
                <?php foreach ($requests as $request) { ?>
                    <tr>
                        <td class="p-3"><?php echo $request["name"] ?></td>
                        <td class="p-3"><?= $request['status'] ?></td>
                        <td class="p-3"><?php echo $request["requested_date"] ?></td>
                        <td class="p-3"><?php echo $request["due_date"] ?></td>
                        <td class="p-3"><?php echo $request["request_type"] ?></td>
                        <td class="px-3 pb-3 pt-2">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-request-<?= $request['request_id'] ?>">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete-request-<?= $request['request_id'] ?>">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            <!--Edit modal-->
                            <form action="requests.php" method="post">
                                <div class="modal fade modal-xl" id="edit-request-<?= $request['request_id'] ?>"
                                     tabindex="-1" aria-labelledby="modal-title"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title fw-bold">Edit Request</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelect" name="resident_id">
                                                                <?php foreach ($residents as $resident) { ?>
                                                                    <option value="<?= $resident['resident_id'] ?>"><?= $resident['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label for="floatingSelect">Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelect" name="status">
                                                                <?php foreach ($status as $stat) { ?>
                                                                    <option value="<?= $stat ?>"><?= $stat ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label for="floatingSelect">Status</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="date" class="form-control" id="floatingInput"
                                                                       placeholder=" " name="requested_date" value="<?= $request['requested_date'] ?>">
                                                                <label for="floatingInput">Requested Date</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <div class="form-floating mb-3">
                                                                <input required type="date" class="form-control" id="floatingInput"
                                                                       placeholder=" " name="due_date"  value="<?= $request['due_date'] ?>">
                                                                <label for="floatingInput">Due Date</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelect" name="request_type">
                                                                <option value="<?= $request['request_type'] ?>"><?= $request['request_type'] ?></option>
                                                                <?php foreach ($types as $type) { ?>
                                                                        <?php if ($type != strtolower($request['request_type'])) { ?>
                                                                                <option value="<?= $type ?>"><?= $type ?></option>
                                                                        <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                            <label for="floatingSelect">Request Type</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-light" name="updateRequest">Save
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
                            <form action="requests.php" method="post">
                                <div class="modal fade modal-xs" id="delete-request-<?= $request['request_id'] ?>"
                                     tabindex="-1" aria-labelledby="modal-title"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title fw-bold">Delete Request</h4>
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
                                                                   name="request_id" value="<?= @$request['request_id'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" name="deleteRequest">Confirm</button>
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
    <form action="requests.php" method="post">
        <!--   Add Request Modal     -->
        <div class="modal fade modal-xl" id="add-request" tabindex="-1" aria-labelledby="modal-title"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fw-bold">Add Request</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="resident_id">
                                        <?php foreach ($residents as $resident) { ?>
                                            <option value="<?= $resident['resident_id'] ?>"><?= $resident['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="floatingSelect">Name</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="status">
                                        <?php foreach ($status as $stat) { ?>
                                            <option value="<?= $stat ?>"><?= $stat ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="floatingSelect">Status</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="date" class="form-control" id="floatingInput"
                                               placeholder=" " name="requested_date">
                                        <label for="floatingInput">Requested Date</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-floating mb-3">
                                        <input required type="date" class="form-control" id="floatingInput"
                                               placeholder=" " name="due_date">
                                        <label for="floatingInput">Due Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="request_type">
                                        <?php foreach ($types as $type) { ?>
                                            <option value="<?= $type ?>"><?= $type ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="floatingSelect">Request Type</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-light" name="addRequest">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


<?php
include_once("../../components/admin/footer.php");
require_once "../../modules/authentication.php";
$requests = Request::getInstance();
$authentication = Authentication::getInstance();

if (isset($_POST['addRequest'])) {
    // Retrieve data from the second modal form (inside the first modal)
    @$resident_id = $_POST['resident_id'];
    @$status = $_POST['status'];
    @$requested_date = $_POST['requested_date'];
    @$due_date = $_POST['due_date'];
    @$requested_type = $_POST['request_type'];
    $requests->createRequest($resident_id, $status, $requested_date, $due_date, $requested_type);
}

if (isset($_POST['updateRequest'])) {
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

    $requests->updateRequest($resident_id, $given_name, $middle_name, $last_name, $birth_date, $birth_place, $number, $address);
    $authentication->updateAuthentication($resident_id, $authen_email, $authen_password);
}

if (isset($_POST['deleteRequest'])) {
    @$resident_id = $_POST['resident_id'];
    $requests->deleteRequest($resident_id);
    $authentication->deleteAuthentication($resident_id);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>