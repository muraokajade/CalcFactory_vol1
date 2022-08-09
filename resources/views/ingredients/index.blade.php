<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            オーナー一覧
        </h2>
    </x-slot>

        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">

                  <section class="text-gray-600 body-font">
                    <div class="md:px-5 ">
                      <x-flash-message status="session('status')" />
                      <h1 class="w-2/3 mx-auto text-3xl text-center p-2 rounded-xl border-b mb-3 bg-gradient-to-r from-teal-200 to-blue-300">原材料一覧</h1>
                      <div class="overflow-auto">
                         <input type="text" id="search" class="mt-1 border-2  w-60 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"> <input class="p-2 bg-gray-200" type="button" value="絞り込む" id="button"> <input class="p-2  bg-gray-200" type="button" value="すべて表示" id="button2">
                        <button class="ml-2 text-white whitespace-nowrap bg-indigo-400 border-0 p-2 focus:outline-none hover:bg-indigo-600 rounded" id="editing" type="submit">変更</button>
                        <table id="result" class="table-auto w-full border-2 text-left whitespace-no-wrap mt-4">
                          <thead>
                            <tr>
                              <th class="py-3 title-font text-center border-2 tracking-wider font-medium text-gray-900 bg-gray-100 ">原材料名</th>
                              <th class="py-3 title-font text-center border-2 tracking-wider font-medium text-gray-900 bg-gray-100">価格</th>
                              <th class="py-3 title-font text-center border-2 tracking-wider font-medium text-gray-900 bg-gray-100">荷姿(g)</th>
                              <th class="py-3 title-font text-center border-2 tracking-wider font-medium text-gray-900 bg-gray-100 ">g等単価</th>
                              <th class="py-3 title-font text-center border-2 tracking-wider font-medium text-gray-900 bg-gray-100 ">仕入れ日</th>
                              <th class="py-3 title-font text-center border-2 tracking-wider font-medium text-gray-900 bg-gray-100 ">仕入先</th>
                              <th class="py-3 title-font text-center border-2 tracking-wider font-medium text-gray-900 bg-gray-100 ">管理</th>
                            </thead>
                          <tbody>
                            @foreach ($ingredients as $ingredient)
                            <tr>
                               <td class="text-center border-2 ">{{$ingredient->name}}</td>
                               <td class="text-center border-2 ">
                                         <input type="number" title="price"
                                            {{ $ingredient->status == 1 ? 'disabled' : '' }}
                                            class="{{ $ingredient->status == 1 ? 'bg-gray-200' : '' }} mt-1 border-2  w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            data-id="{{ $ingredient->id }}" id="price_{{ $ingredient->id }}"
                                            name="price" value="{{ $ingredient->price }}">
                                </td>
                                <td class="text-center border-2 ">
                                         <input type="number" title="weight"
                                            {{ $ingredient->status == 1 ? 'disabled' : '' }}
                                            class="{{ $ingredient->status == 1 ? 'bg-gray-200' : '' }} weight mt-1 border-2  w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            data-id="{{ $ingredient->id }}" id="weight_{{ $ingredient->id }}"
                                            name="weight" value="{{ $ingredient->weight }}">
                                </td>
                               <td class="text-center border-2 ">
                                         <input type="number" title="g_price"
                                            {{ $ingredient->status == 1 ? 'disabled' : '' }}
                                            class="{{ $ingredient->status == 1 ? 'bg-gray-200' : '' }} mt-1 border-2  w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
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
                            <tr>
                                <form  method="post" action="{{route('ingredients.store')}}">
                                @csrf
                                    <td class="text-center"><input id="name" type="text" name="name" value="" class="mt-1 border-2  w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></td>
                                    <td class="text-center"><input title="price" id="price" type="number" name="price" value="" class="mt-1 border-2  w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></td>
                                    <td class="text-center"><input title="weight" id="weight" type="number" name="weight" value="" class="mt-1 border-2  w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></td>
                                    <td class="text-center"><input title="g_price" id="g_price" type="text" step="0.01" name="g_price" value="" class="mt-1 border-2  w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></td>
                                    <td class="text-center"><input type="date" name="p_date" value=""></td>
                                    <input type="hidden" name="status" value="0"></td>
                                    <td class="text-center">
                                        <select class="text-center" name="p_camp" value="">
                                           <option>テスト物産</option>
                                           <option>鈴木物産</option>
                                           <option>田中物産</option>
                                        </select>
                                    <td><button class="ml-2 text-white whitespace-nowrap bg-indigo-400 border-0 p-2 focus:outline-none hover:bg-indigo-600 rounded" type="submit">追加</button></td>
                                </form>
                            </tr>
                          </tbody>
                        </table>
                        {{-- {{ $ingredients->links() }} --}}
                      </div>
                    </div>
                  </section>
                </div>
            </div>
        </div>
  <script>
    function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
    }

    window.addEventListener('DOMContentLoaded',function(){
        let input_price = document.getElementById('price');
        let input_weight = document.getElementById('weight');

        input_weight.addEventListener('input',(e) => {
            let weight = e.target.value;
            let price = document.getElementById('price').value;
            let g_price = document.getElementById('g_price');
            g_price.value = price / weight;
            // g_price.value = Math.round(((price / weight) * 100) / 100) ;

        });
    });


        const calcPrice = (e) => {
            let tr = e.target.parentElement.parentElement;
            let this_weight = parseFloat(tr.querySelector('.weight').value);
            let this_price = parseFloat(tr.querySelector('input[type="number"][title="price"]').value);
            let g_price = tr.querySelector('input[type="number"][title="g_price"]');
            g_price.value = Math.round((this_price  / this_weight) * 100) / 100;

        }

        let price_inputs = document.querySelectorAll('input[type="number"][title="price"]');
            for (price_input of price_inputs) {
                price_input.addEventListener('input', (e) => {
                    calcPrice(e);
                });
            }

        let weight_inputs = document.querySelectorAll('input[type="number"][title="weight"]');
            for (weight_input of weight_inputs) {
                weight_input.addEventListener('input', (e) => {
                    calcPrice(e);
                });
            }





    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(function(){
	$('#button').bind("click",function(){
		let re = new RegExp($('#search').val());
		$('#result tbody tr').each(function(){
			let txt = $(this).find("td:eq(0)").html();
			if(txt.match(re) != null){
				$(this).show();
			}else{
				$(this).hide();
			}
		});
	});

	$('#button2').bind("click",function(){
		$('#search').val('');
		$('#result tr').show();
	});
});

