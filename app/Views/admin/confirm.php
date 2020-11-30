<div class="container">
    <div class="row justify-content-md-center">
        <form action="<?php echo $ruta; ?>" method="post">
            <h1>Esta SEGURO?!</h1>
            <div class="col-md-12 text-center">
                <input type="hidden" name="Id" value="<?php echo $id; ?>">
                <input class="btn btn-dark" type="submit" value="Si">
                <a class="btn btn-dark" href="<?php echo previous_url(); ?>">No</a>
            </div>
        </form>
    </div>
</div>