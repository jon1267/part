<script>
    @if(session('status'))
    toastr.success("{{ session('status') }}");
    @endif

    @if(session('error'))
    toastr.error("{{ session('error') }}");
    @endif
</script>
