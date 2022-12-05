<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Доставка кованых изделий");
$APPLICATION->SetTitle("Доставка");
?><div class="payment_delivery_page">
    <div class="inn">
        <div class="delivery tabs_change">
            <noindex>
                <span>
                    <ul class="man">
                        <li class="active change_tab">
                            <a href="#">Город</a>
                        </li>
                        <li class="change_tab">
                            <a href="#">Область</a>
                        </li>
                        <li class="change_tab">
                            <a href="#">Россия</a>
                        </li>
                    </ul>
                    <div class="clear">
                    </div>
                </span>
            </noindex>
            <div class="tabs">
                <div class="tab active">
                    <div class="container">
                        <p class="preview">
                            Сделав заказ в нашей компании, Вы можете забрать товар 2-мя способами:
                        </p>
                        <ul class="del_items">
                            <li>
                                <span class="icon">
                                    <img alt="Заказать доставку" src="/bitrix/templates/main/images/city_del_ico_1.jpg" heigh="56" width="56">
                                </span>
                                <span class="text">Заказать доставку</span>
                            </li>
                            <li>
                                <span class="icon">
                                    <img src="/bitrix/templates/main/images/city_del_ico_2.jpg" heigh="56" alt="Самовывоз" width="56">
                                </span>
                                <span class="text">Самовывоз</span>
                            </li>
                        </ul>
                        <div class="clear">
                        </div>
                        <p>
                            Кованые изделия не только имеют красивый внешний вид, но и внушительную массу. Лёгкое и невесомое на первый взгляд кружево
                            из стальных прутов иногда сложно даже просто поднять и выгрузить. Вот почему задача транспортировки
                            порой становится головной болью для покупателя. В магазине вы можете заказать кованые изделия,
                            воспользовавшись не только самовывозом. Чтобы облегчить эту трудную задачу, мы предоставляем
                            услугу доставки по городу, области и по всей России. Ознакомиться со способами, тарифами и транспортом
                            вы можете в разделах сайта.
                        </p>
                        <ul class="common">
                            <li>По городу осуществляется грузоперевозка предметов, весом не более тонны, размером до 4м, объёмом
                                максимум 12 кубометров. Стоимость доставки изделий больших габаритов обсуждается отдельно.</li>
                            <li>Грузы по городу и пригороду (в районе 15км) доставляются за 1-2 рабочих дня с момента оформления.
                                Существует также срочная перевозка, которую нужно обсуждать с менеджером.</li>
                            <br>
                        </ul>
                        <p>
                            <span class="red">ВНИМАНИЕ!</span> Время на самостоятельную разгрузку клиентом машины с товаром включено в сумму
                            оплаты доставки и не должно превышать 30 минут. Превышение времени подлежит дополнительной оплате,
                            которая рассчитывается по текущей цене на время простоя грузового транспорта.
                        </p>
                        <div class="tarif_title">
                            Тарифы для транспортных средств
                        </div>
                        <div class="tarif_items">
                            <div class="item">
                                <div class="image">
                                    <img src="/bitrix/templates/main/images/del_photo_1.jpg" alt="ГАЗЕЛЬ" width="190" height="190">
                                </div>
                                <div class="text">
                                    <span class="in">
                                        <span class="name">ГАЗЕЛЬ</span>
                                        <span class="price">
                                            <b>от 600</b>руб./час</span>
                                    </span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="image">
                                    <img src="/bitrix/templates/main/images/del_photo_2.jpg" alt="ГАЗЕЛЬ" width="190" height="190">
                                </div>
                                <div class="text">
                                    <span class="in">
                                        <span class="name">ЗУБР</span>
                                        <span class="price">
                                            <b>от 1 400</b>руб./час</span>
                                    </span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="image">
                                    <img src="/bitrix/templates/main/images/del_photo_3.jpg" alt="ГАЗЕЛЬ" width="190" height="190">
                                </div>
                                <div class="text">
                                    <span class="in">
                                        <span class="name">МАЗ</span>
                                        <span class="price">
                                            <b>от 2 500</b>руб./час</span>
                                    </span>
                                </div>
                            </div>
                            <div class="clear">
                            </div>
                            <br>
                            <!-- <p><a id="bxid_931003" href="/upload/sale/delivery/price_dostavka.doc" >Скачать прайс-лист доставки по Воронежу</a></p>-->
                            <div class="clear">
                            </div>
                            <br>
                            <p>
                                При наличии претензии, товар можно вернуть или обменять, согласно статье №520 ГК РФ и статье №25 «Закона о защите прав потребителя».
                                Для этого потребуется паспорт и товарный или кассовый чек на изделие.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="container">
                        <p>
                            По области кованые изделия перевозятся также за 1-2 рабочих дня с момента оформления заказа.
                            <br>
                            <i>Срочная доставка по городу осуществляется также после обсуждения с менеджером.</i>
                        </p>
                        <!--	<b>ГАЗЕЛЬ</b> 								<b>ЗУБР</b> 								<b>МАЗ</b> 							 		 -->
                        <table class="region_delivery" width="100%">
                            <tbody>
                                <tr class="cities c1">
                                    <td colspan="3">
                                        Аэропорт, Богданово, Боево, Графская ст., Губарево, Девица, Каширское, Колодезное, Крыловка, Латное, Малая Приваловка, Медовка,
                                        НовоВоронеж, Новогремяченское, Новоживотинное, Олень-Колодезь, П. Хава, Рамонь, Русская
                                        Гвоздевка, Стрелица, Тимирязево, Хлебное
                                    </td>
                                </tr>
                                <tr class="dotted c1">
                                    <td colspan="3">
                                        ГАЗЕЛЬ
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">2 000</b> руб.</span>
                                    </td>
