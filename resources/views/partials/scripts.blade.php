<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script>
$(document).on('click', '.btn-view', function() {
    let nama = $(this).data('nama');
    let kontak = $(this).data('kontak');
    let alamat = $(this).data('alamat');
    let kebutuhan = $(this).data('kebutuhan') ?? '';
    let status = $(this).data('status');
    let user = $(this).data('user');
    let editUrl = $(this).data('edit-url');

    $('#customer-detail').html(`
        <p><strong>Nama : </strong> ${nama}</p>
        <p><strong>Kontak : </strong> ${kontak}</p>
        <p><strong>Alamat : </strong> ${alamat}</p>
        ${kebutuhan ? `<p><strong>Kebutuhan : </strong></p>
        <textarea class="form-control" rows="3" disabled>${kebutuhan}</textarea>` : ''}
        <p class="mt-2"><strong>Status : </strong> ${status}</p>
        <p><strong>Dibuat Oleh : </strong> ${user}</p>
    `);

    $('#btn-edit-customer').attr('href', editUrl);
    $('#viewCustomerModal').modal('show');
});
</script>


