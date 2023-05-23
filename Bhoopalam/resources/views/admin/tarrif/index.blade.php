@extends('admin.layouts.layouts')
@section('title', 'Dashboard')
@section('header-link')
    @parent
    {{-- custom link --}}
    <!--plugins-->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="my-2">
                <a class="btn btn-sm btn-success" href="javascript:void(0)" id="createNewData">
                    <i class="fadeIn animated bx bx-plus"></i>
                    Add Plan
                </a>
            </div>
        </div>

        <table class="table table-hover table-bordered data-table w-100">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>#</th>
                    <th>stat name</th>
                    <th>OPR Type</th>
                    <th>OPR Name</th>
                    <th>Plan Type</th>
                    <th>Amount</th>
                    <th>oldamt </th>
                    <th>Status </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dataForm" name="dataForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Stat Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="statname" name="statname"
                                            placeholder="Enter statname" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="oprtype" class="control-label">oprtype</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="oprtype" name="oprtype"
                                            placeholder="Enter oprtype" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="oprname" class="control-label">oprname</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="oprname" name="oprname"
                                            placeholder="Enter oprname" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="plantype" class="control-label">plantype</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="plantype" name="plantype"
                                            placeholder="Enter plantype" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">amount</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            placeholder="Enter amount" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="oldamt" class="control-label">oldamt</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="oldamt" name="oldamt"
                                            placeholder="Enter oldamt" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="vdays" class="control-label">vdays</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="vdays" name="vdays"
                                            placeholder="Enter vdays" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="description" class="control-label">description</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="description" name="description"
                                            placeholder="Enter description" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="slno" class="control-label">slno</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="slno" name="slno"
                                            placeholder="Enter slno" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="boxtype" class="control-label">boxtype</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="boxtype" name="boxtype"
                                            placeholder="Enter boxtype" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="orn" class="control-label">orn</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="orn" name="orn"
                                            placeholder="Enter orn" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="control-label">status</label>
                                    <div class="col-sm-12">

                                        <select class="form-control" id="status" name="status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 mt-2">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Create New
                                Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewModel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">View Data</h5>
                    <button class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="vewDataBody" class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    @parent
    <!--plugins-->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tarrif-plans.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        'visible': false
                    },
                    {
                        data: 'statname',
                        name: 'statname'
                    },
                    {
                        data: 'oprtype',
                        name: 'oprtype'
                    },
                    {
                        data: 'oprname',
                        name: 'oprname'
                    },
                    {
                        data: 'plantype',
                        name: 'plantype'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'oldamt',
                        name: 'oldamt'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]

            });
            $('#createNewData').click(function() {
                $('#saveBtn').val("create-data");
                $('#saveBtn').text("Add Plan");
                $('#id').val('');
                $('#dataForm').trigger("reset");
                $('#modelHeading').html("Create New Plan");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editData', function() {
                var id = $(this).data('id');
                $.get("{{ route('tarrif-plans.index') }}" + '/' + id + '/edit', function(data) {

                    $('#modelHeading').html("Edit Data");
                    $('#saveBtn').val("edit-data");
                    $('#saveBtn').text("Update Plan");
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#statname').val(data.statname);
                    $('#oprtype').val(data.oprtype);
                    $('#oprname').val(data.oprname);
                    $('#plantype').val(data.plantype);
                    $('#amount').val(data.amount);
                    $('#oldamt').val(data.oldamt);
                    $('#vdays').val(data.vdays);
                    $('#description').val(data.description);
                    $('#slno').val(data.slno);
                    $('#boxtype').val(data.boxtype);
                    $('#orn').val(data.orn);
                    $('#status').val(data.status);
                })
            });

            $('body').on('click', '.viewData', function() {
                var id = $(this).data('id');
                $.get("{{ route('tarrif-plans.index') }}" + '/' + id + '/edit', function(data) {

                    $('#viewModel').modal('show');
                    $('#vewDataBody').html('<table class="table bable-border table-primary"><tr><td><p><b>Stat Name</b></p>'+data.statname+'</td><td><p><b>OPR Type</b></p>'+data.oprtype+'</td></tr><tr><td><p><b>OPR Name</b></p>'+data.oprname+'</td><td><p><b>Plan Type</b></p>'+data.plantype+'</td></tr><tr><td><p><b>Stat Amount</b></p>'+data.amount+'</td><td><p><b>old amt</b></p>'+data.oldamt+'</td></tr><tr><td><p><b>V days</b></p>'+data.vdays+'</td><td><p><b>Description</b></p>'+data.description+'</td></tr><tr><td><p><b>slno</b></p>'+data.slno+'</td><td><p><b>boxtype</b></p>'+data.boxtype+'</td></tr><tr><td><p><b>orn</b></p>'+data.orn+'</td><td><p>status</b></p>'+data.status+'</td></tr></table>');

                })
            });
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#dataForm').serialize(),
                    url: "{{ route('tarrif-plans.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        $('#dataForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                        if (response.status == true) {
                            Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-check-circle',
                                msg: response.msg
                            });
                        } else {
                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-check-circle',
                                msg: response.msg
                            });
                            $('#saveBtn').html('Save Changes');
                        }
                    },
                });
            });
            $('body').on('click', '.deleteData', function() {
                var id = $(this).data("id");
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('tarrif-plans.store') }}" + '/' + id,
                            success: function(response) {
                                table.draw();
                                if (response.status == true) {
                                    Lobibox.notify('success', {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        icon: 'bx bx-check-circle',
                                        msg: response.msg
                                    });
                                } else {
                                    Lobibox.notify('error', {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        icon: 'bx bx-check-circle',
                                        msg: response.msg
                                    });
                                }

                            },
                        });
                        $(this).parents("tr").animate({
                                backgroundColor: "#003"
                            }, "slow")
                            .animate({
                                opacity: "hide"
                            }, "slow");
                        setInterval(function() {
                            $('#altMSG').html('');
                        }, 5000);
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

            });
            $(document).ready(function() {
                $(document).on("change", "input[name=toggle]", function(e) {
                    e.preventDefault();
                    var mode = $(this).prop('checked');
                    var id = $(this).val();
                    $.ajax({
                        url: "{{ route('tarrif-plans.status') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            mode: mode,
                            id: id,
                        },
                        success: function(response) {
                            if (response.status == true) {
                                Lobibox.notify('success', {
                                    pauseDelayOnHover: true,
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    icon: 'bx bx-check-circle',
                                    msg: response.msg
                                });
                            } else {
                                Lobibox.notify('warning', {
                                    pauseDelayOnHover: true,
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    icon: 'bx bx-check-circle',
                                    msg: response.msg
                                });
                            }
                        }
                    })

                })
            })
        });

        $('.toggle-icon').click();
    </script>
@endsection
