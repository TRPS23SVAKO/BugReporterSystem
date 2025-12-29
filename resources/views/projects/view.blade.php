<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $project->name }}
                </h2>
                <p class="text-sm text-gray-500">
                    Savininkas: {{ $project->owner?->name ?? 'Nežinomas' }}
                    · Sukurta: {{ $project->created_at?->format('Y-m-d H:i') }}
                    · Atnaujinta: {{ $project->updated_at?->format('Y-m-d H:i') }}
                </p>
            </div>

            <div class="text-right text-sm text-gray-600">
                <div>Nariai: {{ $project->members?->count() ?? 0 }}</div>
                <div>Klaidos: {{ $project->bugs?->count() ?? 0 }}</div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-gray-900">Aprašymas</h3>
                <p class="mt-2 text-gray-700">
                    {{ $project->description ?: 'Aprašymo nėra.' }}
                </p>
            </div>

            <div class="bg-white shadow rounded-lg">
                <div class="p-6 border-b">
                    <h3 class="font-semibold text-gray-900">Klaidos</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Rodomas vykdytojas, pranešėjas, būsena / svarbumas / prioritetas, sukūrimo ir atnaujinimo datos.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Pavadinimas</th>
                            <th class="px-4 py-3 text-left">Būsena</th>
                            <th class="px-4 py-3 text-left">Svarbumas</th>
                            <th class="px-4 py-3 text-left">Prioritetas</th>
                            <th class="px-4 py-3 text-left">Pranešėjas</th>
                            <th class="px-4 py-3 text-left">Vykdytojas</th>
                            <th class="px-4 py-3 text-left">Sukurta</th>
                            <th class="px-4 py-3 text-left">Atnaujinta</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y">
                        @forelse($project->bugs as $bug)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-600">{{ $bug->id }}</td>

                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $bug->title }}</div>

                                    @if($bug->tags?->count())
                                        <div class="mt-1 flex flex-wrap gap-1">
                                            @foreach($bug->tags as $tag)
                                                <span class="px-2 py-0.5 rounded text-xs border"
                                                      @if($tag->color)
                                                          style="border-color:#{{ $tag->color }}; color:#{{ $tag->color }};"
                                                      @endif>
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-3">{{ $bug->status?->label ?? $bug->status_id }}</td>
                                <td class="px-4 py-3">{{ $bug->severity?->label ?? $bug->severity_id }}</td>
                                <td class="px-4 py-3">{{ $bug->priority?->label ?? $bug->priority_id }}</td>

                                <td class="px-4 py-3">{{ $bug->reporter?->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $bug->assignee?->name ?? '-' }}</td>

                                <td class="px-4 py-3 text-gray-600">{{ $bug->created_at?->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $bug->updated_at?->format('Y-m-d H:i') }}</td>
                            </tr>

                            <tr>
                                <td colspan="9" class="px-4 pb-4">
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex justify-between items-center">
                                            <div class="font-semibold text-gray-800">Įvykiai / Istorija</div>
                                            <div class="text-xs text-gray-500">
                                                {{ $bug->events?->count() ?? 0 }} įvykis(-iai)
                                            </div>
                                        </div>

                                        @php
                                            $typeLabel = fn($t) => match($t) {
                                                'created' => 'Sukurta',
                                                'comment_added' => 'Pridėtas komentaras',
                                                'status_changed' => 'Pakeista būsena',
                                                'assigned' => 'Priskirta',
                                                'unassigned' => 'Atšaukta priskyrimas',
                                                'severity_changed' => 'Pakeistas svarbumas',
                                                'priority_changed' => 'Pakeistas prioritetas',
                                                'tag_added' => 'Pridėta žyma',
                                                'tag_removed' => 'Pašalinta žyma',
                                                'attachment_added' => 'Pridėtas priedas',
                                                default => $t,
                                            };
                                        @endphp

                                        <div class="mt-3 space-y-2">
                                            @forelse($bug->events as $ev)
                                                <div class="flex justify-between gap-4">
                                                    <div class="min-w-0">
                                                        <div class="text-sm text-gray-900">
                                                            <span class="font-medium">{{ $typeLabel($ev->event_type) }}</span>
                                                            <span class="text-gray-600">
                                                                atliko {{ $ev->actor?->name ?? 'Sistema' }}
                                                            </span>
                                                        </div>

                                                        <div class="text-xs text-gray-600 mt-0.5">
                                                            @php
                                                                $from = $ev->from_value;
                                                                $to = $ev->to_value;
                                                            @endphp

                                                            @if(!is_null($from) || !is_null($to))
                                                                <span class="font-medium">Pakeitimas:</span>
                                                                <span class="text-gray-700">{{ $from ?? '-' }}</span>
                                                                <span class="text-gray-500">→</span>
                                                                <span class="text-gray-700">{{ $to ?? '-' }}</span>
                                                            @endif

                                                            @if(!empty($ev->meta))
                                                                <span class="text-gray-500">· meta</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="text-xs text-gray-500 whitespace-nowrap">
                                                        {{ $ev->created_at?->format('Y-m-d H:i') }}
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-sm text-gray-500">Įvykių nėra.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-6 text-gray-500">
                                    Šiame projekte klaidų nerasta.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
