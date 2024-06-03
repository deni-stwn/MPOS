<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ $message }}',
            showConfirmButton: false,
            timer: 3000,
        })
    </script>
@elseif($message = Session::get('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ $message }}',
        })
    </script>
@endif
