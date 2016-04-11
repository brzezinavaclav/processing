<div class="container-fluid">
    <h1>Services <small><sup><a href="javascript:service_modal();"><span class="glyphicon glyphicon-plus-sign"></span> Add service</a></sup></small></h1>
    <table class="table table-condensed" id="services">
        <thead>
        <tr><th>Service</th><th>Price</th><th>Actions</th></tr>
        </thead>
    </table>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="service_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputService">Service</label>
                    <input type="text" class="form-control" id="inputService" placeholder="Service">
                </div>
                <div class="form-group">
                    <label for="inputPrice">Price</label>
                    <input type="number" class="form-control" id="inputPrice" placeholder="Price">
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function(){
        $('#services').DataTable( {
            "ajax": "functions.php?get_services",
            "columns": [
                { "data": "service" },
                { "data": "price" },
                { "data": "actions" }
            ],
            "iDisplayLength": 10
        } );
    });
</script>