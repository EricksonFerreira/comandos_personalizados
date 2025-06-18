<!-- Formulário de exclusão -->
<form action="{{ $action }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-xs btn-danger delete-button"><i class="fa fa-trash"></i> Excluir</button>
</form>

<!-- Inclua o SweetAlert -->
<script src="{{ asset('js/sweetAlert.min.js') }}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Script para interceptar a submissão do formulário e exibir o SweetAlert -->
<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(event) {
            event.preventDefault();
            const form = $(this).closest('form');
console.log(2);
            swal({
                title: "Você tem certeza?",
                text: "Esta ação não pode ser desfeita!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancelar",
                        value: null,
                        visible: true,
                        className: "btn-cancel",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Sim, excluir!",
                        value: true,
                        visible: true,
                        className: "btn-confirm",
                        closeModal: true
                    }
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    });
</script>