<!--
                                    <td>
                                        ЗУБР
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">4 200 </b> руб.</span>
                                    </td>
                                    <td>
                                        МАЗ
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">5 800 </b> руб.</span>
                                    </td>
-->
                                </tr>
                                <tr class="cities c2">
                                    <td colspan="3">
                                        В. Байгора, В. Катуховка, В. Хава, Гремячье, Даньково, Карачун (Рамонский р-он), Кондрашкино, Костёнки, Кр. Лиман, Кр. Лог,
                                        Левая Россошь, Можайское, Мосальское, Нелжа, Нижняя Катуховка, Оськино, Ступино </td>
                                </tr>
                                <tr class="dotted c1">
                                    <td colspan="3">
                                        ГАЗЕЛЬ
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">2 500</b> руб.</span>
                                    </td>
<!--
                                    <td>
                                        ЗУБР
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">4 800 </b> руб.</span>
                                    </td>
                                    <td>
                                        МАЗ
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">6 600 </b> руб.</span>
                                    </td>
-->
                                </tr>
                                <tr class="cities c2">
                                    <td colspan="3">
                                        В. Турово, Давыдовка, Землянск, Конь-Колодезь Курбатово, Курино, Н Турово, Нижнедевицк, Панино, Перелешино, Солдатское, Усмань
                                        (Липецкая обл.), Хлевное (Липецкая обл.), Хохол
                                    </td>
                                </tr>
                                <tr class="dotted c1">
                                    <td colspan="3">
                                        ГАЗЕЛЬ
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">3 000</b> руб.</span>
                                    </td>
<!--
                                    <td>
                                        ЗУБР
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">5 400 </b> руб.</span>
                                    </td>
                                    <td>
                                        МАЗ
                                        <br>
                                        <span style="padding-top: 3px;">
                                            <b style="display: inline;">7 400 </b> руб.</span>
                                    </td>
