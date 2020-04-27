
<div class="row">
    <div class="col-md-12 mb-1">
        <strong>Permisos de :: {{$rol->getName()}}</strong>
    </div>
</div>
<ul class="file-tree">
    @foreach($groups as $pivot)
        <li><a href="#">{{$pivot->cs_group}}</a>
            <ul>
                @foreach($permisions as $pvt2)
                    @if($pvt2->cs_group == $pivot->cs_group)
                    <li>
                        <input type="checkbox"
                               value="{{$pvt2->getId()}}"
                               name="optCheckboxes"
                                   @foreach($rol->permissions as $pvt3)
                                    @if($pvt2->getId() == $pvt3->getId())
                                    checked
                                    @endif
                               @endforeach
                               id="check-{{$pvt2->getId()}}">
                        <label for="check-{{ $pvt2->getId() }}">{{ $pvt2->getName() }}</label>
                    </li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>

<hr>
<div class="form-actions center">
    <button type="button"
            onclick="saveChangeTreeCheckbox('{{ route('update.rol.permisions',$rol->getId()) }}','optCheckboxes','{{$rol->getId()}}');"
            class="btn btn-green">
        <i class="icon-save"></i>
        Guardar</button>
</div>

<script type="text/javascript">
    (function() {
        var ga = document.createElement('script');

        ga.type = 'text/javascript';
        ga.async = true;
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

        $(".file-tree").filetree();
    })();

</script>














{{--<div class="row">--}}
{{--    <div class="col-xs-5 col-md-5">--}}
{{--        <p> Permisos disponibles</p>--}}
{{--        <select name="select_option" id="search" style="font-size: 1.1rem;" class="form-control" size="12" multiple="multiple">--}}
{{--            @foreach($permisions  as $pe)--}}
{{--                <option value="{{ $pe->getId() }}">{{ $pe->getName() }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
{{--    <div class="col-md-1" style="padding: 5px;">--}}
{{--        <br><br><br><br>--}}
{{--        <button type="button" id="search_rightSelected"--}}
{{--                class="btn btn-block btn-info btn-sm"><i class="icon-arrow-right2"></i>--}}
{{--        </button>--}}
{{--        <button type="button"--}}
{{--                id="search_leftSelected"--}}
{{--                class="btn btn-block btn-info btn-sm"><i class="icon-arrow-left2"></i></button>--}}
{{--        <br><br><br><br>--}}
{{--        <button type="button"--}}
{{--                class="btn btn-block btn-info btn-sm"--}}
{{--                onclick="saveChangeDual('#search_to','{{ $rol->getId() }}','{{ route('update.rol.permisions') }}')" >--}}
{{--            <i class="icon-save"></i>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    <div class="col-xs-5 col-md-5">--}}
{{--        <p>Permisos:: {{$rol->getName()}}</p>--}}
{{--        <select name="selected_options" id="search_to" class="form-control" style="font-size: 1.1rem;" size="12" multiple="multiple">--}}
{{--            @foreach($rol->permissions  as $pivot)--}}
{{--                <option value="{{ $pivot->getId() }}">{{ $pivot->getName() }}</option>--}}
{{--            @endforeach--}}

{{--        </select>--}}
{{--    </div>--}}
{{--</div>--}}
