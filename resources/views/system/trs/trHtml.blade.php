<tr class="treegrid-{{ $r->role_id }} {{ $r->role_father_id != null ? 'treegrid-parent-' . $r->role_father_id : '' }} expanded">
    <td>{{ $r->name }}</td>
    <td>{{ $system->abrrev . '_' . $r->role }}</td>
    <td>{{ $r->roleAction->name }}</td>
    <td>{{ EnumHelper::getLabel('StatusEnum',$r->status) }}</td>
</tr>