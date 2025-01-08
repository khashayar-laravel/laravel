@props(["active"=>false,"url"=>"/","icon"=>null,"mobile"=>false])

@if($mobile)
    <a href="{{$url}}" class="block px-4 py-2 hover:bg-blue-700 {{$active ? 'text-yellow-500 font-bold':""}}">
        @if($icon)
            <i class="fa fa-{{$icon}} mr-1"></i>
        @endif
        {{$slot}}
    </a>
@else

<a href="{{$url}}" class="{{$active ? 'text-yellow-500 font-bold':""}}">
    @if($icon)
        <i class="fa fa-{{$icon}} mr-1"></i>
    @endif
    {{$slot}}

</a>
@endif
