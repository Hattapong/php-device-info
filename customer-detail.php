<?php

include_once('__head.php');

include_once('./db/database.php');

function back()
{
    header('location:customer.php');
}

if (!$_GET['id']) back();

$customer = Database::getFirst("select * from customer where id=?", [$_GET['id']]);
if (!$customer) back();

?>
<div class="container pt-4">
    <div class="row">
        <div class="col">

            <h2>Customer Detail</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="list-group">
                <li class="list-group-item">ID: <?= $customer['id'] ?></li>
                <li class="list-group-item">
                    Name: <strong><?= $customer['name'] ?></strong>
                </li>
            </ul>
        </div>
    </div>



    <?php

    $devices = Database::getTable("select device.*, device_model.name AS model_name, device_brand.brand
    from customer_device
    INNER JOIN device 
         ON customer_device.device_id = device.id
     INNER JOIN device_model
         ON device.model_id = device_model.id
     INNER JOIN device_brand
         ON device_model.brand_id = device_brand.id
     WHERE customer_device.customer_id = ?", [$_GET['id']]);


    ?>

    <div class="row mt-3">
        <div class="col">
            <h3 class="">My Devices</h3>

            <?php

            if (!count($devices)) echo "<div class='alert alert-info'>No device.</div>";
            else {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">SN</th>
                        <th scope="col">Model</th>
                        <th scope="col">Brand</th>
                        <th scope="col"><span class="mdi mdi-application-edit"></span></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        foreach ($devices as $k => $device) {
                        ?>
                    <tr>
                        <td><?= $device['id'] ?></td>
                        <td><?= $device['sn'] ?></td>
                        <td><?= $device['model_name'] ?></td>
                        <td><?= $device['brand'] ?>.</td>
                        <td><button class="btn btn-danger"><span class="mdi mdi-delete"></button></td>
                    </tr>

                    <?php

                        }

                        ?>


                </tbody>
            </table>
            <?php

            }
            ?>
            <hr>

            <h3>Add Device</h3>

            <form action="customer-device-add.php" method="post" id="frm">
                <div class="container">
                    <div class="row mb-3 align-items-end">

                        <div class="col">
                            <label for="">Brand</label>
                            <select name="brand" class="form-control" id="select-brand">
                                <option value="">Select Brand</option>
                                <?php
                                $brands = Database::getTable("select * from device_brand");

                                foreach ($brands as $k => $brand) {
                                ?>
                                <option value="<?= $brand['id'] ?>"><?= $brand['brand'] ?></option>
                                <?php
                                }
                                ?>


                            </select>
                        </div>
                        <div class="col">
                            <label for="">Model</label>
                            <select name="model" class="form-control" id="select-model">
                                <option value="">Select Model</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Serial No.</label>
                            <select name="sn" class="form-control" id="select-sn">
                                <option value="">Select Serial No.</option>
                            </select>
                        </div>
                        <input type="hidden" name="customer_id" value="<?= $_GET['id'] ?>">
                        <div class="col">
                            <button class="btn btn-success"><span class="mdi mdi-content-save-plus"></span></button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="./jquery-3.6.1.min.js"></script>
<script>
$(function() {

    $(document).on('change', '#select-brand', function(e) {
        let id = e.target.value;
        if (!id) return;

        $.ajax("device-model-option.php?brand_id=" + id, {
            success: function(data) {
                let options = jQuery.parseJSON(data);

                $('#select-model').empty();
                $('#select-model').append("<option value=''>Select Model</option>")
                options.forEach(element => {
                    $('#select-model').append(element)
                });
            }
        })
    });

    $(document).on('change', '#select-model', function(e) {

        let id = e.target.value;
        if (!id) return;

        $.ajax("device-by-model-option.php?model_id=" + id, {
            success: function(data) {
                let options = jQuery.parseJSON(data);

                $('#select-sn').empty();
                $('#select-sn').append("<option value=''>Select Serial No.</option>")
                options.forEach(element => {
                    $('#select-sn').append(element)
                });
            }
        })
    });

    $(document).on('submit', '#frm', function(e) {

        // let brand_id = $("#frm [name=brand]").val();
        // let model_id = $("#frm [name=model]").val();
        let sn = $("#frm [name=sn]").val();

        // console.log([brand_id, model_id, sn]);
        // check input b4 submit
        // if (!sn || !brand_id || !model_id) {
        if (!sn) {
            e.preventDefault();
            alert('please select device');
        }
    });

});
</script>


<?php include_once('__foot.php'); ?>