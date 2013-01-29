<script type="text/javascript" src="/js/datatables/media/js/jquery.dataTables.js">1;</script>
<style type="text/css">
    @import url('/js/datatables/media/css/demo_page.css');
    @import url('/js/datatables/media/css/demo_table.css');
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $(<?php echo $target; ?>).dataTable();
    });
</script>