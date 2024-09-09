<footer class="main-footer text-sm">
    <strong>Copyright © <?php echo date('Y') ?>. 
    </strong>
    All rights reserved. FROM: SWITCHIIFY PLATFORMS INC.
    <div class="float-right d-none d-sm-inline-block">
        <b><?php echo $_settings->info('short_name') ?></b> v1.0
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Dependencies -->
<script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url ?>dist/js/adminlte.js"></script>

<script>
$(document).ready(function(){
    // Viewer modal
    window.viewer_modal = function($src = ''){
        start_loader();
        var t = $src.split('.');
        t = t[1];
        var view;
        if(t == 'mp4'){
            view = $("<video src='"+$src+"' controls autoplay></video>");
        } else {
            view = $("<img src='"+$src+"' />");
        }
        $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove();
        $('#viewer_modal .modal-content').append(view);
        $('#viewer_modal').modal({
            show:true,
            backdrop:'static',
            keyboard:false,
            focus:true
        });
        end_loader();
    }

    // Uni modal
    window.uni_modal = function($title = '', $url = '', $size = ''){
        start_loader();
        $.ajax({
            url: $url,
            error: err => {
                console.log(err);
                alert("An error occurred");
            },
            success: function(resp){
                if(resp){
                    $('#uni_modal .modal-title').html($title);
                    $('#uni_modal .modal-body').html(resp);
                    if($size != ''){
                        $('#uni_modal .modal-dialog').addClass($size + ' modal-dialog-centered');
                    } else {
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered");
                    }
                    $('#uni_modal').modal({
                        show:true,
                        backdrop:'static',
                        keyboard:false,
                        focus:true
                    });
                    end_loader();
                }
            }
        });
    }

    // Confirm modal
    window._conf = function($msg = '', $func = '', $params = []){
        $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
        $('#confirm_modal .modal-body').html($msg);
        $('#confirm_modal').modal('show');
    }

    // Initialize Select2
    $('.select2').select2();
});
</script>
