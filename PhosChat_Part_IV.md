
#### (5) `groovy` joins PhosChat via `ngrok` tunnel

Finally, we demonstrate that PhosChat can work via `ngrok` tunnel (SSH tunnel).

<img src="https://github.com/udexon/PhosChat/blob/master/img/terminal_ngrok.png" width=400>

In `groovy`'s browser and console:

<img src="https://github.com/udexon/PhosChat/blob/master/img/Start_Groovy.png" width=400>


```js
CHAT("chromy", "priviet comrade")
```
where the first argument is the recipient's nickname, the second argument the message to be sent.


<img src="https://github.com/udexon/PhosChat/blob/master/img/Chat_groovy.png" width=400>

In `groovy` console, the timestamp is `2020-09-19T14:20:45.800Z`.

<img src="https://github.com/udexon/PhosChat/blob/master/img/SSE_Chromium_groovy.png" width=400>

Server Side Event sends the message to the front end for `chromy` at `Sat, 19 Sep 2020 22:20:48 +0800`:

```
The server time is: Sat, 19 Sep 2020 22:20:48 +0800 shm 6
NN=chromy file ../auth/log/chat_groovy_20200919_222046 
watch ../auth/log/chat_groovy_20200919_222046:
20200919_222046 groovy {"to":"chromy","msg":"priviet comrade"}
```

