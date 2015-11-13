$.extend( true, $.fn.dataTable.defaults, {
  columnDefs: [{
    targets   : 'no-sort',
    orderable : false,
  }],
});

function dataTableDelete( datatable, location, text )
{
  $('.data-table').on('click', '.action-delete', function ( event ) {
    
    var object = $(this);
    swal({
      title               : text.warning,
      text                : text.delete + ' ' + object.data('name'),
      type                : 'warning',
      showCancelButton    : true,
      confirmButtonColor  : '#DD6B55',
      confirmButtonText   : text.btn_delete,
      cancelButtonText    : text.btn_cancel,
      closeOnConfirm      : true,
      closeOnCancel       : true
    },
    function(isConfirm){
      if (isConfirm) {
        $.post(location, {'delete': object.data('id')}, function(data, textStatus, xhr) {
          if ( data > 0 )
            datatable.ajax.reload();
        });
      }
    });

  });
}