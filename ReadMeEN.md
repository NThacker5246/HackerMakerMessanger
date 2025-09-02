<h1>HackerMakerMessenger</h1>

A messenger written in PHP, later reworked in C#. It was created as an FOS alternative to Discord that opens creative freedom for modifications etc.

## Installing a copy

Requirements:
Git (latest version recommended)
.NET 8.0


https://git-scm.com/downloads
https://dotnet.microsoft.com/en-us/download/dotnet/8.0

You can use Terminal in order to install .NET on Linux distributives. We provide example for Debian/Ubuntu systems below:

```bash
wget https://packages.microsoft.com/config/debian/12/packages-microsoft-prod.deb -O packages-microsoft-prod.deb
sudo dpkg -i packages-microsoft-prod.deb
rm packages-microsoft-prod.deb

sudo apt-get update && \
sudo apt-get install -y dotnet-sdk-8.0
```

Download Messenger and startup

```bat
git clone https://github.com/NThacker5246/HackerMakerMessanger.git
cd ./HackerMakerMessenger
dotnet run
```

Please acknowledge that you will require administrative privileges in order to run .NET

You can use launch.bat on windows systems for easier start

<hr>
<h2>Participation</h2>
1. If you have a question/suggestion/found a bug - write in Issue (check if there aren't similar issues)
Steps: https://github.com/NThacker5246/HackerMakerMessanger/issues and click New Issue
Title - describe the question/bug/suggestion as precise as possible in 2-4 words


Bug Issue template

```
I found a bug/error in the application, <name as in the Issue title>
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
1. Description of the question/problem/suggestion
2. Branch for implementing the proposal (if you are not a developer, the developers themselves will attach the branch
3. Additional suggestions
```
