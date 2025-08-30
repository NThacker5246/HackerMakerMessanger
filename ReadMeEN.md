<h1>HackerMakerMessenger</h1>

This is a self-written messenger, originally written in PHP, but then rewritten in C#. It was created as an alternative to Discord, blocked in Russia, but now it is being created as an alternative to everything else, with open source code, the ability to change, adapt and improve.

Installing a copy (for yourself and writing code)
You need to have git and dotnet 8.0 (probably older is possible, I don't know)
Installation - on the Microsoft website for Windows or Debian (yes, it will run on Linux)

```bash
wget https://packages.microsoft.com/config/debian/12/packages-microsoft-prod.deb -O packages-microsoft-prod.deb
sudo dpkg -i packages-microsoft-prod.deb
rm packages-microsoft-prod.deb

sudo apt-get update && \
sudo apt-get install -y dotnet-sdk-8.0
```
Installation and launch

```bat
git clone https://github.com/NThacker5246/HackerMakerMessanger.git
cd ./HackerMakerMessenger
dotnet run
```

For Linux dotnet run is needed with sudo, for Windows even administrator rights are not needed.

Then you can open launch.bat to run. (Win)
<hr>
<h2>How to participate in development?</h2>
1. If you have a question/suggestion/found a bug - write in Issue (check if there are similar Issues, if there are and it didn't help, then write, if not, then also write)
Steps: https://github.com/NThacker5246/HackerMakerMessanger/issues and click New Issue
Title - describe the question/bug/suggestion as accurately as possible in 2-4 words
Bug Issue template

```
I found a bug/error in the application, <name as in the Issue title>, and I want to report it
1. Current behavior
When <describe the exact algorithm of actions to reproduce>, <action> occurs
2. Expected behavior
When identical actions, <action> should occur
3. Platform
<write what is in winver + version .net, + commit hash>
//example
Windows NT Workstaion 10.0, dotnet-sdk 8.0, commit c9c1e8c
4. Algorithm for troubleshooting
<if you are not a developer, write - (dash)>
```
For a question/problem/suggestion

```
I have a question/problem/suggestion <question as in the title>
1. Description of the question/problem/suggestion (with the latter, describe exactly what you want)
2. Branch for implementing the proposal (if you are not a developer, the developers themselves will attach the branch
3. How you want it to be (additional wishes)
```
