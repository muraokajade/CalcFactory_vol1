<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品一覧') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white ">
                    <a href="{{route('recipes.create')}}" class="text-white bg-indigo-300 border-0 p-2 focus:outline-none hover:bg-indigo-600 rounded">レシピ作成</a>
                </div>
                <p>レシピはレシピで編集して、ケーキに追加かな</p>
                <h1 class="w-2/3 mx-auto text-3xl text-center mb-4 text-center p-2 text-3xl rounded-xl border-b mb-3 bg-gradient-to-r from-teal-200 to-blue-300">レシピ一覧</h1>
                <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="ptitle-font text-center tracking-wider border-2 font-medium text-gray-900 text-xl leading-none bg-gray-100 rounded-tl rounded-bl">ケーキ名</th>
                                                <th class="ptitle-font text-center tracking-wider border-2 font-medium text-gray-900 text-xl leading-none bg-gray-100 rounded-tl rounded-bl">材料名</th>
                                                <th class="ptitle-font text-center tracking-wider border-2 font-medium text-gray-900 text-xl leading-none bg-gray-100 rounded-tl rounded-bl">配合量</th>
                                                <th class="ptitle-font text-center tracking-wider border-2 font-medium text-gray-900 text-xl leading-none bg-gray-100 rounded-tl rounded-bl">取れ数</th>
                                                <th class="ptitle-font text-center tracking-wider border-2 font-medium text-gray-900 text-xl leading-none bg-gray-100 rounded-tl rounded-bl">編集</th>
                                                <th class="ptitle-font text-center tracking-wider border-2 font-medium text-gray-900 text-xl leading-none bg-gray-100 rounded-tl rounded-bl">管理</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                <tr>
                                                    <td class="text-center border-2"></td>
                                                    <td class="text-center border-2"></td>
                                                    <td class="text-center border-2"></td>
                                                    <td class="text-center border-2 p-2"></td>
                                                    <td class="text-center border-2 p-2"></td>
                                                </tr>

                                        </tbody>
                                    </table>
                
            </div>
        </div>
    </div>
</x-app-layout>