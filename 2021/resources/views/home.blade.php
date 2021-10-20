@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 row">
            <div class="col-sm-6">
                <div class="card mx-auto" style="max-width:600px;">
                    <div class="card-header">{{ $date->format("Y/m/d") }}　利用状況</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <form action="{{ url('/home')}}" method="post">
                            @csrf
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
                                    <tr class="table-secondary" id="myTable">
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
                                                <input type="checkbox" class="custom-control-input" id="switch1" name="AM" onChange="check_AM()"
                                                    @php if($my_reservation){if($my_reservation->AM){echo "checked='checked'";  $count_AM++; }} @endphp>
                                                <label class="custom-control-label" for="switch1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch2" name="PM" onChange="check_PM()"
                                                    @php if($my_reservation) if($my_reservation->PM){echo "checked='checked'";  $count_PM++; }  @endphp>
                                                <label class="custom-control-label" for="switch2"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>合計</td>
                                        <td><input type="number" name="" id="count_AM" disabled="disabled" class="no-style" <?php echo "value='$count_AM'"; ?> ></td>
                                        <td><input type="number" name="" id="count_PM" disabled="disabled" class="no-style" <?php echo "value='$count_PM'"; ?> ></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div>
                                <!-- フラッシュメッセージ -->
                                @if (session('flash_message'))
                                    <span class="float-left ml-2 bg-danger text-white p-2 rounded-pill" id="flash">
                                        {{ session('flash_message') }}
                                    </span>
                                @endif
                                <span class="float-right mr-2">
                                    <input type="submit" id="btn-submit" class="btn btn-primary" value="登録する"></submit></div>
                                </span>
                            </form>

                        </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        MENU
                    </div>
                    <div class="card-body">
                    <!-- 右列カード内のアコーディオン -->

                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                予約一覧
                                </button>
                            </h5>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                日付選択
                                </button>
                            </h5>
                            </div>
                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">



                                <div id='calendar'></div>

     

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                一括入力
                                </button>
                            </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                            </div>
                            </div>
                        </div>
                    </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
function check_AM(){
    let count_AM = document.getElementById('count_AM');
    let AM = document.getElementById('switch1');
    console.log(AM.checked);
    if(AM.checked){
        count_AM.value=parseInt(count_AM.value)+1

    }else{
        count_AM.value=parseInt(count_AM.value)-1
    }
    // ボタン非活性
    let btn = document.getElementById('btn-submit');
    if(count_AM.value>5){
            btn.disabled = true
    }else{
            btn.disabled = false
    }
}

function check_PM(){
    let count_PM = document.getElementById('count_PM');
    let PM = document.getElementById('switch2');
    console.log(PM.checked);
    if(PM.checked){
        console.log(count_PM);
        count_PM.value=parseInt(count_PM.value)+1
    }else{
        count_PM.value=parseInt(count_PM.value)-1
    }
        // ボタン非活性
    let btn = document.getElementById('btn-submit');
    if(count_PM.value>5){
            btn.disabled = true
    }else{
            btn.disabled = false
    }
}
function fadeout(){
    let flash = document.getElementById('flash');
    flash.style.display="none";
}
window.onload = function() {
    let flash = document.getElementById('flash');
    if(flash)
    setTimeout(fadeout,1000)
};
</script>
<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    <?php
        if($date)echo "now: '".$date."',";
        ?>
    dateClick: function(info) {
    info.dayEl.style.backgroundColor = 'red';
    location.href ="/home/"+info.dateStr;
  }
  });
  calendar.render();
});

</script>