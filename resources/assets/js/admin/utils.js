let sweetalert = require('sweetalert');
let datatables = require('datatables.net');
let datatablesBootstrap = require('datatables-bootstrap3-plugin');
let select2 = require('select2');
let Dropzone = require('dropzone');

var photo_counter = 0;
Dropzone.options.myAwesomeDropzone = false;
Dropzone.options.realDropzone = {

    uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 8,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',

    // The setting up of the dropzone
    init:function() {

        this.on("removedfile", function(file) {

            $.ajax({
                type: 'POST',
                url: 'upload/delete',
                data: {id: file.name, _token: $('#csrf-token').val()},
                dataType: 'html',
                success: function(data){
                    var rep = JSON.parse(data);
                    if(rep.code == 200)
                    {
                        photo_counter--;
                        $("#photoCounter").text( "(" + photo_counter + ")");
                    }

                }
            });

        } );
    },
    error: function(file, response) {
        if($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function(file,done) {
        photo_counter++;
        $("#photoCounter").text( "(" + photo_counter + ")");
    }
}

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
