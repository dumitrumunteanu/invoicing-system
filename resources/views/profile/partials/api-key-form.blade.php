<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('API Key') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('The API key is needed to authenticate the requests that come from your application.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.generateApiKey') }}" class="mt-6 space-y-6">
        @csrf

        <div class="flex items-center gap-4">
            <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'show-api-key')">{{ __('Generate') }}</x-primary-button>
        </div>
    </form>

    @if (session('status') === 'api-key-generated')
        <x-modal show="true" name="show-api-key">
            <div class="p-6">
                <p class="mt-1 text-sm text-gray-600">This API key will be visible only this time. Copy it and store it somewhere safely. In order to authorize your requests, provide this key in the "X-API-KEY" header. In case you lose it, you have to generate a new key.</p>

                <p class="mt-1">{{session('api-key')}}</p>
            </div>
        </x-modal>
    @endif
</section>
