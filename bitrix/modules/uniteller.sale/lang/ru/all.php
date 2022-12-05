﻿<?php
/**
 * Файл со всеми языковыми константами.
 *
 * Выдержка из помощи 1C-Bitrix:
 * 		"Подключаемый языковой файл должен иметь то же имя, что и подключающий файл, и быть расположен на диске в каталоге:
 * 		/bitrix/modules/ID модуля/lang/ID языка/путь к файлу относительно корня модуля."
 * Было принято решение разместить все языковые константы в один общий файл, чтобы не создавать множество различных маленьких файлов.   
 * @author r.smoliarenko
 * @author r.sarazhyn
 * @author Alexey A. Pogrebets (www.relengy.ru)
 */

global $MESS;
// uniteller.sale/install/index.php
$MESS['UNITELLER.SALE_INSTALL_NAME'] = 'Платёжная система Uniteller';
$MESS['UNITELLER.SALE_INSTALL_DESCRIPTION'] = 'Описание модуля Платёжная система Uniteller <a href="/bitrix/admin/settings.php?lang=ru&mid=uniteller.sale&mid_menu=1" target="_blank">Перейти на страницу помощи</a>';
$MESS['UNITELLER.SALE_PREINSTALL_DESCRIPTION'] = 'Мастер подключение модуля «Платёжная система Uniteller»';
$MESS['UNITELLER.SALE_INSTALL_ERROR'] = 'При установке модуля Платёжная система Uniteller произошла ошибка при копировании файлов.';

// uniteller.sale/install/step_ok.php
$MESS['UNITELLER.SALE_INSTALL_MESSAGE'] = 'Модуль «Платёжная система Uniteller» был установлен.';

// uniteller.sale/install/unstep_ok.php
$MESS['UNITELLER.SALE_BTN_CANCEL'] = 'Отмена';
$MESS['UNITELLER.SALE_SAVE_TABLES'] = 'Сохранить таблицу модуля «Платёжная система Uniteller»?';

// uniteller.sale/options.php & uniteller.sale/install/step_ok.php & uniteller.sale/admin/uniteller_agent_log.php
$MESS['UNITELLER.SALE_BTN_HELP'] = 'Помощь';

// admin/uniteller_agent_log.php
$MESS['UNITELLER.AGENT_ORDER_ID'] = 'ID Заказа';
$MESS['UNITELLER.AGENT_INSERT_DATATIME'] = 'Время добавления ошибки';
$MESS['UNITELLER.AGENT_TYPE_ERROR'] = 'Тип ошибки';
$MESS['UNITELLER.AGENT_TEXT_ERROR'] = 'Описание ошибки';
$MESS['UNITELLER.AGENT_LOGS_TITLE'] = 'Логи модуля «Платёжная система Uniteller»';
$MESS['UNITELLER.AGENT_LOGS_DEL'] = 'Удалить';
$MESS['UNITELLER.AGENT_DEL_ERROR'] = 'Невозможно удалить запись.';
$MESS['UNITELLER.AGENT_NAV'] = 'Логи ошибок';
$MESS['UNITELLER.AGENT_DEL_CONF'] = 'Удалить запись?';
$MESS['UNITELLER.AGENT_F_ORDER_ID'] = 'ID Заказа';
$MESS['UNITELLER.AGENT_F_INSERT_DATATIME'] = 'Время добавления';
$MESS['UNITELLER.AGENT_F_TYPE_ERROR'] = 'Тип ошибки';
$MESS['UNITELLER.AGENT_F_TEXT_ERROR'] = 'Описание ошибки';
$MESS['UNITELLER.AGENT_FIND'] = 'Найти';
$MESS['UNITELLER.AGENT_F_FIND_TYTLE'] = 'Введите строку для поиска';
$MESS['POST_ALL'] = 'Все';

