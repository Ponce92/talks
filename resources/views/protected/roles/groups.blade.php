<div class="row">
    <div class="col-md-12 mb-1">
        <strong>Permisos de :: {{$user->getName()}}</strong>
    </div>
</div>
<ul class="file-tree-groups">
    @foreach($groupsTypes as $pivot)
        <li><a href="#">{{$pivot->cs_group}}</a>
            <ul>
                @foreach($groups as $pvt2)
                    @if($pvt2->cs_group == $pivot->cs_group)
                        <li>
                            <input type="checkbox"
                                   value="{{$pvt2->getId()}}"
                                   name="optCheckboxes"
                                   @foreach($user->groups as $pvt3)
                                   @if($pvt2->getId() == $pvt3->getId())
                                   checked
                                   @endif
                                   @endforeach
                                   id="checkg-{{$pvt2->getId()}}">
                            <label for="checkg-{{ $pvt2->getId() }}">{{ $pvt2->getName() }}</label>
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
            onclick="saveChangeTreeCheckbox('{{ route('update.rol.permisions',$user->getId()) }}','optCheckboxes','{{$user->getId()}}');"
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

        $(".file-tree-groups").filetree();
    })();

</script>
