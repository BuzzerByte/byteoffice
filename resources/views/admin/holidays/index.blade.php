@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>

<script>
    init();

    function init() {
        $('.autocomplete_off').attr('autocomplete', 'off');
    }
    $(document.body).on('click', '.editHolidayModal', function () {
        $holiday_id = $(this).siblings('input').val();
        $('#editholidayform').attr('action', '/admin/holidays/' + $holiday_id);
        $.get('/admin/holidays/' + $holiday_id + '/edit', function (data) {
            $('.edit_name').val(data['name']);
            $('.edit_description').text(data['description']);
            $('.edit_start').val(data['start']);
            $('.edit_end').val(data['end']);
        });
    });

    $(document.body).on('click','.getDeleteHoliday',function(){
        $holiday_id = $(this).siblings('input').val();
        $('#form-d-holiday').attr('action','/admin/holidays/'+ $holiday_id+'/delete');
    });
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Holiday <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">List of Holiday</a></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>List of Holiday</h6>

                    </div>
                    <div class="actions">
                        <div class="row">
                            <div class="col-md-5">
                                @permission('holiday-create')
                                <button class="btn btn-primary btn-sm" data-target="#addHolidayModal"
                                    title="View" data-placement="top" data-toggle="modal" href="#"> <i class="icon-fa icon-fa-plus"></i>Add
                                    Holiday</button>
                                @endpermission
                                </div>
                            <div class="col-md-7">
                                <form action="#" class="form-inline" method="post" accept-charset="utf-8">
                                    @csrf
                                    
                                    <div class="input-group">
                                    <label>Year </label>
                                        <input type="text" id="year" class="form-control years input-md" name="year"
                                            value="2018">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn bg-olive">Go!</button>
                                        </span>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="#">
                        <div class="col-sm-12">

                            <div class="dt-buttons btn-group"><a class="btn btn-default buttons-copy buttons-html5 btn-sm"
                                    tabindex="0" aria-controls="DataTables_Table_0"><span>Copy</span></a><a class="btn btn-default buttons-csv buttons-html5 btn-sm"
                                    tabindex="0" aria-controls="DataTables_Table_0"><span>CSV</span></a><a class="btn btn-default buttons-excel buttons-html5 btn-sm"
                                    tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a><a class="btn btn-default buttons-pdf buttons-html5 btn-sm"
                                    tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a><a class="btn btn-default buttons-print btn-sm"
                                    tabindex="0" aria-controls="DataTables_Table_0"><span>Print</span></a></div>
                            <br>
                            <br>
                            <div class="table-responsive">
                                @permission('holiday-list')
                                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <!-- Table head -->
                                        <tr>
                                            <th>Holiday</th>
                                            <th>Description</th>
                                            <th>Start
                                                Date</th>
                                            <th>End
                                                Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead><!-- / Table head -->
                                    <tbody>
                                        <!-- / Table body -->

                                        <!--get all sub category if not this empty-->
                                        @foreach($holidays as $holiday)
                                        <tr>
                                            <td>{{
                                                $holiday->name }}</td>
                                            <td>{{ $holiday->description }}</td>
                                            <td>{{ Carbon\Carbon::parse(
                                                $holiday->start)->format('d M Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse(
                                                $holiday->end)->format('d M Y') }}</td>
                                            <td>


                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <input type="hidden" value="{{ $holiday->id }}">
                                                    @permission('holiday-edit')
                                                    <button type="button" class="btn btn-icon btn-outline-info editHolidayModal"
                                                        data-target="#editHolidayModal" data-placement="top"
                                                        data-toggle="modal"><i class="icon-fa icon-fa-pencil"></i></button>
                                                    @endpermission
                                                    @permission('holiday-delete')
                                                        <button type="button" class="btn btn-icon btn-outline-danger getDeleteHoliday"
                                                    data-target="#deleteHolidayModal" data-placement="top"
                                                    data-toggle="modal"><i class="icon-fa icon-fa-trash"></i></button>
                                                    @endpermission
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endpermission
                            </div>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addHolidayModal" style="display: none;">
    @include('admin.holidays.create')
</div>
<div class="modal fade" id="editHolidayModal" style="display: none;">
    @include('admin.holidays.edit')
</div>
<div class="modal fade" id="deleteHolidayModal" style="display: none;">
    @include('admin.holidays.delete')
</div>
@endsection