@include('system.trs.trHtml',['r' => $childRole])

@if($childRole->allChildrenRoles)
    @foreach ($childRole->allChildrenRoles as $childrenRole)
        @include('system.trs.childRole', ['childRole' => $childrenRole])
    @endforeach
@endif