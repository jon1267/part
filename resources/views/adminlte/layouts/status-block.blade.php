<script>
    @if(session('status'))
    toastr.success("{{ session('status') }}");
    @endif

    @if(session('error'))
    toastr.error("{{ session('error') }}");
    @endif
</script>

{{-- свиталерт2, работает, инклюдить этот файл в гл. шаблон
    (не в той вьюхе, где возникает событие...)
<script>
    @if(session('status'))
    Swal.fire({
        toast: true,
        type: 'success',
        icon: 'success',
        position: 'top-end',
        title: "{{ session('status') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @endif

    @if(session('error'))
    Swal.fire({
        toast: true,
        type: 'error',
        icon: 'error',
        position: 'top-end',
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @endif
</script>
--}}
