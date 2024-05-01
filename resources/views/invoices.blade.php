<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                @foreach($invoices as $invoice)
                    <div class="flex justify-between items-center">
                        <div>{{ $invoice->id }}</div>
                        <div>{{ $invoice->path }}</div>
                        <div>{{ $invoice->created_at }}</div>
                        <form action="{{ route('invoices.download', $invoice) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Download
                            </button>
                        </form>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
</x-app-layout>
