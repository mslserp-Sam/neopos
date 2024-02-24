<x-master-layout>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  </head>
    <!-- start table -->
      <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <div class="input-group col-xl-4 col-sm-12 col-md-12">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control dt-search" placeholder="Search..." aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped border">

                </table>
            </div>
        </div>
      </div>
    <!-- end table -->
    @section('bottom_script')
    <script>
  
    
    
    
       document.addEventListener('DOMContentLoaded', (event) => {

        window.renderedDataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,                                                                                                                                                                         
                responsive: true,
                
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                  "type"   : "GET",
                  "url"    : '{{ route("transaction_history") }}',
                  "data"   : function( d ) {
                    d.search = {
                      value: $('.dt-search').val()
                    };
                    d.filter = {
                      column_status: $('#column_status').val()
                    }
                  },
                },
                columns: [
                   
                    {
                        data: 'display_name',
                        name: 'display_name',
                        title: "Provider Name"
                    },
                    {
                        data: 'neo_comm',
                        name: 'neo_comm',
                        title: "Commission"
                    },
                    {
                        data: 'status',
                        name: 'status',
                        title: "{{__('messages.status')}}"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: "Action"
                    }
                    
                ]
                
            });
      });

    function resetQuickAction () {
    const actionValue = $('#quick-action-type').val();
    console.log(actionValue)
    if (actionValue != '') {
        $('#quick-action-apply').removeAttr('disabled');

        if (actionValue == 'change-status') {
            $('.quick-action-field').addClass('d-none');
            $('#change-status-action').removeClass('d-none');
        } else {
            $('.quick-action-field').addClass('d-none');
        }
    } else {
        $('#quick-action-apply').attr('disabled', true);
        $('.quick-action-field').addClass('d-none');
    }
  }

  $('#quick-action-type').change(function () {
    resetQuickAction()
  });

  $(document).on('update_quick_action', function() {

  })

    $(document).on('click', '[data-ajax="true"]', function (e) {
      e.preventDefault();
      const button = $(this);
      const confirmation = button.data('confirmation');

      if (confirmation === 'true') {
          const message = button.data('message');
          if (confirm(message)) {
              const submitUrl = button.data('submit');
              const form = button.closest('form');
              form.attr('action', submitUrl);
              form.submit();
          }
      } else {
          const submitUrl = button.data('submit');
          const form = button.closest('form');
          form.attr('action', submitUrl);
          form.submit();
      }
  });
    
//  
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @endsection
</x-master-layout>

