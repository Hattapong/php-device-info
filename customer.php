<?php
require_once('./__head.php');
require_once('./db/database.php');
session_start();


// $a = get_defined_vars();
// print_r($a);

?>


<div class="container">
    <h2 class="mt-3">Customer</h2>



    <form method="POST" action="customer-add.php">
        <div class="row mb-3">
            <strong>Add new</strong>
        </div>
        <div class="row ">


            <div class="col-md-4">
                <input type="text" maxlength="50" placeholder="Customer Name" name="customer_name" class="form-control"
                    id="customer-name">
            </div>
            <div class="col-auto"><button class="btn btn-success"><span class="mdi mdi-content-save-plus">
                        Save</span></button></div>
        </div>
    </form>

    <hr />
    <?php

    if (isset($_SESSION['add'])) {

        $success = $_SESSION['add'];
        unset($_SESSION['add']);

    ?>
    <div class="row mt-2">
        <div class="col">
            <?php

                echo $success
                    ? "<div class='alert alert-success' role='alert'>Item Added</div>"
                    : "<div class='alert alert-danger' role='alert'>Item Adding Failed!!!</div>";

                ?>


        </div>
    </div>

    <?php

    }

    ?>




    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $customers = Database::getTable("select * from customer");


            foreach ($customers as $k => $v) {
            ?>

            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= $v['name'] ?></td>
                <td>
                    <a class="btn btn-info" href="./customer-detail.php?id=<?= $v['id'] ?>">
                        <span class="mdi mdi-magnify"></span>
                    </a>
                </td>
            </tr>

            <?php
            }
            ?>


        </tbody>
    </table>
</div>



<?php
require_once('./__foot.php');
session_destroy();
?>