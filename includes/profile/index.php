<div class="row">
    <div class="col">
        <div class="row">
            <h1><?= $user["pseudo"] ?></h1>
        </div>
        <div class="row">
            <p>Total posts: <span style="color:gray"><?= $totalPosts ?></span></p>
        </div>
        <div class="row d-flex justify-content-left">
            <form method="post">
                <div class="flex-nav">
                        <input 
                            class="<?= isset($_POST['pictures']) ? 'nav-btn' : 'nav-btn-active' ?>" 
                            type="submit" name="themes" value="Themes">
                        <input 
                            class="<?= isset($_POST['pictures']) ? 'nav-btn-active' : 'nav-btn' ?>" 
                            type="submit" name="pictures" value="Pictures">
                </div>
            </form>
        </div>
    </div>
    <div class="col">
        <div class="pull-right">
            <div class="row">
                <img class="user-image" src="assets/img/user.svg"></img>
            </div>
            <?php
            if($userCanModify($PROFILE_USER_ID)) {
                echo '
                <div class="row d-flex justify-content-center">
                    <div class="flex-nav">
                        <button type="button" class="nav-icon" data-toggle="modal" data-target="#edit-pseudo">
                            <i class="fa fa-pencil fa-lg"></i>
                        </button>
                        <button type="button" class="nav-icon" data-toggle="modal" data-target="#confirm-remove-user">
                            <i class="fa fa-trash fa-lg"></i>
                        </button>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-pseudo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <link rel="stylesheet" href="styles/form.css">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="setpseudoform" enctype="multipart/form-data">
                <input type="hidden" name="user" value="<?= $user["id"] ?>">
                <div class=" font-weight-bold modal-header">
                    Edit Pseudo
                </div>
                <div class="modal-body">
                    <div class="form-label-group">
                        <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo" value="<?= $user["pseudo"] ?>" required autofocus>
                        <label for="pseudo">Pseudo</label>
                    </div>
                    <?php if (!empty($error)) {
                        echo "<div style='font-weight:bold;color:red;margin:4px;'>$error</div>";
                    } ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-danger" name="set-pseudo" type="submit" value="Change" />
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-remove-user" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="removeForm">
            <input type="hidden" name="user" value="<?= $user["id"] ?>">
            <div class="modal-content">
                <div class=" font-weight-bold modal-header">
                    Confirm Remove
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove your account ?</p>
                    <p class="text-danger font-weight-bold">All your pictures and themes will be lost...</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-danger" name="remove-user" type="submit" value="Remove my account" />
                </div>
            </div>
        </form>
    </div>
</div>
