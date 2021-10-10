@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100">
            <div class="card">
                <div class="card-header">{{ \Carbon\Carbon::now()->format("Y/m/d") }}　利用状況</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>


                        <table class="table table-bordered">
                            <thead>
                                <th>名前</th>
                                <th>午前</th>
                                <th>午後</th>
                            </thead>
                            <tbody>
                            @foreach  ( $reservations as $reservation )
                            <tr>
                                <td>{{ $reservation[0]}}</td>
                                <td>{{ $reservation[1]}}</td>
                                <td>{{ $reservation[2]}}</td>
                            </tr>
                            @endforeach
                            

                            </tbody>
                        </table>
                        <div class="form-group row">
  {{Form::label('hoge', '（ラベル名称）', ['class' => 'col-md-3 col-form-label'])}}
  {{Form::text('hoge', old('hoge'), ['class' => 'col-md-9 form-control'])}}
  @if($errors->has('hoge'))
    @foreach($errors->get('hoge') as $message)
      <p class="offset-3 col-md-9 alert alert-danger">{{ $message }}</p>
    @endforeach
  @endif
</div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
