        <script type="text/javascript" src="<?= base_url('js/jquery-3.5.1.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('js/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript">
        $(document).ready( function () {
            $('#contenido').DataTable(
                {
                    "pageLength": 20,
                    "lengthChange": false
                }
            );
        });
        </script>
    </body>
</html>