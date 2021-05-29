<p align="center">
    <h1 align="center">EAPTEKA</h1>
    <br>
</p>

<h4>Реализованная функциональность</h4>
<ul>
    <li>1.</li>
</ul>

<h4>Основной стек технологий:</h4>
<ul>
	<li>HTML, CSS, JavaScript.</li>
	<li>PHP 8, PostgreSQL.</li>
	<li>Yii2.</li>
  	<li>SASS, Parcel, jQuery, Bootstrap, SCSS, BEM.</li>
	<li>Docker, Docker-Compose, Git.</li>
	<li>Github.</li>
 </ul>
 
<h4>Демо</h4>
<p>Демо сервиса доступно по адресу:  </p>

СРЕДА ЗАПУСКА
------------
1) развертывание сервиса производится на debian-like linux (debian 9+, ubuntu 20.04+);
2) требуется установленный пакет make для пошаговой установки всех зависимостей проекта;
3) требуется установленный паке Docker и docker-compose для автоматизации развёртывания проекта;

Предварительная настройка
------------
### Установка Docker
1) `sudo apt update`;
2) `sudo apt install apt-transport-https ca-certificates curl software-properties-common`;
3) `curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -`;
4) `sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"`;
5) `sudo apt update`;
6) `sudo apt install docker-ce`;
### Установка Docker-compose
1) `sudo curl -L "https://github.com/docker/compose/releases/download/1.29.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose`;
2) `sudo chmod +x /usr/local/bin/docker-compose`
### Установка пакета make
1) `sudo apt install make`

УСТАНОВКА
------------
### Клонирование репозитория
1) `git clone https://github.com/Restlin/eapteka_hack`
2) `cd eapteka_hack`
### Автоматическое развертывание проекта
1) `make init`

После успешного развертывания, проект будет доступен по адресу: localhost:8081

РАЗРАБОТЧИКИ

<h4>Шумилов Илья teamlead, архитектор, backend разработчик https://t.me/RestlinRu </h4>
<h4>Марина Никулина бизнес аналитик, тестировщик https://t.me/Ulitka213 </h4>
<h4>Калинин Сергей frontend разработчик https://t.me/kalinss16 </h4>
<h4>Николаев Дмитрий backend разработчик https://t.me/DmitriiNiko </h4>

