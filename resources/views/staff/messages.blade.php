@if ($errors->any())
    @php
        $errorMessage = $errors->all()[0];
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Validation error',
                text: @json($errorMessage),
                confirmButtonText: 'Okay'
            });
        });
    </script>
@endif
