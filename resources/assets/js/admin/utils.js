let bootstrap = require('bootstrap-sass');
let sweetalert = require('sweetalert');
let datatables = require('datatables.net');
let datatablesBootstrap = require('datatables-bootstrap3-plugin');
let Dropzone = require('dropzone');
let bootstrapSelect = require('bootstrap-select');


$(() => {
  // Get current URL path and assign 'active' class
  $('.nav > li > a[href="'+ window.location+ '"]').parent().addClass('active');

  // Get loading icon on form submit
  $('form').on('submit', function(e) {
      let $this = $(this);
      let submitButton = $this.find('button[type=submit]');
      submitButton.html(submitButton.data('loading-text')).prop('disabled', 'disabled');
  });

  // Enable sweet alert confirmation for content delete
  $(".btn-delete").on('click', function(e) {
    e.preventDefault();
    confirmDelete($(this));
  });

  // Enable and config datatables
  configDatatables();
});

(function() {
    Dropzone.options.images = {
        paramName           :       "image", // The name that will be used to transfer the file
        maxFilesize         :       2, // MB
        dictDefaultMessage  :       "Drop File here or Click to upload Image",
        thumbnailWidth      :       "300",
        thumbnailHeight     :       "300",
        accept              :       function(file, done) { done() },
        success             :       uploadSuccess,
        complete            :       uploadCompleted
    };

    function uploadSuccess(data, file) {
        var messageContainer    =   $('.dz-success-mark'),
            message             =   $('<p></p>', {
                'text' : 'Image Uploaded Successfully! Image Path is: '
            }),
            imagePath           =   $('<a></a>', {
                'href'  :   JSON.parse(file).original_path,
                'text'  :   JSON.parse(file).original_path,
                'target':   '_blank'
            })

        imagePath.appendTo(message);
        message.appendTo(messageContainer);
        messageContainer.addClass('show');
    }

    function uploadCompleted(data) {
        if(data.status != "success")
        {
            var error_message   =   $('.dz-error-mark'),
                message         =   $('<p></p>', {
                    'text' : 'Image Upload Failed'
                });

            message.appendTo(error_message);
            error_message.addClass('show');
            return;
        }
    }
})();


function confirmDelete($this) {
  swal({
    title: $this.data('swal-title'),
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: $this.data('swal-confirm'),
    cancelButtonText: $this.data('swal-cancel'),
  },
  function () {
    $this.parents('form').submit()
  });
}

function configDatatables()
{
  $('table').DataTable({
    // Disable sorting on the sorting_disabled class
    "aoColumnDefs" : [ {
      "bSortable" : false,
      "aTargets" : [ "sorting_disabled" ]
    } ],
    "order": [
      [1, 'asc']
    ],

    // Go to datatables.net to find translations for your language
    "language":
    {
      "processing": "Przetwarzanie...",
      "search": "Szukaj:",
      "lengthMenu": "Pokaż _MENU_ pozycji",
      "info": "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
      "infoEmpty": "Pozycji 0 z 0 dostępnych",
      "infoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
      "infoPostFix": "",
      "loadingRecords": "Wczytywanie...",
      "zeroRecords": "Nie znaleziono pasujących pozycji",
      "emptyTable": "Brak danych",
      "paginate": {
        "first": "Pierwsza",
        "previous": "Poprzednia",
        "next": "Następna",
        "last": "Ostatnia"
      },
      "aria": {
        "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
        "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
      }
    }
  });
}
