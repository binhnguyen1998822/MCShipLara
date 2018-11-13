@extends('layouts.header')
@section('content')

<?php $user = Auth::user();?>
<form action="{{ url('pkhachhang') }}/{{$khachhang->id_kh}}" method="POST" enctype="multipart/form-data" onsubmit="return checkForm(this);">
{{ csrf_field() }}	
<div class="container-fluid">
<div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-nav-tabs">
            <div class="card-content"> 
			<input type="text" name="ghichu" id="ghichu" value="{{$khachhang->ghichu}}" class="form-control typeahead" autocomplete="off">			
			<input class="btn btn-primary pull-right" type="submit" name="myButton" value="Cập nhập">	
		<div class="clearfix"></div>
		</div>

</div>
</div>
</div>
</div>
</form>
<script type="text/javascript">
  var path = "{{ route('autocomplete') }}";
$('input.typeahead').typeahead({
	source:  function (query, process) {
	return $.get(path, { query: query }, function (data) {
			return process(data);
		});
	}
});
</script>
@endsection