<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projektai') }}
            </h2>

            <div>
                @auth
                    <x-purple-button tag="a" :href="route('projects.create')">
                        + Sukurti Projektą
                    </x-purple-button>
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white shadow rounded-lg p-4">
                <div class="flex justify-between items-center">
                    @isset($settings['main_page_desc_image'])
                        <div>
                            <img alt="logo" src="{{ asset($settings['main_page_desc_image']) }}" style="width: 250px"/>
                        </div>
                    @endisset
                    <p class="break-words">
                        {{ $settings['main_page_desc_text'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @forelse ($projects as $project)
                <a href="{{ route('projects.view', $project) }}"
                   class="block bg-white shadow rounded-lg p-4 my-2
                          transition
                          hover:shadow-lg hover:-translate-y-0.5 hover:bg-gray-50
                          focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $project->name }}
                            </h2>
                            <p class="text-gray-700 text-sm max-w-3xl">
                                {{ $project->description ?: 'Nėra aprašymo' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $project->owner?->name ?? 'Nežinomas' }}· Sukurta: {{ $project->created_at?->format('Y-m-d H:i') }}· Atnaujinta: {{ $project->updated_at?->format('Y-m-d H:i') }}
                            </p>
                        </div>

                        <div class="text-right text-sm text-gray-600">
                            <div>Nariai: {{ $project->members?->count() ?? 0 }}</div>
                            <div>Klaidos: {{ $project->bugs?->count() ?? 0 }}</div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="bg-white shadow rounded-lg p-6 text-gray-500">
                    Jokių projektų nerasta.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
