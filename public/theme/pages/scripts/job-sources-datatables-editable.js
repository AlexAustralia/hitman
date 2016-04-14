var TableDatatablesEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
            $(nRow).find('[data-toggle="confirmation"]').confirmation({ container: 'body', btnOkClass: 'btn btn-sm btn-success', btnCancelClass: 'btn btn-sm btn-danger'});
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[2].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var index = aData[0];
            var jqInputs = $('input', nRow);

            // Update data on the server
            var el = $('.portlet-body');

            App.blockUI({
                target: el,
                animate: true,
                overlayColor: 'none'
            });

            ajax = $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type: 'POST',
                url: '/edit-lookups/job-sources/save',
                dataType: 'json',
                encode: true,
                data: {
                    index: index,
                    name: jqInputs[0].value,
                }
            })
                .done(function(response) {
                    App.unblockUI(el);
                    if (response == 'OK') {
                        // Server updated, update the table
                        oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
                        oTable.fnUpdate('<a class="delete" href="" data-toggle="confirmation" data-singleton="true">Delete</a>', nRow, 2, false);
                        oTable.fnDraw();

                        $(nRow).find('[data-toggle="confirmation"]').confirmation({ container: 'body', btnOkClass: 'btn btn-sm btn-success', btnCancelClass: 'btn btn-sm btn-danger'});

                        nEditing = null;
                        nNew = false;
                    }
                    else {
                        if(nNew){
                            oTable.fnDeleteRow(nRow);
                            nNew = false;
                            nEditing = null;
                        }
                        else {
                            restoreRow(oTable, nRow);
                            nEditing = null;
                        }
                        $('#error_ajax').find('p').html('This Job Source is already used! Be careful');
                        $('#error_ajax').modal('show');
                    }
                })
                .error(function() {
                    App.unblockUI(el);
                    if(nNew){
                        oTable.fnDeleteRow(nRow);
                        nNew = false;
                        nEditing = null;
                    }
                    else {
                        restoreRow(oTable, nRow);
                        nEditing = null;
                    }
                    $('#error_ajax').find('p').html('Some errors occurred while getting data from the server!');
                    $('#error_ajax').modal('show');
                });
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
            oTable.fnDraw();
        }

        var table = $('#job_sources');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 20,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#job_sources_wrapper");

        var nEditing = null;
        var nNew = false;

        $('#job_sources_new').click(function (e) {
            e.preventDefault();

            // If we already edit something
            if (nNew || nEditing) {
                $('#error_ajax').find('p').html('You cannot add a new row until you save/cancel the editing row!');
                $('#error_ajax').modal('show');
                return;
            }

            var aiNew = oTable.fnAddData(['', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            // Delete data on the server
            var el = $('.portlet-body');
            var aData = oTable.fnGetData(nRow);
            var index = aData[0];

            App.blockUI({
                target: el,
                animate: true,
                overlayColor: 'none'
            });

            ajax = $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                type: 'POST',
                url: '/edit-lookups/job-sources/delete',
                dataType: 'json',
                encode: true,
                data: {
                    index: index
                }
            })
                .done(function(response) {
                    App.unblockUI(el);
                    if (response == 'OK') {
                        // Server updated, delete line from the table
                        oTable.fnDeleteRow(nRow);
                    }
                    else {
                        $('#error_ajax').find('p').html('Cannot delete!<br>Some errors occurred while getting data from the server!');
                        $('#error_ajax').modal('show');
                    }
                })
                .error(function() {
                    App.unblockUI(el);
                    $('#error_ajax').find('p').html('Cannot delete!<br>Some errors occurred while getting data from the server!');
                    $('#error_ajax').modal('show');
                });
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});