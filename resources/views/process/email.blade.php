<p> &nbsp; &nbsp; Xin chào bạn <strong>{{$name}}</strong>!</p></br>

<p>  &nbsp; &nbsp; Đây là danh sách gói thầu mới nhất theo chủ đề của bạn với từ khóa là: 
@foreach ($keyword as $key => $values)
        <strong style="overflow: hidden;"><span>{{$values->keyword}}</span></strong>
       @if ($key < (count($keyword)-1)) <label style="margin-left: -5px; ">,</label>
       @else <label style="margin-left: -3px; ">.</label>
       @endif
 @endforeach
</p> </br> </br>
<table border="1">

<tr> <th align="center"> Stt </th> <th>Tên gói thầu</th><th>Bên mời thầu</th> </tr>
<?php $i = 1; ?>
	@foreach ($noidung as $value)
	
		
		<tr>
		<td> {{$i}}</td>
				
		<td>
			<a style="text-decoration: none;" href="{!!$value->link!!}"> {!!$value->title!!}</a>
		</td>
		<td>
			<span>{!!$value->bidder!!}</span>
		</td>
		
		
		</tr>
		<?php $i++;?>

	
	@endforeach
	
</table>