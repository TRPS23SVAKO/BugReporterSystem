@if($role)
    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium" style="background-color: #{{ $role->role_color }}; color: white;">
        {{ $role->display_name }}
    </span>
@else
    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium text-gray-400 italic">
        Nežinoma rolė
    </span>
@endif
