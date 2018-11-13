@extends('layouts.header')
@section('content')

<?php $user = Auth::user();?>
<form action="{{ url('pmathe') }}/{{$mathe->id}}" method="POST" enctype="multipart/form-data" onsubmit="return checkForm(this);">
{{ csrf_field() }}	
<div class="container-fluid">
<div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-nav-tabs">
            <div class="card-content"> 
			<input type="text" name="mt_note" id="mt_note" value="{{$mathe->mt_note}}" class="form-control" autocomplete="off">			
			<input class="btn btn-primary pull-right" type="submit" name="myButton" value="Cập nhập">	
		<div class="clearfix"></div>
		</div>

</div>
</div>
</div>
</div>
</form>
@endsection