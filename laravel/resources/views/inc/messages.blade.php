@if (Session::has('message'))
    @php
        $type = Session::get('message')['type'] ?? 'success';
        switch ($type) {
            case 'success':
                $icon = 'check-circle';
                $title = 'Success';
                break;
            case 'warning':
                $icon = 'exclamation-triangle';
                $title = 'Warning';
                break;
            case 'danger':
                $icon = 'ban';
                $title = 'Error';
                break;
        }
        $text = Session::get('message')['text'];
    @endphp
    <div class="alert alert-{{ $type }}" role="alert">
        <h4 class="alert-heading">
            <i class="fas fa-{{ $icon }}"></i> {{ $title }}
        </h4>
        <p>{{ $text }}</p>
    </div>
@endif


{{-- <div class="alert alert-{{ $type }}" role="alert">
    <h4 class="alert-heading">{{ $title }}</h4>
    <p>{{ Session::get('message')['text'] }}</p>
</div>

<i class="icon fa fa-{{ $icon }}"></i> --}}
