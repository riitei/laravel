１２３４５６
<br><br>
顯示 <br><br>
{{$data['name'].' '.$data['year']}}
<br><br>
//------------判斷 name 是否為空-----------------------<br><br>

<br><br>
01: {{isset($name)?$name:'空'}}
<br><br>
02: {{$name or '空值'}}
<br><br>
//------------顯示javascript-----------------------<br><br>

{!! $city !!}
<br><br>

@if($data['year']>1984)
    小 <br>
@else
    大 <br>
@endif

<br><br>
//-----------除非------------------------<br><br>

@unless($data['year']<1984)
    比我小<br>
@endunless

//-----------for------------------------<br><br>

@for($i=0;$i <($data['year']/100);$i++)
    {{$i+2}}
@endfor

<br><br>
//----------foreach-------------------------<br><br>

@foreach ($data['airport'] as $key=>$value)
    {{$key}}
    @if (($loop->first)==2)
        {{$value}}<br>
    @endif
@endforeach

<br><br>
//----------foreach 增強版 沒資料顯在 @ empty -------------------------<br><br>

<br><br>

@forelse($data['airports'] as  $value)
    {{$value}}
@empty
    空
@endforelse