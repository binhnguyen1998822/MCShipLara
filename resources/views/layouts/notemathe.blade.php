@extends('layouts.header')
@section('content')
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Ghi chú</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('pmathe') }}/{{$mathe->id}}" method="POST" enctype="multipart/form-data"
                              onsubmit="return checkForm(this);">
                            {{ csrf_field() }}
                            <input type="text" name="mt_note" id="mt_note" value="{{$mathe->mt_note}}"
                                   class="form-control" autocomplete="off">
                            <div class="col-sm-6 float-right">
                                <br>
                                <input class="btn btn-primary float-right" type="submit" name="myButton"
                                       value="Cập nhập">
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>





@endsection