const updateIngprice = (ingredient_id, price, weight, g_price, status) => {
                //console.log(sell_price);
                $.ajax({
                    url: '/updateIngprice',
                    method: 'POST',
                    data: {
                        id: ingredient_id,
                        price: price,
                        weight: weight,
                        g_price: g_price,
                        status: status,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data)
                        //alert('登録しました');
                    },
                    error: function() {
                        console.log('error')
                        console.log(ingredient_id, price, weight, g_price, status);
                    }
                });
            }

            let button1 = $('.storeprice');
            let button2 = $('.unlock');



            button1.on('click', (e) => {
                let ingredient_id = e.currentTarget.dataset.id;
                let prices = $('[id^=price_]');
                let weights = $('[id^=weight_]');
                let g_prices = $('[id^=g_price_]');
                let price;
                let weight;
                prices.each((index, element) => {
                    if (prices.eq(index).data('id') == ingredient_id) {
                        price = $('[id=price_' + ingredient_id + ']').val(); //input要素の可変id
                        console.log(price);
                    }
                });
                weights.each((index, element) => {
                    if (weights.eq(index).data('id') == ingredient_id) {
                        weight = $('[id=weight_' + ingredient_id + ']').val();
                    }
                });
                g_prices.each((index, element) => {
                    if (g_prices.eq(index).data('id') == ingredient_id ) {
                        g_price = $('[id=g_price_' + ingredient_id  + ']').val();
                    }
                });
                status = 1;
                updateIngprice(ingredient_id, price, weight, g_price, status);
            });

            button2.on('click', (e) => {
                let ingredient_id = e.currentTarget.dataset.id;
                let prices = $('[id^=price_]');
                let weights = $('[id^=weight_]');
                let g_prices = $('[id^=g_price_]');
                let price;
                let weight;
                let g_price;
                prices.each((index, element) => {

                    if (prices.eq(index).data('id') == ingredient_id ) {
                        price = $('[id=price_' + ingredient_id + ']').val(); //input要素の可変id
                        console.log(price);
                    }
                });
                weights.each((index, element) => {
                    if (weights.eq(index).data('id') == ingredient_id ) {
                        weight = $('[id=weight_' + ingredient_id  + ']').val();
                    }
                });
                g_prices.each((index, element) => {
                    if (g_prices.eq(index).data('id') == ingredient_id ) {
                        g_price = $('[id=g_price_' + ingredient_id  + ']').val();
                    }
                });
                status = 0;
                updateIngprice(ingredient_id, price, weight, g_price, status);
            });
            const registeredPrice = () => {
            $('.storeprice').on('click', (e) => {
                let tr = e.target.parentElement.parentElement
                console.log(tr);
                let input1 = tr.querySelector('input[type="number"][title="weight"]');
                let input2 = tr.querySelector('input[type="number"][title="price"]');
                let input3 = tr.querySelector('input[type="number"][title="g_price"]');
                input1.classList.add('disabled', 'bg-gray-200','text-gray-500');
                input1.setAttribute('disabled', 'true');
                input2.classList.add('disabled', 'bg-gray-200', 'text-gray-500');
                input2.setAttribute('disabled', 'true');
                input3.setAttribute('disabled', 'true');
                input3.classList.add('disabled', 'bg-gray-200', 'text-gray-500');
                let button1 = tr.querySelector('.storeprice');
                button1.classList.add('hidden');
                let button2 = tr.querySelector('.unlock');
                button2.classList.remove('hidden');
            });
        }
        registeredPrice();


    </script>
  </x-app-layout>
