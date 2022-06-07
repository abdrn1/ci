<!-- BEGIN FOOTER -->
<div class="page-footer hide_print">
    <div style="text-align: center !important;color:gainsboro;" class=" text-center center-block">جميع الحقوق محفوظة &COPY; السلطان أنوار  0595516936</div>
    <div class="scroll-to-top" style="display: none;">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->



<script>
    $(document).ready(function () {

        $('.loadingimg').hide();

        $('#logout').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>main/logout',
                success: function (response) {
                    if (response == true) {
                        window.location = '<?php echo base_url(); ?>admin/view';
                    }
                }
            });
        });

    });

    //<div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div><div class="jqvmap-label"></div>
</script>

</body></html>