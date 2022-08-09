<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button
                        class="text-white font-bold py-2 px-4 mt-5 uppercase rounded-3xl bg-gray-500 hover:bg-gray-600 shadow hover:shadow-lg  transition transform hover:-translate-y-0.5"
                        id="add_btn">
                        材料数を増やす
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button><br>


                    <div id='ingredientsList' style='display:none'>{{ json_encode($ingredients) }}</div>
                    <form action="{{ route('recipes.store') }}" method="post" id='recipe_form'>
                        @csrf

                        <input type="text" name="name" placeholder="お菓子名"
                            class="mt-1 w-60 block mx-auto rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <!--<div id="form_list" class="flex justify-around mt-5 ">-->
                        <!--    <input type="text" id="search" placeholder="検索"-->
                        <!--        class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">-->
                        <!--    <select name="ing_id[]" placeholder="選択して下さい" id="ing_list"-->
                        <!--        class="mt-1 w-96 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">-->
                        <!--        <option selected>▼材料を選択してください</option>-->
                        <!--        @forelse($ingredients as $ingredient)-->
                        <!--            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>-->
                        <!--        @empty-->
                        <!--            <p>材料が見つかりません</p>-->
                        <!--        @endif-->
                        <!--    </select>-->

                        <!--    <input type="number" name="amount[]" placeholder="配合量" id="amount"-->
                        <!--        class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">-->

                        <!--    @forelse ($ingredients as $ingretient)-->
                        <!--        <input type="hidden" name="price" value="{{ $ingredient->g_price }}">-->
                        <!--    @empty-->
                        <!--        <p>登録なし</p>-->
                        <!--    @endforelse-->

                        <!--</div>-->

                        
                        
                        <input type="number" name="number" placeholder="取れ数"
                            class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <button
                            class="text-white font-bold py-2 px-4 mt-5 uppercase rounded-3xl bg-green-500 hover:bg-green-600 shadow hover:shadow-lg  transition transform hover:-translate-y-0.5">
                            作成
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //   それぞれの処理を確認しながら丁寧に書いていく!!!

        const createSearchBox = () => {
            //inputを作る
            let input = $('<input>');
            input.addClass(
                'searchBox mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
            );
            input.attr('type', 'text');
            input.attr('placeholder', '検索');
            //input.attr('onChange','searchChange()');
            return input;
        }

        const createSelectBox = () => {
            //selectを作る
            let select = $('<select>');
            select.attr('name', 'ing_id[]');
            select.addClass(
                'mt-1 w-96 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
            );
            let gradientsList = JSON.parse($('#ingredientsList').html());
            let options = createOptions();
            for (let option of options) {
                select.append(option);
            }
            return select;
        }


        const createDeleteButton = () => {
            let button = $('<button>');
            button.addClass('bg-gray-200 p-2');
            button.html('削除');
            return button;
        }

        const createOptions = () => {
            let gradientsList = JSON.parse($('#ingredientsList').html());
            let options = gradientsList.map((x) => {
                let option = $('<option>');
                option.html(x.name);
                option.val(x.id);
                return option;
            });
            options.unshift($('<option>').html('▼材料を選択してください'));
            return options;
        }

        const createAmountBox = () => {
            //inputを作る
            let input = $('<input>');
            input.addClass(
                'mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
            );
            input.attr('type', 'number');
            input.attr('placeholder', '配合量');
            input.attr('name', 'amount[]');
            console.log(input.val());
            return input;
        }


        const refreshSelect = (select) => {
            select.html('');
            let options = createOptions();
            for (let option of options) {
                option.attr('name', 'ing_id[]');
                select.append(option);
                console.log(option.val());
            }
        }


        $('body').on('change', '.searchBox', function() {

            refreshSelect($(this).next());


            let changedText = $(this).val();

            $(this).next().children().each(function(index) {
                if ($(this).html().includes(changedText) === false) {
                    $(this).remove();
                }
            });



            if ($(this).next().children().length === 0 || $(this).val().length === 0) {
                refreshSelect($(this).next());
            }


        });

        let add_btn = $('#add_btn');
        add_btn.on('click', () => {
            //外枠を作る
            let div = $('<div>');
            div.addClass('flex justify-around mt-5');

            div.append(createSearchBox());
            div.append(createSelectBox());
            div.append(createAmountBox());
            div.append(createDeleteButton());
            $('#recipe_form').append(div);
        });
        /*
        add_btn.on('click', () => {
            //let form_list = $('#form_list').clone();
            let form_list = $('#form_list');
            console.log(form_list); //div
            let search = $('#search');
            console.log(search.val()); //入力値
            search.clone().val('').appendTo($('.cloned')); //まあ良い感 val空

            //テスト
            let test = 'test';
            test.insertAfter(search);

            // console.log(number);
            let item = items.find('option');
            console.log(item);
            $('.cloned').append(items);
            //中身を消してクローン
        });
        */

        /*
        //コメントアウト
        class ListChanger {
            constructor(idName) {
                this.selectBox = document.getElementById(idName);
            }
            change(value) {
                const items = this.selectBox.children;
                const reg = new RegExp(".*" + value + ".*", "i");

                let i;

                if (value === '') {
                    for (i = 0; i < items.length; i++) {
                        items[i].style.display = "";
                    }
                    return;
                }

                for (i = 0; i < items.length; i++) {
                    if (items[i].textContent.match(reg)) {
                        items[i].style.display = "";
                    } else {
                        items[i].style.display = "none";
                    }
                    items[i].selected = false;
                }
                // 選択状態にする
                for (i = 0; i < this.selectBox.length; i++) {
                    if (this.selectBox[i].textContent.match(reg)) {
                        this.selectBox[i].selected = true;
                        break;
                    }
                }
            }
        }

        const menObj = new ListChanger('ing_list');
        $("#search").on('input keyup  blur', function() {
            menObj.change(this.value);
        }); */
    </script>
</x-app-layout>
