#HackerMakerMessenger 

Это самописный месседжер, написанный изначально на PHP, но после переписан на C#. Он был создан как альтернатива Discord, заблокированному в России, но теперь создаётся как альтернатива всему остальному, с открытым исходным кодом, возможностью изменения, адаптации и улучшения.

Установка копии (для себя и написания кода)
Необходимо иметь git и dotnet 8.0 (наверное можно и постарее, не знаю)
Установка - на сайте майков под винду или под Debian (да, на пингвине запустится)

```
wget https://packages.microsoft.com/config/debian/12/packages-microsoft-prod.deb -O packages-microsoft-prod.deb
sudo dpkg -i packages-microsoft-prod.deb
rm packages-microsoft-prod.deb

sudo apt-get update && \
  sudo apt-get install -y dotnet-sdk-8.0
```
Установка и запуск
```
git clone https://github.com/NThacker5246/HackerMakerMessenger.git
cd ./HackerMakerMessenger
dotnet run
```

Для линукса dotnet run нужно с sudo, для винды даже права администратора не нужны.

Дальше для запуска можно открывать launch.bat.