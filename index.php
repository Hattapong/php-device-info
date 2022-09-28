<?php

include_once('__head.php');

include_once('./db/database.php');

$rows = Database::getTable('select * from customer');

?>
<div class="container">
    <h1 class="mt-2">Device Info</h1>

    <div class="card">
        <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, porro nisi ratione aut culpa architecto iusto
            laborum illum ullam, beatae reprehenderit eius est adipisci dolores at tempore? Modi, facere minus.
        </div>
    </div>


</div>



<?php include_once('__foot.php'); ?>