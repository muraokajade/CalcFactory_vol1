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

    });
});


    const calcPrice = (e) => {
        let tr = e.target.parentElement.parentElement;
        let this_weight = parseFloat(tr.querySelector('.weight').value);
        let this_price = parseFloat(tr.querySelector('.price').value);
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