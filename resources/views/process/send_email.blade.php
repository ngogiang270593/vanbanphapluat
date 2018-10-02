@extends('master_user');
@section ('content')
<form method="post" action="{{route ('sent')}}"> 
<input type="hidden" name="_token" value="{{csrf_token()}}">
<label>Nhập Email</label>
<input type="email" name="email">
<label>Nhập Nội dung</label>
<input type="text" name="content">
<input type="submit" name="submit" value="Gửi Mail">
</form>

@endsection