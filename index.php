<?php
        require_once 'conn/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="head-ball-container">
        <div class="head-ball-container2">
            <div class="head-logo-cont">
            <img  src="img/logom.png" width="70" alt="logo"> VelMoCicle
            </div>
            <div class="ball-container">
                <b id="ner"></b>&nbsp;руб.
            </div>  
        </div>
    </div>
    <div class="store-container">
        <div class="left-cont">
            <div class="param-cont">
                <div class="param-1">
                    Сортировать по цене <img src="img/sort.png" width="16" alt="">
                </div>
                <div class="param-2">
                        <select name="cotegories" id="">
                            <option value="0">Категория</option>
                            <option value="1">Дизайн</option>
                            <option value="2">Управление проектами</option>
                            <option value="3">Разработка</option>
                            <option value="4">Тестирование</option>
                        </select>
                </div>
                <div class="right-cont-header-mini">
                    <img src="img/free-icon-purchase-7078316.png" width="50" alt="Корзина">
                </div>
                <div class="param-3">
                    <form>
                        <input type="text" name="search" placeholder="Введите название книги">
                      </form>
                </div>
            </div>
            <div class="books-item-cont">
                <div>
                    <?php
                        $tovari = mysqli_query($lin_handler, " SELECT  v.id, v.veloname, b.name, v.price, v.veloimg, v.razmer FROM veloes v
                        left join brands b on v.id_velobrand=b.idbrands");
                        $tovari= mysqli_fetch_all($tovari);
                        foreach ($tovari as $tovar) {
                        ?>
                    <div class="books-item-oneis">
                        <div class="book-img-cont"><img class="book-img" src="<?= $tovar[4] ?>" alt=""></div>
                        <div class="book-header-cont"><?= $tovar[1] ?></div>
                        <div class="book-params">
                            <p>Маркка: <?= $tovar[2] ?> <br>
                            Размер: <?= $tovar[5] ?></p>
                        </div>
                        <div class="book-price-cont"><?= $tovar[3] ?> руб</div>
                        <div class="book-buy-cont"><button class="add-to-cart" data-articul="<?= $tovar[0] ?>">В корзину</button></div>
                    </div>
                    <?php
                    }?>

                    <?php   
                        $motoes = mysqli_query($lin_handler, "SELECT m.id, m.motoname, b.name, m.price, m.motoimg FROM motoes m
                        left join brands b on m.id_motobrand=b.idbrands");
                        $motoes= mysqli_fetch_all($motoes);
                        foreach ($motoes as $moto) {
                        ?>
                    <div class="books-item-oneis">
                        <div class="book-img-cont"> <img class="book-img" src="<?=$moto[4]?>" alt=""></div>
                        <div class="book-header-cont"><?=$moto[1]?></div>
                        <div class="book-params">
                            <p>Маркка: <?=$moto[2]?></p>
                        </div>
                        <div class="book-price-cont"><?=$moto[3]?> руб</div>
                        <div class="book-buy-cont"><button class="add-to-cart" data-articul="<?=$moto[0]?>">В Корзину</button></div>
                    </div>  
                    <?php
                    }?>

                </div>
            </div>
        </div>
        <div class="right-cont">
            <div class="korz-cont">
                <div class="right-cont-header">
                    <img src="img/cart.png" width="50" alt="Корзина"> Корзина
                </div>
                <div  class="purchCont">
                    <!-- Нет выбранных товаров -->
                    
                    <!-- <div id="purchContItem">
                        <div id="bookPayHeader">dddddd</div>
                        <div id="cartCount">2</div>
                        <div id="bookPayCout">165465</div>
                        <div class="plusMinusClose">
                            <div class="plus">+</div>
                            <div class="minus">-</div>
                            <div class="close">x</div>
                        </div>
                    </div> -->
                </div>
                <div class="opl-cont">
                    <p id="afBalance"></p>
                    <p id="btnPay">Купить</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        let cart={};
        let ss =1;
        let afBalance = document.querySelector('p#afBalance');
        let purchCont = document.querySelector('div.purchCont');
        let balance = 200000;
        ner.textContent = balance;
        let btn_pay = document.getElementById("btnPay");
        
            //alert(afBalance.innerHTML)  
        $(function(){
            checkCart();
            // var obj = {}; // "associative array" or Object
            // var a = ['a', 'b', 'c', 'd'];
            // for(index in a) {
            //     if (index % 2 == 0) {
            //         var key = a[index];
            //         var val = a[index+1];
            //         obj[key] = val;
            //     }
            // }
            var s = "<?=$moto[0]?>";
            let veloes = <?php echo json_encode($tovari); ?>;
            let motoes = <?php echo json_encode($motoes); ?>;
            const velo_moto = veloes.concat(motoes);
            showMiniCarrt();
            //console.log(veloes);
            //console.log(motoes);
            //console.log(veloes[0][0])
            //console.log(motoes[0][1])
            // console.log(velo_moto);
            //console.log(velo_moto[0])
            //console.log(velo_moto[0][0])
   
            const data = {};
            $('.add-to-cart').on('click', addToCart);

            function addToCart(){
               //alert(purchCont.innerHTML)
                purchCont.innerHTML='';
                 let articul = $(this).attr("data-articul");
                if(cart[articul]!==undefined){
                cart[articul]++;
                }
                else{
                    cart[articul]=1;
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                showMiniCarrt();
                //console.log(cart);
            };
            function checkCart(){
                //проверка наличия корзины в localStorage
               // console.log(localStorage.getItem('ddd'));
                if(localStorage.getItem('cart')!==null){
                    cart = JSON.parse(localStorage.getItem('cart'));
                    
                }
               // console.log(cart)// просто вывод временного массива артикулов
            }
            //console.log(velo_moto)
            function showMiniCarrt(){
                //вывод корзины
                let count = 0;
               
                purchCont.innerHTML='';
                for(var s in  cart){
                    velo_moto.forEach((elem) =>{
                        //alert(elem)
                        if(s== elem[0]){
                            if (elem[3]) {
                               var ssss = Number(elem[3]) * Number(cart[s]);
                                count += ssss;
                                afBalance.innerHTML =count;
                            }
                            let purchContItem = document.createElement('div');
                            let bookPayHeader = document.createElement('div');
                            let cartCount = document.createElement('div');
                            let BookPayCout = document.createElement('div');
                            let plusMinusClose = document.createElement('div');
                            let plus = document.createElement('div');
                            let minus = document.createElement('div');
                            let close = document.createElement('div');
                            //добавляем идентификаторы
                            purchContItem.setAttribute('id', 'purchContItem');
                            bookPayHeader.setAttribute('id','bookPayHeader');
                            cartCount.setAttribute('id','cartCount');
                            BookPayCout.setAttribute('id','BookPayCout');
                            plusMinusClose.setAttribute('class','plusMinusClose');
                            plus.setAttribute('class','plus');
                            minus.setAttribute('class','minus');
                            close.setAttribute('class','close');
                            plus.setAttribute('data-articul',elem [0]);
                            minus.setAttribute('data-articul',elem [0]);
                            close.setAttribute('data-articul',elem [0]);
                            // закидаем в каждый div свои данные
                            let bookPayHeaderVal = document.createTextNode( elem [1]);
                            let cartCountVal = document.createTextNode(cart[s] + ' шт.');
                            let BookPayCoutVal = document.createTextNode(elem[3] + ' руб.');
                            let plusVal = document.createTextNode('+');
                            let minusVal = document.createTextNode('-');
                            let closeVal = document.createTextNode('x');
                            // добавляем div и отрисовываем DOM
                            
                            bookPayHeader.appendChild(bookPayHeaderVal);
                            cartCount.appendChild(cartCountVal);
                            BookPayCout.appendChild(BookPayCoutVal);
                            plus.appendChild(plusVal);
                            minus.appendChild(minusVal);
                            close.appendChild(closeVal);
                            plusMinusClose.appendChild(plus);
                            plusMinusClose.appendChild(minus);
                            plusMinusClose.appendChild(close);
                            //просто вывод корзины в console
                            purchContItem.appendChild(bookPayHeader);
                            purchContItem.appendChild(cartCount);
                            purchContItem.appendChild(BookPayCout);
                            purchContItem.appendChild(plusMinusClose);
                            purchCont.appendChild(purchContItem);
                        }
                    })
                }
            }
            showMiniCarrt();
            function myfun () {
                    localStorage.clear();
                    if(afBalance.innerHTML==''){
                        alert('Сначала добавьте товар в корзину ')
                    }
                    else if(ner.textContent < Number(afBalance.innerHTML)){
                        alert('Недостаточно средств \nпополните баланс !');
                    }
                    else{
                        let conf = confirm('Вы пытаетесь совершить покупку ?');
                        if (conf==1){
                            balance -=Number(afBalance.innerHTML);
                            ner.textContent = balance;
                            localStorage.clear();
                            console.log(afBalance.innerHTML)
                            // afBalance.innerHTML = '';
                            afBalance.innerHTML = '';
                            // localStorage.setItem('cart', JSON.stringify(cart));
                            showMiniCarrt();

                            // purchCont.innerHTML='';
                            // result= JSON.parse(localStorage.getItem('cart'));// get array values from local Strorage
                            // localStorage.clear();
                            // //and removing the Id from array
                            // localStorage.setItem('cart', JSON.stringify(cart));
                            // window.localStorage.clear();
                            
                            // let delCartItem = document.querySelector('div.close');
                            // console.log(delCartItem)
                            // let articul = $(this).attr("data-articul");
                            // console.log(articul)
                        }
                        else{
                            alert('Будем ждать !');
                        }
                    }
                    
                };
                btn_pay.addEventListener("click", myfun);
            document.onclick = event =>{
                //console.log(cart)
                let art = event.target.dataset.articul; //получение  артикула товара 
               // console.log(art)
                // console.log(event.target.classList)
                if(event.target.classList.contains('plus')){
                    if(cart[art]!==undefined){
                        cart[art]++;
                        localStorage.setItem('cart', JSON.stringify(cart));
                    }
                    else{
                        alert("Что-то пошло не так, извните :(")
                    }
                    //  console.log(art) артикул товара
                    // console.log(cart);
                    // console.log(event.target.dataset.articul); 
                }
                if(event.target.classList.contains('minus')){
                    if(cart[art]!==undefined){
                        cart[art]--;
                        if(cart[art]==0){
                        delete cart[art]
                        afBalance.innerHTML = '';
                        localStorage.setItem('cart', JSON.stringify(cart));
                        }
                    }
                    else{
                        alert("Что-то пошло не так, извните :(")
                    }
                }
                if(event.target.classList.contains('close')){
                    if(cart[art]!==undefined){
                        delete cart[art];
                        //console.log(cart)
                        afBalance.innerHTML = '';
                        localStorage.setItem('cart', JSON.stringify(cart));
                    }
                    else{
                        alert("Что-то пошло не так, извните :(")
                    }
                }
                showMiniCarrt();
            };

        });                          

    </script>
</body>
</html>
