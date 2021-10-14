@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 ">
            <div class="card mx-auto" style="max-width:600px;">
                <div class="card-header">{{ \Carbon\Carbon::now()->format("Y/m/d") }}　利用状況</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <table class="table table-bordered text-center">
                            <thead>
                                <th>名前</th>
                                <th>午前</th>
                                <th>午後</th>
                            </thead>
                                <tbody>
                                <!-- 自分以外 -->
                                @php $count_AM = 0; $count_PM=0;
                                @endphp

                                @if(isset( $reservations ))
                                @foreach  ( $reservations as $reservation )
                                <tr class="table-secondary">
                                    <td>{{ $reservation->user->name}}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" disabled="disabled"
                                                @php if($reservation->AM){echo "checked='checked'";  $count_AM++; } @endphp>
                                            <label class="custom-control-label" for=""></label>
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" disabled="disabled"
                                                @php if($reservation->PM){echo "checked='checked'";  $count_PM++; } @endphp>
                                            <label class="custom-control-label" for=""></label>
                                        </div>   
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                <!-- 自分 -->
                                <tr class="table-success">
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="switch1" 
                                                @php if($my_reservation){if($my_reservation->AM){echo "checked='checked'";  $count_AM++; }} @endphp>
                                            <label class="custom-control-label" for="switch1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="switch2" 
                                                @php if($my_reservation) if($my_reservation->PM){echo "checked='checked'";  $count_PM++; }  @endphp>
                                            <label class="custom-control-label" for="switch2"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>合計</td>
                                    <td>{{$count_AM }}</td>
                                    <td>{{$count_PM }}</td>
                                </tr>
                                </tbody>
                        </table>
                        <div class="text-right mr-2"><button type="button" class="btn btn-primary">変更する</button></div>
                       

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
