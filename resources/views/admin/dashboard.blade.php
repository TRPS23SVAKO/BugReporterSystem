<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Svetainės Nustatymai
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

{{--            --}}{{-- TAGS --}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="flex items-center justify-between">--}}
{{--                    <h3 class="text-lg font-medium text-gray-900">Tags</h3>--}}
{{--                </div>--}}

{{--                <form method="post" action="{{ route('admin.tags.store') }}" class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">--}}
{{--                    @csrf--}}
{{--                    <div>--}}
{{--                        <x-input-label for="tag_name" value="Name" />--}}
{{--                        <x-text-input id="tag_name" name="name" class="mt-1 block w-full" maxlength="50" required />--}}
{{--                        <x-input-error class="mt-2" :messages="$errors->get('name')" />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label for="tag_color" value="Color (hex, no #)" />--}}
{{--                        <x-text-input id="tag_color" name="color" class="mt-1 block w-full" maxlength="6" placeholder="e.g. FF8800" />--}}
{{--                        <x-input-error class="mt-2" :messages="$errors->get('color')" />--}}
{{--                    </div>--}}
{{--                    <div class="flex items-end">--}}
{{--                        <x-primary-button>Create</x-primary-button>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--                <div class="mt-6 overflow-x-auto">--}}
{{--                    <table class="min-w-full text-sm">--}}
{{--                        <thead>--}}
{{--                        <tr class="text-left text-gray-600">--}}
{{--                            <th class="py-2 pr-4">Name</th>--}}
{{--                            <th class="py-2 pr-4">Color</th>--}}
{{--                            <th class="py-2 pr-4">Preview</th>--}}
{{--                            <th class="py-2 pr-4">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody class="divide-y">--}}
{{--                        @foreach($tags as $tag)--}}
{{--                            <tr class="align-top">--}}
{{--                                <td class="py-3 pr-4 font-medium text-gray-900">{{ $tag->name }}</td>--}}
{{--                                <td class="py-3 pr-4 text-gray-700">{{ $tag->color ?? '—' }}</td>--}}
{{--                                <td class="py-3 pr-4">--}}
{{--                                    @if($tag->color)--}}
{{--                                        <span class="inline-flex items-center px-2 py-1 rounded text-white"--}}
{{--                                              style="background-color:#{{ $tag->color }};">#{{ $tag->color }}</span>--}}
{{--                                    @else--}}
{{--                                        —--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="py-3 pr-4">--}}
{{--                                    <div class="flex flex-col gap-2">--}}
{{--                                        <form method="post" action="{{ route('admin.tags.update', $tag) }}" class="grid grid-cols-1 md:grid-cols-3 gap-2">--}}
{{--                                            @csrf--}}
{{--                                            @method('patch')--}}
{{--                                            <x-text-input name="name" class="block w-full" value="{{ $tag->name }}" maxlength="50" required />--}}
{{--                                            <x-text-input name="color" class="block w-full" value="{{ $tag->color }}" maxlength="6" placeholder="hex" />--}}
{{--                                            <x-primary-button>Save</x-primary-button>--}}
{{--                                        </form>--}}

{{--                                        <form method="post" action="{{ route('admin.tags.destroy', $tag) }}">--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            <x-danger-button onclick="return confirm('Delete tag?')">Delete</x-danger-button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        @if($tags->isEmpty())--}}
{{--                            <tr><td class="py-4 text-gray-600" colspan="4">No tags yet.</td></tr>--}}
{{--                        @endif--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- BUG LEVELS --}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <h3 class="text-lg font-medium text-gray-900">Bug levels</h3>--}}

{{--                <form method="post" action="{{ route('admin.bug-levels.store') }}" class="mt-4 grid grid-cols-1 md:grid-cols-6 gap-4">--}}
{{--                    @csrf--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Type" />--}}
{{--                        <x-text-input name="type" class="mt-1 block w-full" maxlength="20" required />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Key" />--}}
{{--                        <x-text-input name="key" class="mt-1 block w-full" maxlength="20" required />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Label" />--}}
{{--                        <x-text-input name="label" class="mt-1 block w-full" maxlength="50" required />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Sort" />--}}
{{--                        <x-text-input name="sort_order" type="number" class="mt-1 block w-full" min="0" max="65535" value="0" />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Color (hex)" />--}}
{{--                        <x-text-input name="color" class="mt-1 block w-full" maxlength="6" />--}}
{{--                    </div>--}}
{{--                    <div class="flex items-end gap-3">--}}
{{--                        <label class="inline-flex items-center gap-2 text-sm text-gray-700">--}}
{{--                            <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300">--}}
{{--                            Active--}}
{{--                        </label>--}}
{{--                        <x-primary-button>Create</x-primary-button>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--                <div class="mt-6 overflow-x-auto">--}}
{{--                    <table class="min-w-full text-sm">--}}
{{--                        <thead>--}}
{{--                        <tr class="text-left text-gray-600">--}}
{{--                            <th class="py-2 pr-4">Type</th>--}}
{{--                            <th class="py-2 pr-4">Key</th>--}}
{{--                            <th class="py-2 pr-4">Label</th>--}}
{{--                            <th class="py-2 pr-4">Sort</th>--}}
{{--                            <th class="py-2 pr-4">Active</th>--}}
{{--                            <th class="py-2 pr-4">Color</th>--}}
{{--                            <th class="py-2 pr-4">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody class="divide-y">--}}
{{--                        @foreach($bugLevels as $lvl)--}}
{{--                            <tr class="align-top">--}}
{{--                                <td class="py-3 pr-4">{{ $lvl->type }}</td>--}}
{{--                                <td class="py-3 pr-4">{{ $lvl->key }}</td>--}}
{{--                                <td class="py-3 pr-4 font-medium text-gray-900">{{ $lvl->label }}</td>--}}
{{--                                <td class="py-3 pr-4">{{ $lvl->sort_order }}</td>--}}
{{--                                <td class="py-3 pr-4">{{ $lvl->is_active ? 'Yes' : 'No' }}</td>--}}
{{--                                <td class="py-3 pr-4">--}}
{{--                                    @if($lvl->color)--}}
{{--                                        <span class="inline-flex items-center px-2 py-1 rounded text-white"--}}
{{--                                              style="background-color:#{{ $lvl->color }};">#{{ $lvl->color }}</span>--}}
{{--                                    @else--}}
{{--                                        —--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="py-3 pr-4">--}}
{{--                                    <div class="flex flex-col gap-2">--}}
{{--                                        <form method="post" action="{{ route('admin.bug-levels.update', $lvl) }}" class="grid grid-cols-1 md:grid-cols-7 gap-2">--}}
{{--                                            @csrf--}}
{{--                                            @method('patch')--}}
{{--                                            <x-text-input name="type" class="block w-full" value="{{ $lvl->type }}" maxlength="20" required />--}}
{{--                                            <x-text-input name="key" class="block w-full" value="{{ $lvl->key }}" maxlength="20" required />--}}
{{--                                            <x-text-input name="label" class="block w-full" value="{{ $lvl->label }}" maxlength="50" required />--}}
{{--                                            <x-text-input name="sort_order" type="number" class="block w-full" min="0" max="65535" value="{{ $lvl->sort_order }}" />--}}
{{--                                            <x-text-input name="color" class="block w-full" value="{{ $lvl->color }}" maxlength="6" />--}}
{{--                                            <label class="inline-flex items-center gap-2 text-sm text-gray-700">--}}
{{--                                                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ $lvl->is_active ? 'checked' : '' }}>--}}
{{--                                                Active--}}
{{--                                            </label>--}}
{{--                                            <x-primary-button>Save</x-primary-button>--}}
{{--                                        </form>--}}

{{--                                        <form method="post" action="{{ route('admin.bug-levels.destroy', $lvl) }}">--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            <x-danger-button onclick="return confirm('Delete bug level?')">Delete</x-danger-button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        @if($bugLevels->isEmpty())--}}
{{--                            <tr><td class="py-4 text-gray-600" colspan="7">No bug levels yet.</td></tr>--}}
{{--                        @endif--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- BUG STATUSES --}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <h3 class="text-lg font-medium text-gray-900">Bug statuses</h3>--}}

{{--                <form method="post" action="{{ route('admin.bug-statuses.store') }}" class="mt-4 grid grid-cols-1 md:grid-cols-5 gap-4">--}}
{{--                    @csrf--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Key" />--}}
{{--                        <x-text-input name="key" class="mt-1 block w-full" maxlength="20" required />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Label" />--}}
{{--                        <x-text-input name="label" class="mt-1 block w-full" maxlength="50" required />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Sort" />--}}
{{--                        <x-text-input name="sort_order" type="number" class="mt-1 block w-full" min="0" max="65535" value="0" />--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <x-input-label value="Color (hex)" />--}}
{{--                        <x-text-input name="color" class="mt-1 block w-full" maxlength="6" />--}}
{{--                    </div>--}}
{{--                    <div class="flex items-end gap-3">--}}
{{--                        <label class="inline-flex items-center gap-2 text-sm text-gray-700">--}}
{{--                            <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300">--}}
{{--                            Active--}}
{{--                        </label>--}}
{{--                        <x-primary-button>Create</x-primary-button>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--                <div class="mt-6 overflow-x-auto">--}}
{{--                    <table class="min-w-full text-sm">--}}
{{--                        <thead>--}}
{{--                        <tr class="text-left text-gray-600">--}}
{{--                            <th class="py-2 pr-4">Key</th>--}}
{{--                            <th class="py-2 pr-4">Label</th>--}}
{{--                            <th class="py-2 pr-4">Sort</th>--}}
{{--                            <th class="py-2 pr-4">Active</th>--}}
{{--                            <th class="py-2 pr-4">Color</th>--}}
{{--                            <th class="py-2 pr-4">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody class="divide-y">--}}
{{--                        @foreach($bugStatuses as $st)--}}
{{--                            <tr class="align-top">--}}
{{--                                <td class="py-3 pr-4">{{ $st->key }}</td>--}}
{{--                                <td class="py-3 pr-4 font-medium text-gray-900">{{ $st->label }}</td>--}}
{{--                                <td class="py-3 pr-4">{{ $st->sort_order }}</td>--}}
{{--                                <td class="py-3 pr-4">{{ $st->is_active ? 'Yes' : 'No' }}</td>--}}
{{--                                <td class="py-3 pr-4">--}}
{{--                                    @if($st->color)--}}
{{--                                        <span class="inline-flex items-center px-2 py-1 rounded text-white"--}}
{{--                                              style="background-color:#{{ $st->color }};">#{{ $st->color }}</span>--}}
{{--                                    @else--}}
{{--                                        —--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="py-3 pr-4">--}}
{{--                                    <div class="flex flex-col gap-2">--}}
{{--                                        <form method="post" action="{{ route('admin.bug-statuses.update', $st) }}" class="grid grid-cols-1 md:grid-cols-6 gap-2">--}}
{{--                                            @csrf--}}
{{--                                            @method('patch')--}}
{{--                                            <x-text-input name="key" class="block w-full" value="{{ $st->key }}" maxlength="20" required />--}}
{{--                                            <x-text-input name="label" class="block w-full" value="{{ $st->label }}" maxlength="50" required />--}}
{{--                                            <x-text-input name="sort_order" type="number" class="block w-full" min="0" max="65535" value="{{ $st->sort_order }}" />--}}
{{--                                            <x-text-input name="color" class="block w-full" value="{{ $st->color }}" maxlength="6" />--}}
{{--                                            <label class="inline-flex items-center gap-2 text-sm text-gray-700">--}}
{{--                                                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ $st->is_active ? 'checked' : '' }}>--}}
{{--                                                Active--}}
{{--                                            </label>--}}
{{--                                            <x-primary-button>Save</x-primary-button>--}}
{{--                                        </form>--}}

{{--                                        <form method="post" action="{{ route('admin.bug-statuses.destroy', $st) }}">--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            <x-danger-button onclick="return confirm('Delete bug status?')">Delete</x-danger-button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        @if($bugStatuses->isEmpty())--}}
{{--                            <tr><td class="py-4 text-gray-600" colspan="6">No bug statuses yet.</td></tr>--}}
{{--                        @endif--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}

            {{-- ROLES --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Roles</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Galite sukurti roles. Sisteminių rolių (user/admin) redagavimas yra limituotas.
                </p>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                        <tr class="text-left text-gray-600">
                            <th class="py-2 pr-4">Pavadinimas</th>
                            <th class="py-2 pr-4">Rodymas</th>
                            <th class="py-2 pr-4">Spalva</th>
                            <th class="py-2 pr-4">Veiksmai</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y">
                        <tr class="align-top">
                            <td class="py-3 pr-4">
                                <form id="role-create" method="post" action="{{ route('admin.web.roles.store') }}" class="contents">
                                    @csrf
                                    <x-text-input name="name" class="block w-full" placeholder="mod" maxlength="25" required/>
                                </form>
                            </td>

                            <td class="py-3 pr-4">
                                <x-text-input form="role-create" name="display_name" class="block w-full" placeholder="Moderatorius" maxlength="25" required/>
                            </td>

                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-2">
                                    <input form="role-create" type="color" value="#3B82F6" class="h-9 w-12 rounded border border-gray-300 p-1" oninput="this.nextElementSibling.value = this.value.replace('#','').toUpperCase()"/>
                                    <input form="role-create" name="role_color" type="hidden" value="3B82F6"/>
                                    <span class="text-xs text-gray-500">pasirink</span>
                                </div>
                            </td>

                            <td class="py-3 pr-4">
                                <x-primary-button form="role-create" class="inline-flex w-auto px-3 py-2">
                                    Sukurti
                                </x-primary-button>
                            </td>
                        </tr>

                        @foreach($roles as $role)
                            @php($isSystem = in_array($role->name, ['user','admin'], true))
                            <tr class="align-top">
                                <td class="py-3 pr-4 font-medium text-gray-900">
                                    @if($isSystem)
                                        {{ $role->name }}
                                    @else
                                        <form id="role-{{ $role->id }}" method="post" action="{{ route('admin.web.roles.update', $role) }}" class="contents">
                                            @csrf
                                            @method('patch')
                                            <x-text-input name="name" class="block w-full" value="{{ $role->name }}" maxlength="25" required/>
                                        </form>
                                    @endif
                                </td>

                                <td class="py-3 pr-4">
                                    @if($isSystem)
                                        <form id="role-{{ $role->id }}" method="post" action="{{ route('admin.web.roles.update', $role) }}" class="contents">
                                            @csrf
                                            @method('patch')
                                            <x-text-input name="display_name" class="block w-full" value="{{ $role->display_name }}" maxlength="25" required/>
                                        </form>
                                    @else
                                        <x-text-input form="role-{{ $role->id }}" name="display_name" class="block w-full" value="{{ $role->display_name }}" maxlength="25" required/>
                                    @endif
                                </td>

                                <td class="py-3 pr-4">
                                    <div class="flex items-center gap-2">
                                        <input form="role-{{ $role->id }}" type="color" value="#{{ $role->role_color }}" class="h-9 w-12 rounded border border-gray-300 p-1"
                                               oninput="this.nextElementSibling.value = this.value.replace('#','').toUpperCase()"/>
                                        <input form="role-{{ $role->id }}" name="role_color" type="hidden" value="{{ $role->role_color }}"/>
                                        <span class="inline-flex items-center px-2 py-1 rounded text-white" style="background-color:#{{ $role->role_color }};">
                                            #{{ $role->role_color }}
                                        </span>
                                    </div>
                                </td>

                                <td class="py-3 pr-4">
                                    @if($isSystem)
                                        <x-primary-button form="role-{{ $role->id }}" class="inline-flex w-auto px-3 py-2">
                                            Išsaugoti
                                        </x-primary-button>
                                    @else
                                        <div class="flex items-center gap-2">
                                            <x-primary-button form="role-{{ $role->id }}" class="inline-flex w-auto px-3 py-2">
                                                Išsaugoti
                                            </x-primary-button>
                                            <form method="post" action="{{ route('admin.web.roles.delete', $role) }}">
                                                @csrf
                                                @method('delete')
                                                <x-danger-button class="inline-flex w-auto px-3 py-2"
                                                                 onclick="return confirm('Delete role? Users will fallback to user.')">
                                                    Ištrinti
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @if($roles->isEmpty())
                            <tr><td class="py-4 text-gray-600" colspan="4">Rolių nėra</td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- SETTINGS --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Nustatymai</h3>
                <p class="mt-1 text-sm text-gray-600">Čia galite pakeisti svetainės nustatymus.</p>
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full table-auto text-sm border-collapse">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="py-2 pr-4 w-0 whitespace-nowrap">
                                    Aprašymas
                                </th>
                                <th class="py-2 pr-4 w-full">
                                    Dabartinė reikšmė
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($_settings as $setting)
                                <tr class="align-top">
                                    <td class="py-3 pr-4 w-0 whitespace-nowrap text-gray-600" title="{{ $setting->key }}">
                                        {{ $setting->description ?? '—' }}
                                    </td>
                                    <td class="py-3 pr-4 w-full">
                                        <form method="post" action="{{ route('admin.web.settings.update', $setting) }}" class="flex gap-2">
                                            @csrf
                                            @method('patch')
                                            <x-text-input name="value" value="{{ $setting->value }}" required class="w-full"/>
                                            <x-primary-button class="whitespace-nowrap">Save</x-primary-button>
                                        </form>
                                    </td>

                                    <td class="py-3 w-0 whitespace-nowrap text-right align-middle"></td>
                                </tr>
                            @endforeach

                            @if ($_settings->isEmpty())
                                <tr>
                                    <td class="py-4 text-gray-600" colspan="3">
                                        No settings.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
