<div class="container">
    <div class="row justify-content-md-center">
        <form action="<?php echo $ruta; ?>" method="post">
            <h1>Esta SEGURO?!?!?!?!?!?!</h1>
            <input type="hidden" name="Id" value="<?php echo $id; ?>">
            <input type="submit" value="Si">
            <a href="<?php echo previous_url(); ?>">No</a>
        </form>
    </div>
</div>