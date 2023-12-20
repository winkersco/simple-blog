@if (Session::has('message'))
    @php
        $type = Session::get('message')['type'] ?? 'success';
        switch ($type){
            case 'success':
                $icon = 'check';
                $title = 'Success';
                break;
            case 'warning':
                $icon = 'exclamation';
                $title = 'Warning';
                break;
            case 'danger':
                $icon = 'ban';
                $title = 'Error';
                break;
        }
    @endphp
    <div class="alert alert-{{ $type }} alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5>
            <i class="icon fa fa-{{ $icon }}"></i> {{ $title }}
        </h5>

        <i class="icon fa fa-{{ $icon }}"></i> {{ $error }}
        {{ Session::get('message')['text'] }}
    </div>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
      </div>
@endif

