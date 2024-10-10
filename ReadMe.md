В поле куда можно ввести текст соответcтвует первая кнопка. При нажатии на неё, отправляется текст. Поле Choose a file при нажатии, откроется проводник. Нажимая на 2-ю кнопку send файл загрузится на сервер и textlog заполнится файлами


Настройка SQL

mysql -u root -p

Пароля нет.

CREATE DATABASE hackerbase CHARACTER SET utf8 COLLATE utf8_general_ci;
USE hackerbase;

CREATE TABLE users (
name VARCHAR(400) NOT NULL,
password VARCHAR(200) NOT NULL,
type TINYINT(1) NOT NULL,
PRIMARY KEY(id)
);

