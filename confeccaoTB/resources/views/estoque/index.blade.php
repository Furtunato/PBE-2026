<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Estoque') }}
            </h2>

            <a href="{{ route('estoques.create') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                + Novo Registro
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse ($Estoques as $estoque)

                        <div class="border p-5 rounded-lg bg-gray-50 hover:shadow-lg">

                             <h3 class="font-bold text-lg mb-2">
                                Produto ID: {{ $estoque->produto_id }}
                                </h3>

                                <p class="text-indigo-600">
                                📦 Quantidade: {{ $estoque->quantidade }}
                                </p>

                                <!-- Rodapé do card -->
                            <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-200 space-x-4">
                                <a href="{{ route('estoques.edit', $estoque->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold flex items-center">
                                    Editar
                                </a>

                                <form action="{{ route('estoques.destroy', $estoque->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este estoque?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                        Excluir
                                    </button>
                                </form>
                                
                            </div>

                        </div>

                    @empty

                        <div class="col-span-full text-center text-gray-400 py-10">
                            Nenhum registro de estoque encontrado.
                        </div>

                    @endforelse

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
