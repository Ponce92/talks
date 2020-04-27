@if(isset($flash))
    @switch($flash['type'])
        @case('success')
            <div class="alert alert-success msj">
                <i class="fas fa-check"></i>
                &nbsp;&nbsp;
                {{  $flash['message']}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @break
        @case('info')
            <div class="alert alert-info msj">
                <i class="fas fa-info-circle">&nbsp;</i>&nbsp;&nbsp;
                {{  $flash['message']}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @break
        @case('danger')
            <div class="alert alert-danger msj">
                <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;
                {{  $flash['message']}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @break
        @case('warning')
            <div class="alert alert-warning msj">
                <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;
                {{  $flash['message']}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @break
    @endswitch
@endif
