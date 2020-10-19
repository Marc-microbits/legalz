@extends('admin.layout.app')
@section('title','Client Create')
@section('content')
    @component('component.heading' , [
    'page_title' => 'Add Client',
    'action' => route('clients.index') ,
    'text' => 'Back'
     ])
    @endcomponent
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @include('component.error')
            <div class="x_panel">
                <form id="add_client" name="add_client" role="form" method="POST" autocomplete="nope"
                      action="{{route('clients.store')}}">
                    {{ csrf_field() }}
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

                            <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                                <label for="prefix">Prefix <span class="text-danger">*</span></label>
                                <select class="form-control" id="prefix" name="prefix">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Proff.">Proff.</option>
                                    <option value="Eng.">Eng.</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">First Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="f_name" name="f_name">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Middle Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="m_name" name="m_name">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Last Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="l_name" name="l_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Gender <span class="text-danger">*</span></label><br>

                                <input type="radio" name="gender" id="genderM" value="Male" checked="" required/> &nbsp;&nbsp;Male:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" id="genderF" value="Female"/>&nbsp;&nbsp;Female
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Email ID</label>
                                <input type="text" placeholder="" class="form-control" id="email" name="email">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="mobile" maxlength="20"
                                       name="mobile">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Alternate Number</label>
                                <input type="text" placeholder="" class="form-control" id="alternate_no"
                                       name="alternate_no" maxlength="10">
                            </div>
                            <div class="col-md-9 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Address <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Country <span class="text-danger">*</span></label>
                                <select class="form-control select-change country-select2"
                                        name="country" id="country"
                                        data-url="{{ route('get.country') }}"
                                        data-clear="#city_id,#state"
                                >
                                    <option value=""> Select Country</option>

                                </select>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">State <span class="text-danger">*</span></label>
                                <select id="state" name="state"

                                        data-url="{{ route('get.state') }}"
                                        data-target="#country"
                                        data-clear="#city_id"
                                        class="form-control state-select2 select-change">
                                    <option value=""> Select State</option>

                                </select>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">City <span class="text-danger">*</span></label>
                                <input type="text" id="city_id" name="city_id"
                                        class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">Reference Name </label>
                                <input type="text" placeholder="" class="form-control" id="reference_name"
                                       name="reference_name">
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="client_code">Invitation code </label><br/>
                                <span style="font-size: 24px;">{{$uniqid}}</span>
                                <input type="hidden" placeholder="" id="client_code"
                                       name="client_code" value="{{$uniqid}}" />
                            </div>

                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <br>
{{--                            <input type="checkbox" value="Yes" name="change_court_chk" id="change_court_chk"> Add more--}}
{{--                            person--}}
                            <br/>

                        </div>
                        <div id="change_court_div" class="hidden">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">Client <span class="text-danger">*</span></label><br>
                                    <br>
                                    <input type="radio" name="type" id="test6" value="single" checked="" required/>
                                    &nbsp;&nbsp;Single Advocate:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="type" id="test7" value="multiple"/>&nbsp;&nbsp;Multiple
                                    Advocate
                                </div>
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <a href="{{ route('clients.index')  }}" class="btn btn-danger">Cancel</a>
                                <input type="hidden" name="route-exist-check"
                                       id="route-exist-check"
                                       value="{{ url('admin/check_client_email_exits') }}">
                                <input type="hidden" name="token-value"
                                       id="token-value"
                                       value="{{csrf_token()}}">

                                <button type="submit" class="btn btn-success"><i class="fa fa-save"
                                                                                 id="show_loader"></i>&nbsp;Save
                                </button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/selectjs.js')}}"></script>
    <script src="{{asset('assets/admin/vendors/repeter/repeater.js')}}"></script>
    <script src="{{asset('assets/admin/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{asset('assets/js/client/add-client-validation.js')}}"></script>
@endpush