-->
                                </tr>
                                <tr class="cities c2">
                                    <td colspan="3">
                                        Стоимость 1 км. при удаленности населенного пункта свыше 100 км. в одну сторону
                                        <div class="price_more">

                                            <div class="item">
                                                ГАЗЕЛЬ
                                                <i>(6м - 1тн; 4м - 1,3тн)</i>
                                                <br>24 руб. / 1 км
                                            </div>
                                            <div class="item" style="border-left: none;">
                                                ЗУБР
                                                <i></i>
                                                <br>33 руб. / 1 км
                                            </div>
                                            <div class="item" style="border-left: none;">
                                                МАЗ
                                                <i></i>
                                                <br>55 руб. / 1 км
                                            </div>
                                            <div class="item" style="border-left: none;">
                                                МАНИПУЛЯТОР
                                                <i></i>
                                                <br>40 руб. / 1 км
                                            </div>
                                            <div class="clear">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>



                        <ul class="common">
                            <li>Перевозку по области нужно оплатить наличными в офисе отдельно, или включить в стоимость заказа
                                при безналичном способе расчёта. Если габариты кованого изделия превышают объёмы транспорта,
                                следует заранее уточнять условия у менеджера.</li>
                            <li>Претензии к качеству или комплектации груза нужно формировать в присутствии водителя до оплаты,
                                который проверяется при получении. Проверять и оплачивать груз можно в течение 10 минут после
                                получения. Принятие претензии к заказу возможно только в присутствии водителя. </li>
                            <li>Водитель занимается исключительно грузоперевозками, а не консультациями по вопросам, не связанным
                                с этим.</li>
                        </ul>
                    </div>
                </div>
                <div class="tab">
                    <div class="container">
                        <p>
                            Кроме доставки по городу и области, существует возможность транспортировки по России. По российским регионам грузы доставляют
                            с помощью транспортных компаний.
                        </p>
                        <p>
                            Для этого можно выбрать любую транспортную компанию, терминал которой присутствует в городе. Конечное значение стоимости
                            будет зависеть от выбранной транспортной компании и дальности транспортировки. Транспортирование
                            из компании к терминалу
                            <span class="red">бесплатно</span>. Транспортировка в регионы Российской Федерации осуществляется только по предоплате.
                            Передача заказа транспортным компаниям осуществляется в течение 2-3 суток после получения оплаты.
                        </p>
                        <p>
                            Когда груз поступает в терминал транспортной компании в городе заказчика, грузоперевозчик сообщает по телефону о готовности
                            к выдаче. Чтобы забрать товар, физическим лицам нужен документ, удостоверяющий личность; юридическим
                            лицам нужно иметь на руках доверенность на получение груза. Оплата доставки осуществляется за
                            счет покупателя во время забора товара из транспортной компании. В регионы отправляют грузы стоимостью
                            не менее 2000 рублей.
                        </p>
                        <p>
                            Помимо этого, существует возможность зарезервировать товар на 3 рабочих дня без оплаты. Если по истечении 3 дней товар не
                            оплачивается, его снимают с резерва.
                        </p>
                        <div class="del_comp">
                            <a target="_blank" title="ПЭК" href="http://www.pecom.ru/ru/services/send/warehouses/voronezh/">
                                <img alt="2.jpg" src="http://polimer-vrn.ru/upload/medialibrary/0a8/0a8832f2254fa79b690e4b01d68818d3.jpg" title="пэк.jpg"
                                    width="125" hspace="2" height="40" border="0" align="left"> </a>
                            <a target="_blank" title="СкифКарго" href="http://www.skif-cargo.ru/">
                                <img alt="3.jpg" src="http://polimer-vrn.ru/upload/medialibrary/a01/a0167b30f7cad28e6dd17e25dc8856c0.jpg" title="скиф карго.jpg"
                                    width="66" hspace="2" height="40" border="0" align="left"> </a>
                            <a target="_blank" title="Деловые линии" href="http://www.dellin.ru/">
                                <img alt="4.jpg" src="http://polimer-vrn.ru/upload/medialibrary/5e7/5e79f7d15c55a1e037f3fee3ce6e1351.jpg" title="Деловые линии.jpg"
                                    width="144" hspace="2" height="30" border="0" align="left"> </a>
                            <a target="_blank" title="Байкал сервис" href="http://www.baikalsr.ru/">
                                <img alt="5.png" src="http://polimer-vrn.ru/upload/medialibrary/38f/38fddbde384ae486954e509d2d20daf9.png" title="байкал сервис.png"
                                    width="195" hspace="2" height="25" border="0" align="left"> </a>
                            <a target="_blank" title="Желдорэкспедиция" href="http://www.jde.ru/">
                                <img alt="6.jpg" src="http://polimer-vrn.ru/upload/medialibrary/942/942bffc3a573a657380a7289dc7a7912.jpg" title="желдор.jpg"
                                    width="84" hspace="2" height="35" border="0" align="left"> </a>
                            <a target="_blank" title="Энергия" href="http://nrg-tk.ru/contacts/russia/voronezh.html">
                                <img alt="6.jpg" src="/bitrix/templates/main/images/del_logo_1.png" title="желдор.jpg" width="100" hspace="2" border="0"
                                    align="left"> </a>
                            <a target="_blank" title="ЦАП" href="http://www.avtotransit.ru/">
                                <img alt="6.jpg" src="/bitrix/templates/main/images/del_logo_2.png" title="желдор.jpg" width="120" hspace="2" border="0"
                                    align="left"> </a>
                            <a target="_blank" title="ПЭК" href="https://www.cdek.ru/">
                                <img alt="logo-sdek.jpg" src="/upload/medialibrary/logo-sdek.jpg" width="120" hspace="2" height="26" border="0" align="left"> </a>
                            <div class="clear">
                            </div>
                        </div>
                        <p>
                            Обработка и отправка заказов в регионы осуществляется от 2000руб.
                        </p>
                        <p>
                            <b>Внимание!</b> Товар по заказам без оплаты резервируется на 3 рабочих дня. В случае отсутствия
                            оплаты товары автоматически снимаются с резерва.
                        </p>
                    </div>
                </div>
            </div>
            <span style="border-radius: 2px; text-indent: 20px; width: auto; padding: 0px 4px 0px 0px; text-align: center; font: bold 11px/20px &quot;Helvetica Neue&quot;,Helvetica,sans-serif; color: #ffffff; background: #bd081c url(&quot;data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMzBweCIgd2lkdGg9IjMwcHgiIHZpZXdCb3g9Ii0xIC0xIDMxIDMxIj48Zz48cGF0aCBkPSJNMjkuNDQ5LDE0LjY2MiBDMjkuNDQ5LDIyLjcyMiAyMi44NjgsMjkuMjU2IDE0Ljc1LDI5LjI1NiBDNi42MzIsMjkuMjU2IDAuMDUxLDIyLjcyMiAwLjA1MSwxNC42NjIgQzAuMDUxLDYuNjAxIDYuNjMyLDAuMDY3IDE0Ljc1LDAuMDY3IEMyMi44NjgsMC4wNjcgMjkuNDQ5LDYuNjAxIDI5LjQ0OSwxNC42NjIiIGZpbGw9IiNmZmYiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLXdpZHRoPSIxIj48L3BhdGg+PHBhdGggZD0iTTE0LjczMywxLjY4NiBDNy41MTYsMS42ODYgMS42NjUsNy40OTUgMS42NjUsMTQuNjYyIEMxLjY2NSwyMC4xNTkgNS4xMDksMjQuODU0IDkuOTcsMjYuNzQ0IEM5Ljg1NiwyNS43MTggOS43NTMsMjQuMTQzIDEwLjAxNiwyMy4wMjIgQzEwLjI1MywyMi4wMSAxMS41NDgsMTYuNTcyIDExLjU0OCwxNi41NzIgQzExLjU0OCwxNi41NzIgMTEuMTU3LDE1Ljc5NSAxMS4xNTcsMTQuNjQ2IEMxMS4xNTcsMTIuODQyIDEyLjIxMSwxMS40OTUgMTMuNTIyLDExLjQ5NSBDMTQuNjM3LDExLjQ5NSAxNS4xNzUsMTIuMzI2IDE1LjE3NSwxMy4zMjMgQzE1LjE3NSwxNC40MzYgMTQuNDYyLDE2LjEgMTQuMDkzLDE3LjY0MyBDMTMuNzg1LDE4LjkzNSAxNC43NDUsMTkuOTg4IDE2LjAyOCwxOS45ODggQzE4LjM1MSwxOS45ODggMjAuMTM2LDE3LjU1NiAyMC4xMzYsMTQuMDQ2IEMyMC4xMzYsMTAuOTM5IDE3Ljg4OCw4Ljc2NyAxNC42NzgsOC43NjcgQzEwLjk1OSw4Ljc2NyA4Ljc3NywxMS41MzYgOC43NzcsMTQuMzk4IEM4Ljc3NywxNS41MTMgOS4yMSwxNi43MDkgOS43NDksMTcuMzU5IEM5Ljg1NiwxNy40ODggOS44NzIsMTcuNiA5Ljg0LDE3LjczMSBDOS43NDEsMTguMTQxIDkuNTIsMTkuMDIzIDkuNDc3LDE5LjIwMyBDOS40MiwxOS40NCA5LjI4OCwxOS40OTEgOS4wNCwxOS4zNzYgQzcuNDA4LDE4LjYyMiA2LjM4NywxNi4yNTIgNi4zODcsMTQuMzQ5IEM2LjM4NywxMC4yNTYgOS4zODMsNi40OTcgMTUuMDIyLDYuNDk3IEMxOS41NTUsNi40OTcgMjMuMDc4LDkuNzA1IDIzLjA3OCwxMy45OTEgQzIzLjA3OCwxOC40NjMgMjAuMjM5LDIyLjA2MiAxNi4yOTcsMjIuMDYyIEMxNC45NzMsMjIuMDYyIDEzLjcyOCwyMS4zNzkgMTMuMzAyLDIwLjU3MiBDMTMuMzAyLDIwLjU3MiAxMi42NDcsMjMuMDUgMTIuNDg4LDIzLjY1NyBDMTIuMTkzLDI0Ljc4NCAxMS4zOTYsMjYuMTk2IDEwLjg2MywyNy4wNTggQzEyLjA4NiwyNy40MzQgMTMuMzg2LDI3LjYzNyAxNC43MzMsMjcuNjM3IEMyMS45NSwyNy42MzcgMjcuODAxLDIxLjgyOCAyNy44MDEsMTQuNjYyIEMyNy44MDEsNy40OTUgMjEuOTUsMS42ODYgMTQuNzMzLDEuNjg2IiBmaWxsPSIjYmQwODFjIj48L3BhdGg+PC9nPjwvc3ZnPg==&quot;) no-repeat scroll 3px 50% / 14px 14px; position: absolute; opacity: 1; z-index: 8675309; display: none; cursor: pointer; border: medium none;">Сохранить</span>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>