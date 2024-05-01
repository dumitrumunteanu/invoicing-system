<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Company details') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("The following company details will be used to generate invoices.") }}
                    </p>
                </header>
                <form method="post" action="{{ route('company.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="flex gap-5">
                        <div class="flex-1">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->company?->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <textarea id="address" name="address" type="text" required
                                          class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                >{{ old('address', $user->company?->address) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>
                        </div>

                        <div class="flex items-end">
                            <label for="logo" class="relative cursor-pointer">
                                <img id="logoPreview" class="w-32 rounded-full {{$user->company?->logo ? '' : 'hidden'}}" src="{{asset('storage/'.$user->company?->logo)}}" alt="Logo Preview" />
                                <input id="logo" name="logo" type="file" class="hidden" accept="image/*" onchange="previewLogo(event)"/>
                                <div class="absolute inset-0 bg-gray-100 opacity-50 hover:opacity-75 flex items-center justify-center w-32 h-32 rounded-full">
                                    <span class="text-gray-700">Upload Logo</span>
                                </div>
                            </label>

                            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'company-details-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>

            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('PDF Template') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("The selected template will be used to generate invoices.") }}
                    </p>
                </header>
                <div class="flex justify-between pt-6">
                    <form class="text-gray-900" method="POST" action="{{ route('profile.updateTemplate') }}">
                        @csrf

                        <div class="flex flex-col gap-2 mb-5">
                            <div>
                                <input
                                    id="template1-selector"
                                    type="radio"
                                    name="template_id"
                                    value="1"
                                    {{ Auth::user()->template_id === 1 ? 'checked' : '' }}/>
                                <label for="template1-selector">Template 1</label>
                            </div>
                            <div>
                                <input
                                    id="template2-selector"
                                    type="radio"
                                    name="template_id"
                                    value="2"
                                    {{ Auth::user()->template_id === 2 ? 'checked' : '' }}/>
                                <label for="template2-selector">Template 2</label>
                            </div>
                            <div>
                                <input
                                    id="template3-selector"
                                    type="radio"
                                    name="template_id"
                                    value="3"
                                    {{ Auth::user()->template_id === 3 ? 'checked' : '' }}/>
                                <label for="template3-selector">Template 3</label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('template_id')" />
                        </div>

                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'template-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 mt-1"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </form>
                    <div class="relative w-1/2 max-w-sm" style="padding-top: 60%">
                        <iframe class="w-full h-full absolute top-0 left-0" src="{{ route('previewTemplate', Auth::user()->template_id) }}" frameborder="0"></iframe>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        function previewLogo(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('logoPreview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
