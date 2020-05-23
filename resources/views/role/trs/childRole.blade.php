@include('role.trs.trHtmlForm',['r' => $childRole])

@if($childRole->allChildrenRoles)
    @foreach ($childRole->allChildrenRoles as $childrenRole)
        @include('role.trs.childRole', ['childRole' => $childrenRole])
    @endforeach
@endif