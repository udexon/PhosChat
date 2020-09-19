
#### (4) `foxy` sends `chromy` a message

In `foxy`'s browser console:

```js
CHAT("chromy", "hello chromy")
```
where the first argument is the recipient's nickname, the second argument the message to be sent.


<img src="https://github.com/udexon/PhosChat/blob/master/img/Chat_foxy.png" width=400>

In `foxy` console, the timestamp is `2020-09-19T13:50:32.567Z`.

<img src="https://github.com/udexon/PhosChat/blob/master/img/SSE_Chromium.png" width=400>

Server Side Event sends the message to the front end for `chromy` at `Sat, 19 Sep 2020 21:50:34 +0800`:

```
The server time is: Sat, 19 Sep 2020 21:50:34 +0800 shm 6
NN=chromy file ../auth/log/chat_foxy_20200919_215033 watch ../auth/log/chat_foxy_20200919_215033:20200919_215033 foxy {"to":"chromy","msg":"hello chromy"}
```

`../auth/log/chat_foxy_20200919_215033` is the temporary file used to save the message.

The message is encoded as a JSON string with timestamp and sender's nickname:

```
20200919_215033 foxy {"to":"chromy","msg":"hello chromy"}
```
