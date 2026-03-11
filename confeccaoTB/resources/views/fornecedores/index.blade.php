<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fornecedores') }}
            </h2>

            <a href="{{ route('fornecedores.create') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                + Novo Fornecedor
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

                    @forelse ($fornecedores as $fornecedor)

                        <div class="border p-5 rounded-lg bg-gray-50 hover:shadow-lg transition">

                            <h3 class="font-bold text-lg mb-2">
                                {{ $fornecedor->nome }}
                            </h3>

                            <p class="text-sm text-gray-600">
                                <strong>CNPJ:</strong> {{ $fornecedor->cnpj }}
                            </p>

                            <p class="text-sm text-indigo-600">
                                📞 {{ $fornecedor->telefone }}
                            </p>

                            <p class="text-sm text-gray-500">
                                ✉ {{ $fornecedor->email }}
                            </p>

                            <!-- Rodapé do card -->
                             <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-200 space-x-4">
                                <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold flex items-center">
                                    Editar
                                </a>

                                <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este fornecedor?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                        Excluir
                                    </button>
                                </form>
                                
                            </div>

                        </div>

                    @empty

                        <div class="col-span-full text-center py-10 text-gray-400">
                            Nenhum fornecedor cadastrado.
                        </div>

                    @endforelse

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

