@include('roleProfile.trs.trHtml',['r' => $childRole])

@if($childRole->allChildrenRoles)
    @foreach ($childRole->allChildrenRoles as $childrenRole)
        @include('roleProfile.trs.childRole', ['childRole' => $childrenRole])
    @endforeach
@endif