<tr class="treegrid-{{ $r->role_id }} {{ $r->role_father_id != null ? 'treegrid-parent-' . $r->role_father_id : '' }} expanded" data-role-id="{{ $r->role_id }}">
    <td>
        <span class="text-name">{{ $r->name }}</span>
        {!! Form::hidden('role_id[]',$r->role_id,['class' => 'input-role_id']) !!}
        {!! Form::hidden('item_status[]','update',['class' => 'item_status']) !!}
    </td>
    <td>
        @include('temps.forms.inputNotLabel',[
            'input' => 'name[]', 
            'label' => trans('label.name'), 
            'value' => old('name',$r->name ?? null) , 
            'attr' => ['class' => 'input-name form-control', 'required']])
    </td>
    <td>
        @include('temps.forms.inputNumberNotLabel',[
            'input' => 'role[]', 
            'label' => trans('label.role'), 
            'value' => old('name',$r->role ?? null) , 
            'attr' => ['class' => 'role_number form-control','required']])
    </td>

    <td>
        @include('temps.forms.selectNotLabel',[
            'input' => 'role_father_id[]',
            'label' => trans('label.roleFather'), 
            'value' => old('role_father_id',$r->role_father_id ?? null), 
            'list' => $rolesSelect->whereNotIn('role_id',$r->role_id)->pluck('name','role_id'), 
            'attr' => ['placeholder' => trans('label.select'),'class' => 'role_father_id form-control']])
    </td>
    <td>
        @include('temps.forms.selectNotLabel',[
            'input' => 'role_action_id[]',
            'label' => trans('label.roleAction'), 
            'value' => old('role_action_id',$r->role_action_id ?? null), 
            'list' => $rolesActions, 
            'attr' => ['placeholder' => trans('label.select'),'class' => 'role_action_id form-control']])
    </td>
    <td>
        @include('temps.forms.selectNotLabel',[
            'input' => 'status[]',
            'label' => trans('label.status'), 
            'value' => old('status',$r->status ?? null), 
            'list' => EnumHelper::getEnum('StatusEnum'), 
            'attr' => ['placeholder' => trans('label.select'),'class' => 'input-status form-control','required']])
    </td>
    <td class="text-right">
        <div class="btn-group ml-auto">
            <button type="button" class="add-children btn-transition btn-sm btn btn-focus">
                <i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>
            </button>
            @if($r->allChildrenRoles->count() == 0)
                <button type="button" class="button-remove btn-transition btn-sm btn btn-danger">
                    <i class="fa fa-fw" aria-hidden="true" title="Copy to use trash"></i>
                </button>
            @endif
        </div>
    </td>
</tr>