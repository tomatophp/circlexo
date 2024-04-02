@if(has_app('circle-docs'))
<x-tomato-admin-dropdown-item type="link" icon="bx bxs-file-doc" :label="__('Add Docs')" href="{{ route('profile.docs.index') }}"/>
@endif
