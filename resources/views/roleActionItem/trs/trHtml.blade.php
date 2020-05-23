<td>
    {!! Form::hidden('role_action_item_id[]',$rai->role_action_item_id ?? null,['class' => 'role-action-item-id']) !!}
    {!! Form::hidden('remove[]','false',['class' => 'item_remove']) !!}
    @include('temps.forms.inputNotLabel',[
        'input' => 'name[]', 
        'label' => trans('label.name'), 
        'value' => old('name',$rai->name ?? null) , 
        'attr' => ['class' => 'input-name form-control', 'required']])
</td>
<td>
    @include('temps.forms.inputNotLabel',[
        'input' => 'slug[]', 
        'label' => trans('label.slug'), 
        'value' => old('name',$rai->slug ?? null) , 
        'attr' => ['class' => 'input-slug form-control', 'required']])
</td>
<td>
    @include('temps.forms.selectNotLabel',[
        'input' => 'status[]',
        'label' => trans('label.status'), 
        'value' => old('status',$rai->status ?? null), 
        'list' => EnumHelper::getEnum('StatusEnum'), 
        'attr' => ['placeholder' => trans('label.select'),'class' => 'input-status form-control','required']])
</td>
<td class="text-right">
    <div class="btn-group ml-auto">
        <button type="button" class="button-remove btn-transition btn-sm btn btn-danger">
            <i class="fa fa-fw" aria-hidden="true" title="Copy to use trash"></i>
        </button>
    </div>
</td>