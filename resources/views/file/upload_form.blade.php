<form action="{{ url('postUpload') }}" method="POST" enctype="multipart/form-data">
    <input type = "hidden" value="{!! csrf_token() !!}"  name="_token" >
 	<input type="file" name="book" />
 	<input type="submit">
</form>