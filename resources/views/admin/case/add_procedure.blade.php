@extends('admin.layout.app')
@section('title','Case Create')


@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>Add Procedure</h3>
        </div>

        <div class="title_right">
            <div class="form-group pull-right top_search">
                <a href="{{route('case-running.index')}}" class="btn btn-primary">Back</a>

            </div>
        </div>
    </div>
    <!------------------------------------------------ ROW 1-------------------------------------------- -->


    <form method="post" name="add_case" id="add_case" action="{{route('case-procedure.store')}}" class="">
        @csrf()
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Procedure Details</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Client Name<span class="text-danger">*</span></label>
                                <select class="form-control client_name" name="client_name">
                                    <option value="">Select client</option>
                                    @foreach($client_list as $list)
                                        <option value="{{ $list->id}}">{{  $list->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="procedureDetails">Procedure Details</label>
                                <textarea type="text" name="procedureDetails" id="procedureDetails" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="renewalDate">Renewal Date</label>
                                <input type="date" name="renewalDate" id="renewalDate" class="form-control" />
                            </div>
                        </div>

                            <div class="form-group pull-right">
                                <div class="col-md-12 col-sm-6 col-xs-12">


                                    <a class="btn btn-danger" href="{{route('case-running.index')}}">Cancel</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save" id="show_loader"></i>&nbsp;Save
                                    </button>
                                </div>

                            </div>

                    </div>
                </div>

            </div>

        </div>
        <!------------------------------------------------------- End ROw --------------------------------------------->

    </form>
    <input type="hidden" name="date_format_datepiker"
           id="date_format_datepiker"
           value="{{$date_format_datepiker}}">

    <input type="hidden" name="getCaseSubType"
           id="getCaseSubType"
           value="{{ url('getCaseSubType')}}">

    <input type="hidden" name="getCourt"
           id="getCourt"
           value="{{ url('getCourt')}}">
@endsection

@push('js')

    <script src="{{asset('assets/js/case/case-add-validation.js')}}"></script>
    <script src="{{asset('assets/admin/js/repeter/repeater.js') }}"></script>

@endpush
