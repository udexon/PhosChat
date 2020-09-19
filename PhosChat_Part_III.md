
#### (5) `chromy` sends `foxy` a message

To reciprocate, `chromy` sends `foxy` a message

In `chromy`'s browser console:

```js
CHAT("foxy", "open sesame")
```
where the first argument is the recipient's nickname, the second argument the message to be sent.


<img src="https://github.com/udexon/PhosChat/blob/master/img/Chat_chromy.png" width=400>

In `chromy` console, the timestamp is `2020-09-19T14:08:02.546Z`.

<img src="https://github.com/udexon/PhosChat/blob/master/img/SSE_Firefox.png" width=400>

Server Side Event sends the message to the front end for `foxy` at `Sat, 19 Sep 2020 22:08:03 +0800`:

```
The server time is: Sat, 19 Sep 2020 22:08:03 +0800 shm 6
NN=foxy file ../auth/log/chat_chromy_20200919_220802 watch ../auth/log/chat_chromy_20200919_220802:20200919_220802 chromy {"to":"foxy","msg":"open sesame"}
```
