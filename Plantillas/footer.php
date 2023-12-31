</main>
<footer>
    <!-- place footer here -->
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

<!-- script para usar jquery son funciones de jquery para usar los datatables -->
<script>
    $(document).ready(function() {
        $("#tabla_id").DataTable({
            // 3-> numero de registros que se muestran
            "pageLength": 5,
            lengthMenu: [
                [3, 10, 25, 50],
                [3, 10, 25, 50]
            ],
            "language": {
                "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
            }
        });
    });
</script>

<!-- Script para mensajes emergentes del sweetalert2 -->
<script>
    function mostrarAlerta(id) {
        Swal.fire({
            title: '¿Está seguro de eliminar el registro?',
            text: "No podrá deshacer los cambios.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar.',
            cancelButtonText: 'Cancelar.'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "index.php?txtId=" + id;
            }
        })
    }
</script>
</body>

</html>