// uniteller.sale/options.php
$MESS['UNITELLER.AGENT_LOGS'] = 'Логи модуля';
$MESS['UNITELLER.SALE_HELP_TEXT'] = '
<h3>Инструкция по установке и настройке модуля «Платёжная система Uniteller» в CMS 1C-Bitrix</h3>
<b>Настройка системы Uniteller</b>
<p>
<div>1. Зайти в «Личный кабинет» Uniteller.</div>
<div>2. В «Личном кабинете» зайти на страницу «Договоры» и нажать на ссылку «Настройки» нужного магазина. Откроется страница настроек.</div>
<div>3. В поле ввода «URL-адрес магазина» ввести «http://адрес_электронного_магазина/».</div>
<div>4. В поле ввода «E-Mail службы поддержки магазина» ввести e-mail.</div>
<div>5. В поле «URL для уведомления сервера интернет-магазина об изменившемся статусе счёта/оплаты» ввести «http://адрес_электронного_магазина/personal/ordercheck/result_rec.php».</div>
</p>
<b>Установка модуля</b>
<p>
<div>1. Зайти под логином администратора на сайт в панель «Администрирование».</div>
<div>2. Перейти в раздел «Настройки–>Marketplace». В списке найти модуль «Платёжная система Uniteller». Дважды кликнуть по нему мышкой. Нажать на кнопку «Загрузить».</div>
<div>3. Выбрать в списке модуль «Платёжная система Uniteller». Нажать на кнопку «Установить». Увидим сообщение «Модуль «Платёжная система Uniteller» был установлен».</div>
<div>4. После установки нажать на кнопку «Вернуться в список». В списке модулей у модуля «Платёжная система Uniteller» будет стоять статус «Установлен».</div>
</p>
<h3>Настройка модуля</h3>
<b>Настройка сайта</b>
<p>
<div>1. Зайти под логином администратора на сайт в панель «Администрирование».</div>
<div>2. Перейти в раздел: «Настройки–>Настройки продукта–>Сайты–>Список сайтов». В списке сайтов выбрать нужный интернет-магазин и дважды кликнуть по нему мышкой. В поле «URL сервера (без http://)» ввести действительный URL интернет магазина (без http://). В поле «E-Mail адрес по умолчанию» ввести действительный e-mail интернет магазина.</div>
<div>3. Перейти в раздел «Магазин–>Настройки магазина–>Статусы». Нажать на кнопку «Новый статус». Откроется раздел для создания нового статуса. Напротив поля «Код», ввести код статуса, английская буква «B». В поле «Название», раздел «Russian» ввести «Средства заблокированы». В поле «Название», раздел «English» ввести «Funds blocked». Нажать кнопку «Сохранить». В списке статусов появится новый статус «B» – «Средства заблокированы».</div>
</p>
<b>Настройка платёжной системы Uniteller</b>
<p>
<div>1. Перейти в раздел: «Магазин–>Настройки магазина–>Платежные системы».</div>
<div>2. В этом разделе над таблицей платёжных систем нажать на кнопку «Добавить платежную систему», после чего в выпавшем меню выбрать сайт, для которого будет добавлена платёжная система. Откроется раздел добавления новой платёжной системы.</div>
<div>3. Перейти во вкладку «Платежная система». Заполнить все необходимые поля. Поле «Валюта» – валюта платёжной системы. Поле «Название» – ввести слово «Uniteller». Поле «Активность» – ставим галочку. Поле «Сортировка» – ввести значение 1. Поле «Описание» – краткое описание платёжной системы.</div>
<div>4. Перейти на вкладку «Физическое лицо».</div>
<div>&nbsp;&nbsp;a. В поле «Применяется для данного типа плательщика» поставить галочку, если нужно, чтобы выбранная нами платёжная система работала с «Физическими лицами». В поле «Название» указываем название обработчика платёжной системы. В поле «Обработчик» выбираем из выпавшего списка «Uniteller». Открываются дополнительные поля.</div>
<div>&nbsp;&nbsp;b. Заполнить поле «Описание платежной системы».</div>
<div>&nbsp;&nbsp;c. В поле «Код магазина» ввести «Uniteller Point ID» со страницы «Точки продажи компании» личного кабинета.</div>
<div>&nbsp;&nbsp;d. В поле «Логин» ввести логин со страницы «Параметры авторизации» личного кабинета.</div>
<div>&nbsp;&nbsp;e. В поле «Пароль» ввести пароль со страницы «Параметры авторизации» личного кабинета.</div>
<div>&nbsp;&nbsp;f. В поле «Латинское наименование точки приема, присвоенное Uniteller» ввести «Название магазина» со страницы «Перечень договоров компании» личного кабинета.</div>
<div>&nbsp;&nbsp;g. Необязательное поле «Время жизни формы оплаты в секундах». Должно быть целым положительным числом. Если покупатель проведет на форме дольше, чем указанное время, то форма оплаты будет считаться устаревшей, и платеж не будет принят. Покупателю в таком случае будет предложено вернуться на сайт.</div>
<div>&nbsp;&nbsp;h. Необязательное поле «Время, в течение которого статус платежа "paid" может быть отменён». Если не ввести ничего, то в качестве значения по умолчанию будет использоваться значение 14 (дней). Чем меньше этот период, тем меньше запросов при синхронизации статусов будет генерировать модуль к системе Uniteller.</div>
<div>&nbsp;&nbsp;i. Необязательное поле «Время, в течение которого статус платежа будет синхронизироваться». Если не ввести ничего, то в качестве значения по умолчанию будет использоваться значение 30 (дней). Чем меньше этот период, тем меньше запросов при синхронизации статусов будет генерировать модуль к системе Uniteller.</div>
<div>&nbsp;&nbsp;j. В поле «Адрес при успешной оплате (URL_RETURN_OK)» ввести «http://адрес_электронного_магазина/personal/ordercheck/check/».</div>
<div>&nbsp;&nbsp;k. В поле «Адрес при ошибке оплаты (URL_RETURN_NO)» ввести «http://адрес_электронного_магазина/personal/ordercheck/detail/».</div>
<div>&nbsp;&nbsp;l. В поле «Тестовый режим» ввести «Да» для включения тестового режима или очистить его для проведения реальной оплаты.</div>
<div>5. Перейти на вкладку «Юридическое лицо» и повторить все действия по аналогии с вкладкой «Физическое лицо».</div>
<div>6. Нажать кнопку «Сохранить». В списке появится платёжная система «Uniteller».</div>
</p>
<b>Добавление списка чеков</b>
<p>
<div>1. Зайти под логином администратора на сайт в панель «Сайт».</div>
<div>2. Выбрать в выпадающем меню «Меню–>Редактировать левое меню».</div>
<div>3. Изменить ссылку напротив пункта «Мои заказы» с «order/» на «ordercheck/».</div>
<div>4. Если такой ссылки в этом меню нет, то добавить её. Если по дизайну сайта в нём нет левого меню, то добавить эту ссылку в любое удобное меню.</div>
<div>&nbsp;&nbsp;<b>Дополнение</b></div>
<div>&nbsp;&nbsp;Ссылка на страницу чека находится в шаблоне по умолчанию, компонента «bitrix:sale.personal.ordercheck.list». Если нужно добавить эту же ссылку в другой шаблон этого же компонента, то нужно в соответствующий файл шаблона в нужное место вставить:</div>
<div>&nbsp;&nbsp;&lt;!-- UnitellerPlugin add --&gt;</div>
<div>&nbsp;&nbsp;&lt;?if ($vval["ORDER"]["NEED_CHECK"] == "Y"):?&gt;</div>
<div>&nbsp;&nbsp;&lt;a title="&lt;?= GetMessage(\STPOL_CHECK\'); ?&gt;" href="&lt;?= $vval[\'ORDER\'][\'URL_TO_CHECK\']; ?&gt;"&gt;&lt;?= GetMessage(\'STPOL_CHECK\'); ?&gt;&lt;/a&gt;</div>
<div>&nbsp;&nbsp;&lt;?endif;?&gt;</div>
<div>&nbsp;&nbsp;&lt;!-- /UnitellerPlugin add --&gt;</div>
<div>5. Перейти в публичную часть сайта «Сайт». Включить «Режим правки». В шапке сайта выбрать ссылку «Мои заказы». Выделить этот блок и нажать «Редактировать эту область как text». В появившемся окне найти «&lt;li&gt;&lt;a href="/personal/order/"&gt;Мои заказы&lt;/a&gt;&lt;/li&gt;» и заменить на «&lt;li&gt;&lt;a href="/personal/ordercheck/"&gt;Мои заказы&lt;/a&gt;&lt;/li&gt;». Нажать «Сохранить». Появиться сообщение «Страница успешно изменена. Отменить изменения». Выключить «Режим правки».</div>
</p>
<b>Удаление модуля</b>
<p>
<div>1. Перейти в раздел «Настройки–>Модули». В списке выбрать модуль «Платёжная система Uniteller». Нажать на кнопку «Удалить». Увидим сообщение «Внимание! Модуль будет удален из системы со всеми настройками.».</div>
<div>2. Для сохранения таблиц модуля в базе данных нужно оставить галочку напротив поля «Сохранить таблицу модуля «Платёжная система Uniteller»?».</div>
<div>3. Нажать на кнопку «Удалить». В списке модулей у модуля «Платёжная система Uniteller» будет стоять статус «Не установлен».</div>
<div>&nbsp;&nbsp;<b>Дополнение</b></div>
<div>&nbsp;&nbsp;1. Если убрать галочку с поля «Сохранить таблицу модуля «Платёжная система Uniteller»?» – то таблица с логами ошибок будет удалена из базы данных. Если оставить галочку – таблица останется и будет подключена при последующей установке, все данные сохраняться и будут доступны.</div>
<div>&nbsp;&nbsp;2. При удалении модуля останется папка с пакетом установщика «папка_с_bitrix/bitrix/modules/uniteller.sale», все остальные файлы будут удалены.</div>
</p>
<b>Обновление модуля</b>
<p>
<div>1. Перейти в раздел «Настройки–>Marketplace–>Сторонние обновления».</div>
<div>2. Перейти на вкладку «Список обновлений». При наличии обновлений для модуля «Платёжная система Uniteller» выбрать их все. Нажать на кнопку «Установить обновления». Высветиться сообщение «Успешно установлено обновлений: (количество)».</div>
</p>
<b>Настройки cron-а</b><br/><br/>
<b>Windows</b>
<p>
<div>1. Файловым менеджером открыть файл «cron.bat», который находится в папке «папка_с_bitrix/».</div>
<div>2. В открытом файле прописать путь к необходимым файлам.</div>
<div>&nbsp;&nbsp;a. В переменную phpexe_path присвоить полный путь к файлу php.exe.</div>
<div>&nbsp;&nbsp;b. В переменную phpini_path присвоить полный путь к файлу php.ini.</div>
<div>&nbsp;&nbsp;c. В переменную bitrix_path присвоить «папка_с_bitrix\bitrix\modules\sale\payment\uniteller\cron.php».</div>
<div>&nbsp;&nbsp;d. Сохранить.</div>
<div>3. Подключить cron.bat в планировщике задач ОС Windows на ежеминутное выполнение.</div>
</p>
<b>Linux</b>
<p>
<div>1. Выполнить следующие действия от имени администратора:</div>
<div>&nbsp;&nbsp;a. Открыть консоль.</div>
<div>&nbsp;&nbsp;b. Выполнить команду: «crontab -e».</div>
<div>&nbsp;&nbsp;c. Прописать и сохранить: «*/1 * * * * /путь_от_корня_диска_к_скрипту/php -f /путь_от_корня_диска_к_файлу/cron.php».</div>
</p>
<b>Дополнение</b>
<p>
<div>Все инъекции кода плагина Uiteller в файлы 1C-Bitrix выделены специальными комментариями:</<div>
<div>1. Начало добавленного кода: «UnitellerPlugin add».</<div>
<div>2. Конец добавленного кода: «/UnitellerPlugin add».</div>
<div>3. Начало замененного кода: «UnitellerPlugin change».</div>
<div>4. Конец замененного кода: «/UnitellerPlugin change».</div>
</p>';
?>