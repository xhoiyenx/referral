  /**
   * Step 1
   * Init DataTable
   */
  $.fn.dataTableExt.sErrMode = 'throw';
  var dataTable = $('.data-table').DataTable(settings);

  /**
   * Step 2
   * Bind button for show form modal
   */
  $('.add-new').click(function(event) {
    event.preventDefault();
    $.get(route_create, function(data) {
      $('.modal-content').html(data);
      $('.modal').modal('show');
    });
  });

  /**
   * Step 3
   * Bind submitting form data
   */
  $('.modal').on('submit', '.form-ajax', function(event) {
    event.preventDefault();
    /*
    
    var formData = new FormData($('form')[0]);
    console.log(formData);
    $.post($(this).attr('action'), formData, function(data, textStatus, xhr) {
      $('.modal-content').html(data);
    });
    */
    $.ajax({
      url: $(this).attr('action'), 
      type: 'POST',             
      data: new FormData($(this)[0]),
      contentType: false,       
      cache: false,             
      processData:false,        
      success: function(data) {
        $('.modal-content').html(data);
      }
    });
  });

  /**
   * Step 4
   * Bind edit button
   */
  $('.data-table').on('click', '.action-edit', function(event) {
    event.preventDefault();
    $.get($(this).attr('href'), function(data) {
      $('.modal-content').html(data);
      $('.modal').modal('show');
    });
  });

  /**
   * Step 5
   * Bind delete action
   */
  dataTableDelete( dataTable, route, {
    warning: '{{ trans('ui.delete') }}',
    delete: '{{ trans('ui.confirm_delete') }}',
    btn_delete: '{{ trans('ui.yes') }}',
    btn_cancel: '{{ trans('ui.cancel') }}'
  });

  /**
   * Hide form and reload table
   */
  $('.modal').on('hide.bs.modal', function(event) {
    dataTable.ajax.reload();
  });
