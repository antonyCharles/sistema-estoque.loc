<tr class="treegrid-{{ $r->role_id }} {{ $r->role_father_id != null ? 'treegrid-parent-' . $r->role_father_id : '' }} expanded">
    <td>
        {{ $r->name }}
    </td>
    <td>{{ EnumHelper::getLabel('StatusEnum',$r->status) }}</td>
    <td class="text-center">
        <label class="custom-control custom-radio custom-control-inline">
            <input 
                type="checkbox" 
                name="totalNone[]" 
                class="radio-total custom-control-input" 
                value="T"
                {{ $r->roleAction->roleActionItens->count() == $profile->rolesprofile->where('role_id',$r->role_id)->count() ? 'checked' : ''}}
            />
            <span class="custom-control-label"></span>
        </label>
    </td>
    <td class="text-center">
        @foreach ($r->roleAction->roleActionItens as $actionItem)
            <div style="display:inline-block;margin:0px 20px">

            <input type="hidden" name="role_id[{{ $GLOBALS['roleCount'] }}]" value="{{ $r->role_id }}"/>
            <?php
                $ai = $profile->rolesprofile->where('role_id',$r->role_id)->where('role_action_item_id',$actionItem->role_action_item_id)->first();
            ?>
            <input 
                type="hidden" 
                name="role_profile_id[{{ $GLOBALS['roleCount'] }}]" 
                value="{{ isset($ai) ? $ai->role_profile_id : '' }}"/>
            <label class="custom-control custom-checkbox custom-control-inline">
                <input 
                    type="checkbox" 
                    name="role_action_item_id[{{ $GLOBALS['roleCount'] }}]" 
                    class="check check-create custom-control-input" 
                    value="{{ $actionItem->role_action_item_id }}"
                    {{ isset($ai) ? 'checked' : '' }}     
                />
                <span class="custom-control-label"></span>
            </label>
            <br/>
            {{ $actionItem->name }}
            </div>
            <?php $GLOBALS['roleCount']++; ?>
        @endforeach
    </td>
    <td class="text-center">
        <label class="custom-control custom-radio custom-control-inline">
            <input 
                type="checkbox" 
                name="totalNone[]" 
                class="radio-none custom-control-input"  
                value="N" 
                {{ $profile->rolesprofile->contains('role_id',$r->role_id) == false ? 'checked' : '' }}
            />
            <span class="custom-control-label"></span>
        </label>
    </td>
</tr>