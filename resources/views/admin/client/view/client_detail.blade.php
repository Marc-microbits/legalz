@extends('admin.layout.app')
@section('title','Client Detail')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h4>Client Name : {{$name}} </h4>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="{{ request()->is('admin/clients/*') ? 'active' : '' }}"><a
                                href="{{ route('clients.show', [$client->id]) }}">Client Detail</a>
                        </li>

                        @if($adminHasPermition->can(['case_list']) =="1")
                            <li class="{{ request()->is('admin/client/case-list/*') ? 'active' : '' }}"
                                role="presentation"><a href="{{route('clients.case-list',[$client->id])}}">Cases</a>
                            </li>
                        @endif


                        @if($adminHasPermition->can(['invoice_list']) =="1")
                            <li class="{{ request()->is('admin/client/account-list/*') ? 'active' : '' }}"
                                role="presentation"><a
                                    href="{{route('clients.account-list',[$client->id])}}">Account</a>
                            </li>
                        @endif
                    </ul>

                </div>

                <div class="x_content">

                    <div class="dashboard-widget-content">
                        <div class="col-md-6 hidden-small">
                            <table class="countries_list">
                                <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td class="fs15 fw700 text-right">{{ $client->full_name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td class="fs15 fw700 text-right">{{ $client->mobile ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Alternate Number</td>
                                    <td class="fs15 fw700 text-right">{{ $client->alternate_no ?? '' }} </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="fs15 fw700 text-right s">{{ $client->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Address :</td>
                                    <td class="fs15 fw700 text-right">{{ $client->address ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td class="fs15 fw700 text-right">{{ $client->country->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td class="fs15 fw700 text-right">{{ $client->state->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td class="fs15 fw700 text-right">{{ $client->city_id }}</td>
                                </tr>
                                <tr>
                                    <td>Reference Name</td>
                                    <td class="fs15 fw700 text-right">{{ $client->reference_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Reference Mobile</td>
                                    <td class="fs15 fw700 text-right">{{ $client->reference_mobile ?? '' }}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            Documents:<br/>
                            @if(is_array(json_decode($client->documents)))
                                @foreach(json_decode($client->documents) as $document)
                                    @php $ext = 'png'; if(substr($document, -3) == 'pdf') $ext = 'pdf'; @endphp
                                    <div class="file" style="position: relative;float: left;width: fit-content;margin-right: 20px;">
                                        <a href="/upload/files/{{$document}}" target="_blank"><img src="/assets/images/{{$ext == 'pdf' ? 'pdf-icon.png' : 'photo-icon.png'}}" style="width: 60px;"/></a>
                                        <i class="fa fa-close delete-doc" data-doc="{{$document}}" style="position: absolute;top: 0;left: 100%;font-size: 12px;color: black;cursor: pointer;"></i>
                                    </div>
                                @endforeach
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(count($single)>0 && !empty($single))
                <div class="x_panel">

                    <div class="x_content">
                        <div class="dashboard-widget-content">
                            @php
                                $i=1;
                            @endphp
                            @if(isset($single) && !empty($single))
                                @foreach($single as $s)
                                    <div class="col-md-6 hidden-small">
                                        <h4 class="line_30">Advocate</h4>


                                        <table class="countries_list">
                                            <tbody>

                                            <tr>
                                                <td>{{$i.' ) '.$s->party_firstname.' '.$s->party_middlename.' '.$s->party_lastname }}</td>

                                            </tr>
                                            <tr>
                                                <td>Mobile :- {{ $s->party_mobile}}</td>

                                            </tr>
                                            <tr>
                                                <td>Address :-{{ $s->party_address}}</td>

                                            </tr>
                                            @if($client->client_type=="multiple")
                                                <tr>
                                                    <td>Advocate:-{{ $s->party_advocate}}</td>

                                                </tr>

                                            @endif


                                            </tbody>
                                        </table>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                            @endif


                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $(".delete-doc").on('click', function(){
                $this = $(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '/admin/clients/delete-doc',
                    data: {
                        'doc' : $(this).data('doc'),
                        'id' : '{{$client->id}}'
                    },
                    success: function(e){
                        $this.closest('.file').remove();
                    }
                })
            })
        })
    </script>
@endpush
