function confirm(id){
    $.ajax({
        'url': "functions.php?confirm&id="+id,
        'dataType': "json",
        'success': function(data) {
            if (data['error']=='no') {
                $("[href$='confirm("+id+"));']").replaceWith('<span>'+data['timestamp']+'</span>');
            }
            if (data['error']=='yes') alert(data['message']);
        }
    });
}
function delete_order(id){
    $.ajax({
        'url': "functions.php?delete_order&id="+id,
        'dataType': "json",
        'success': function(data) {
            if (data['error']=='yes') alert(data['message']);
            else $('#orders').DataTable().ajax.reload();
        }
    });
}
function service_modal(id){
    if(id){
        $('#service_modal .modal-title').html('Edit service');
        $('#service_modal .modal-footer').html('<a href="javascript:edit_service('+id+');" class="btn btn-primary">Save changes</a>');
        $.ajax({
            'url': "functions.php?get_service&id="+id,
            'dataType': "json",
            'success': function(data) {
                if (data['error']=='yes') $('#service_modal .modal-body').html(data['message']);
                else {
                    $('#inputService').val(data['service']);
                    $('#inputPrice').val(data['price']);
                }
            }
        });
        $('#service_modal').modal();
    }
    else{
        $('#service_modal .modal-title').html('New service');
        $('#service_modal .modal-footer').html('<a href="javascript:create_service();" class="btn btn-primary">Save changes</a>');
        $('#inputService').val('');
        $('#inputPrice').val('');
        $('#service_modal').modal();
    }
}
function edit_service(id){
    $.ajax({
        'url': "functions.php?edit_service&id="+id+"&service="+$('#inputService').val()+"&price="+$('#inputPrice').val(),
        'dataType': "json",
        'success': function(data) {
            if (data['error']=='yes') alert(data['message']);
            else{
                $('#services').DataTable().ajax.reload();
                $('#service_modal').modal('hide');
            }
        }
    });
}
function create_service(){
    $.ajax({
        'url': "functions.php?create_service&service="+$('#inputService').val()+"&price="+$('#inputPrice').val(),
        'dataType': "json",
        'success': function(data) {
            if (data['error']=='yes') alert(data['message']);
            else $('#services').DataTable().ajax.reload();
        }
    });
}
function delete_service(id){
    $.ajax({
        'url': "functions.php?delete_service&id="+id,
        'dataType': "json",
        'success': function(data) {
            if (data['error']=='yes') alert(data['message']);
            else $('#services').DataTable().ajax.reload();
        }
    });
}