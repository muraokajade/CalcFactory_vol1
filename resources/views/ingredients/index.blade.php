<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            オーナー一覧
        </h2>
    </x-slot>

        <div class="sm:px-6 lg:px-8 mr-auto w-2/3">
            <div class="bg-white sm:rounded-lg">
                  <section class="text-gray-600 body-font" >
                    <div class="">
                      <x-flash-message status="session('status')" />
                      <h1 class="text-2xl text-center p-2  w-2/3 mt-4 mb-4 bg-gradient-to-r from-teal-200 to-blue-300">原材料データベース</h1>
                      <div class="flex">
                          <input type="text" id="search" class="input">
                          <input class="input bg-gray-200" type="button" value="絞り込む" id="button">
                          <input class="input  bg-gray-200 " type="button" value="すべて表示" id="button2">
                      </div>
                      <table class="table-fixed mt-4">
                          <thead>
                            <tr>
                              <th class="ing_th">原材料名</th>
                              <th class="ing_th">価格</th>
                              <th class="ing_th">荷姿(g)</th>
                              <th class="ing_th">g等単価</th>
                              <th class="ing_th">仕入れ日</th>
                              <th class="ing_th">仕入先</th>
                              <th class="ing_th">管理</th>
                            </thead>
                          <tbody>
                            <tr>
                                <form  method="post" action="{{route('ingredients.store')}}">
                                @csrf
                                    <td class="text-center"><input id="name" type="text" name="name" value="" class="input"></td>
                                    <td class="text-center"><input title="price" id="price" type="number" name="price" value="" class="input"></td>
                                    <td class="text-center"><input title="weight" id="weight" type="number" name="weight" value="" class="input"></td>
                                    <td class="text-center"><input title="g_price" id="g_price" type="text" step="0.01" name="g_price" value="" class="input"></td>
                                    <td class="text-center"><input type="date" name="p_date" value="" class="input"></td>
                                    <input type="hidden" name="status" value="0"></td>
                                    <td class="text-center">
                                        <select class="input" name="p_camp" value="">
                                           <option>テスト物産</option>
                                           <option>鈴木物産</option>
                                           <option>田中物産</option>
                                        </select>
                                    <td class="pl-2 border-r border-1"><button class="ml-2 text-white whitespace-nowrap bg-indigo-400 border-0 p-2 focus:outline-none hover:bg-indigo-600 rounded" type="submit">追加</button></td>
                                </form>
                            </tr>
                            @foreach ($ingredients as $ingredient)
                            <tr>
                               <td class="text-center border-2 ">{{$ingredient->name}}</td>
                               <td class="text-center border-2 ">
                                         <input type="number" title="price"
                                            {{ $ingredient->status == 1 ? 'disabled' : '' }}
                                            class="{{ $ingredient->status == 1 ? 'bg-gray-200' : '' }} price input"
                                            data-id="{{ $ingredient->id }}" id="price_{{ $ingredient->id }}"
                                            name="price" value="{{ $ingredient->price }}">
                                </td>
                                <td class="text-center border-2 ">
                                         <input type="number" title="weight"
                                            {{ $ingredient->status == 1 ? 'disabled' : '' }}
                                            class="{{ $ingredient->status == 1 ? 'bg-gray-200' : '' }} weight input"
                                            data-id="{{ $ingredient->id }}" id="weight_{{ $ingredient->id }}"
                                            name="weight" value="{{ $ingredient->weight }}">
                                </td>
                               <td class="text-center border-2 ">
                                   <input type="number" title="g_price"
                                            {{ $ingredient->status == 1 ? 'disabled' : '' }}
                                            class="{{ $ingredient->status == 1 ? 'bg-gray-200' : '' }} input"
                                            data-id="{{ $ingredient->id }}" id="g_price_{{ $ingredient->id }}"
                                            name="g_price" value="{{ $ingredient->g_price }}">
                                </td>

                              <td class="text-center border-2 py-3 edit">{{ $ingredient->p_date }}</td>
                              <td class="text-center border-2 py-3 edit">{{ $ingredient->p_camp }}</td>
                              <td class="text-center border-2 p-2">
                            <button type="button" data-id="{{ $ingredient->id }}"
                                onclick="location.href=''"
                                class="{{ $ingredient->status == 1 ? '' : 'hidden' }} m-2 p-2 whitespace-nowrap text-white bg-gray-400 focus:outline-none hover:bg-gray-600 rounded unlock">解除</button>
                            <button type="button" data-id="{{ $ingredient->id }}"
                                class="{{ $ingredient->status == 1 ? 'hidden' : '' }} storeprice m-2 p-2 whitespace-nowrap text-white bg-indigo-400 focus:outline-none hover:bg-indigo-600 rounded">登録</button>
                        </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{-- {{ $ingredients->links() }} --}}
                    </div>
                  </section>
            </div>
        </div>
  </x-app-layout>
