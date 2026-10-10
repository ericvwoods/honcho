<?php
/* DataTables for PM list pages. Waits for window "load" so jQuery and
   DataTables (loaded by the template after the view) are ready. */
?>
<script>
window.addEventListener('load', function () {
    if (window.jQuery && jQuery.fn.DataTable) {
        jQuery('.pm-datatable').DataTable({ paging: true, searching: true, pageLength: 50, responsive: true, order: [] });
    }
});
</script>
