@props(['height', 'width', 'source'])
<div>
    <img src="{{ $source }}" alt="" style="height:{{ $height }}px; width:{{ $width }}px; object-fit:cover;">
</div>
