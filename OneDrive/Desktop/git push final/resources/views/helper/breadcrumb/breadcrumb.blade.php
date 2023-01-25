@if ($flag == 'active')
<li class="breadcrumb-item active" aria-current="page">
    {{ $name }}
</li>
@else
<li class="breadcrumb-item" aria-current="page">
    <a href="{{ route($url) }}" class=""> {{ $name }}</a>
</li>
@endif