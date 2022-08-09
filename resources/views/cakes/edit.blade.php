<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <x-flash-message status="session('status')" />
                <section class="text-gray-600 body-font">
                    <div class="px-5 mx-auto">
                        <div class="flex flex-col text-center w-full mb-20">
                            <div class="w-full mx-auto overflow-auto">
                                <h1 class="sm:text-4xl text-3xl font-medium title-font text-gray-900 mb-4">
                                    【{{ $cake->name }}】</h1>
                                <div class="mr-auto text-left">
                                    <select style="width:300px; height:200px; " class="select">
                                        @forelse ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->name }}">{{ $ingredient->name }}:
                                                {{ $ingredient->g_price }}円</option>

                                        @empty
                                            <p>nothing</p>
                                        @endforelse
                                    </select>


                                </div>
                                <table class="table-auto w-full text-left whitespace-no-wrap mt-4">
                                    <thead>
                                        <tr>

                                            <th
                                                class="title-font text-center tracking-wider border-2 font-medium text-gray-900 text-2xl leading-none bg-gray-100">
                                                材料名
                                            </th>
                                            <th
                                                class="title-font text-center tracking-wider border-2 font-medium text-gray-900  text-2xl leading-none bg-gray-100">
                                                材料単価(g)
                                            </th>
                                            <th
                                                class="title-font whitespace-nowrap text-center tracking-wider border-2 font-medium text-gray-900 text-2xl leading-none bg-gray-100">
                                                配合量(g)
                                            </th>

                                            <th
                                                class="text-center title-font whitespace-nowrap tracking-wider border-2 font-medium text-gray-900 text-2xl leading-none bg-gray-100">

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($recipes as $recipe)
                                            <tr>
                                                <td class="text-center border-2">{{ $recipe->ingredient->name }}</td>
                                                <td class="text-center border-2">{{ $recipe->amount }}</td>
                                                <td class="text-center border-2"></td>
                                                <td class="text-center border-2 p-2">
                                                    <form id="edit_{{ $recipe->cake_id }}" method="get"
                                                        action="{{ route('cakes.edit', ['cake' => $recipe->cake_id]) }}">
                                                        @csrf
                                                        <a href="{{ route('cakes.edit', $recipe->ingredient->id) }}"
                                                            data-id="{{ $recipe->ingredient->id }}"
                                                            class="m-2 p-2 whitespace-nowrap text-white bg-indigo-400 focus:outline-none hover:bg-indigo-600 rounded"
                                                            onclick="showCake(this)">
                                                            編集
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>から</p>
                                        @endif



                                    </tbody>
                                </table>
                                <table class="border-2 table-auto w-full text-center whitespace-no-wrap mt-4">
                                    <tr>
                                        <th class="border-2" rowspan="2">現在</th>
                                        <th class="border-2">原価</th>
                                        <th class="border-2">販売価格</th>
                                        <th class="border-2">粗利率</th>
                                    </tr>
                                    <tr>
                                        <td class="border-2 p-2 text-lg">100</td>
                                        <td class="border-2 p-2 text-lg">100</td>
                                        <td class="border-2 p-2 text-lg">0</td>
                                    </tr>

                                    <tr>
                                        <th rowspan="2">変更後</th>
                                        <th class="border-2">原価</th>
                                        <th class="border-2">販売価格</th>
                                        <th class="border-2">粗利率</th>
                                    </tr>
                                    <tr>
                                        <td class="border-2 p-2 text-lg">3</td>
                                        <td class="border-2 p-2 text-lg">3</td>
                                        <td class="border-2 p-2 text-lg">0</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        function showCake(e) {
            document.getElementById('edit_' + e.dataset.id).submit();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select').select2({
                allowClear: true,
                placeholder: '材料を選択してください',
            }).on('select2:select', function() {
                $('.select_value').val($(this).val());
            });

        });



    </script>

</x-app-layout>
