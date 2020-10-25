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
                <form id="add_client" name="add_client" role="form" method="POST" autocomplete="off" enctype="multipart/form-data"
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
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="client_type">Client Type <span class="text-danger">*</span></label><br>

                                <input type="radio" name="client_type" id="client_typeI" value="Individual" checked="" required/> &nbsp;&nbsp;Individual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="client_type" id="client_typeC" value="Corporate"/>&nbsp;&nbsp;Corporate
                            </div>
                        </div>
                            <br/>

                        <div id="individual_client">
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
                                    <label for="fullname">Email</label>
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
                        </div>

                        <div id="corporate_client" class="hide">
                            <div class="row">

                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label for="companyName">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="" class="form-control" id="companyName" name="companyName" required>
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="companyType">Company Type <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="" class="form-control" id="companyType" name="companyType" required>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label for="CRNumber">Number of negotiation CR number</label>
                                    <input type="text" placeholder="" class="form-control" id="CRNumber" name="CRNumber">
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="financialNumber">Financial Number</label>
                                    <input type="text" placeholder="" class="form-control" id="financialNumber" name="financialNumber">
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="commercialRegister">Commercial Register</label>
                                    <input type="text" placeholder="" class="form-control" id="commercialRegister" name="commercialRegister">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="" class="form-control" id="mobile_company" maxlength="20"
                                           name="mobile_company">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">Alternate Number</label>
                                    <input type="text" placeholder="" class="form-control" id="alternate_company" maxlength="20"
                                           name="alternate_company">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">Address <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="" class="form-control" id="c_address" name="c_address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">Country <span class="text-danger">*</span></label>
                                    <select class="form-control select-change country-select2"
                                            name="c_country" id="c_country"
                                            data-url="{{ route('get.country') }}"
                                            data-clear="#c_city_id,#c_state">
                                        <option value=""> Select Country</option>

                                    </select>
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">State <span class="text-danger">*</span></label>
                                    <select id="c_state" name="c_state"

                                            data-url="{{ route('get.state') }}"
                                            data-target="#c_country"
                                            data-clear="#c_city_id"
                                            class="form-control state-select2 select-change">
                                        <option value=""> Select State</option>

                                    </select>
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">City <span class="text-danger">*</span></label>
                                    <input type="text" id="c_city_id" name="c_city_id"
                                           class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="fullname">Management: Position <span class="text-danger">*</span></label>
                                    <input type="text" id="m_position" name="m_position"
                                           class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label for="fullname">Management: Name <span class="text-danger">*</span></label>
                                    <input type="text" id="m_name" name="m_name"
                                           class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label for="fullname">Management: Number <span class="text-danger">*</span></label>
                                    <input type="text" id="m_number" name="m_number"
                                           class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label for="fullname">Management: Email <span class="text-danger">*</span></label>
                                    <input type="text" id="m_email" name="m_email"
                                           class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname">Management: Address <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="" class="form-control" id="m_address" name="m_address">
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
                        </div>

                        <div class="documents">
                            <label for="documents">Documents </label>
                            <input type="file" name="documents[]" class="form-control" multiple />
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
