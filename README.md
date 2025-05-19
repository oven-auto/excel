<ul>
	<li>
		<i>Реализовать контроллер с валидацией и загрузкой excel файла (xlsx).</i><br>
		Контроллер сделан. App\Http\Controllers\Api\v1\Excel\ExcelController. Метод import. 
		На вход кастомный реквест класс ExcelRequest, с правилом file => required|file|extensions:xls,xlsx.
	</li>

	<li>
		<i>Доступ к контроллеру загрузки закрыть basic-авторизацией.<i>
		Создал контролллер App\Http\Controllers\Api\v1\Auth\AuthController. Авторизация через Санктум.
		Методы: /api/auth/register, /api/auth/login
	</li>

	<li>
		<i>Поля excel</i>
		Взял ваш
	</li>
		
</ul>