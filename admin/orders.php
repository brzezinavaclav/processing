<div class="container-fluid">
    <h1>Orders</h1>
    <table class="table table-condensed" id="orders">
        <thead>
        <tr><th>Username</th><th>Email</th><th>Service</th><th>Period</th><th>Address</th><th>Status</th><th>Processed</th><th>Actions</th></tr>
        </thead>
    </table>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#orders').DataTable( {
            "ajax": "functions.php?get_orders",
            "columns": [
                { "data": "username" },
                { "data": "email" },
                { "data": "service" },
                { "data": "period" },
                { "data": "address" },
                { "data": "status" },
                { "data": "processed" },
                { "data": "actions" }
            ],
            "iDisplayLength": 10
        } );
    });
</script>