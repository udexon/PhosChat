# PhosChat: A Revolutionary "Decentralized without Blockchain" (DxBC) Chat System

II: Decentralized User Authentication

Vitalik Buterin

https://blog.ethereum.org/2014/05/06/daos-dacs-das-and-more-an-incomplete-terminology-guide/

The term "decentralized" has been "hijacked and abused" by blockchain advocates in the past few years with some notable, but limited, progress. We adopted this term largely due to the fact that our framework has a common root with blockchain in asymmetric cryptography, and it modifies significantly one of the most fundamental step in network computing: user authentication.

Blockchain is just a very clumsy way to do decentralized data base.

Hydergraph overcomes many design flaws in block chain and cryptocurrencies from the most fundamental level.

1. https://github.com/udexon/XIDT/blob/master/Greet_Secret_Phrase.md

We demonstrated DUA using Websocket.

2. In https://github.com/udexon/Hydergraph

We demonstrated DUA using AJAX.

In this article, we shall demonstrate a simple Decentralized Chat application based on (2).

http://localhost/devel/PhosChat/auth/phos.html

<img src="https://github.com/udexon/PhosChat/blob/master/img/Chat_Start.png" width=400>

We would first like to apologize to readers as the text in `phos.html` page is not directly related to PhosChat as described in this article. This page has been retained during the development to test the continuity of various packages used.

#### (A) 

The most relevant files used in PhosChat are:

https://github.com/udexon/PhosChat/tree/master/PhosChat/auth

1. `phos.js`
2. `phos.php`

We have not made use of any GUI element, but instead used only pure JavaScript to accomplish the decentralized user authentication (DUA) as well as sending of messages to the back end.

#### (B)

https://github.com/udexon/PhosChat/tree/master/PhosChat/auth

Incoming messages are displayed via the Server Side Event protocol in `./sse` directory.

We hope by demonstrating PhosChat with such minimal GUI interface, readers would understand that PhosChat is robust enough to be operational in any minimalist web environment, and that additional GUI can be added eventually.

#### (1) Checking PHP `$_SESSION` variable

We make use of PHP `$_SESSION` to store variables that are required throughout a session (made up of _multiple PHP AJAX instances_), as _a PHP AJAX instance_ (together with its variables) lasts only as long as a call to invoke `phos.php` to execute a short sequence of commands.

```js
B("SESSION: s:")
S[S.length-1].response
```

`B( CMD )` is a JavaScript front end command entered through the browser console, which sends the command `CMD` in Phoscript Reverse Polish Notation (a Forth-like syntax) to the back end (hence `B()`).

`SESSION:` retrieves `$_SESSION` and pushes it to the top of the stack `$S` at PHP back end.

`s:` displays the whole stack, which is sent back to the front end via AJAX `.response`.

In the JavaScript front end, there is a corresponding stack variable `S`. 

`S[S.length-1]` is the last element of the the stack array `S`, or the _"top"_ of the stack.

The AJAX `.response` results are shown below:

<img src="https://github.com/udexon/PhosChat/blob/master/img/B_SESSION.png" width=400>

Readers familiar with Forth may find the screenshot familiar yet unfamiliar. During initialization, `$_SESSION` is loaded with Phoscript _aliases_ or _Colon Definition Words_, the Forth equivalent of high level functions, which are in turn made up of low level functions. 


#### (2) Decentralized User Authentication

Readers unfamiliar with Forth aliases or CDW need not worry at this stage, as the most important thing of concern is the `AUTH` array used for authentication, which is apparently absent from the AJAX `.response` results. This is expected as we have yet to accomplish the Decentralized User Authentication (DUA).

DUA has been described in detailed in:
- https://github.com/udexon/Hydergraph

This is perhaps the most important step in this whole tutorial as it is the core of the novelties of PhosChat. The commands to execute are:

```js
c = new JSEncrypt()
B_AUTH( c )
B("SESSION: s:")
S[S.length-1].response
```

<img src="https://github.com/udexon/PhosChat/blob/master/img/B_AUTH.png" width=400>

We now see that AJAX `.response` gives:

```
'AUTH' => array ( 'SP' => '81d1560e', 'PASS' => '20200919_193005', ), ), )
```

`SP` is the "secret phrase" used by PHP back end to challenge the front end, to prove that it is the legitimate owner of the private key capable of decrypting the encrypted secret phrase. In this case, it is a hexadecimal representation of 4 random bytes. The length of the secret phrase can of course be increased to improve the strength of security.

`PASS` is the timestamp when DUA is passed, which can be used for timing out the current session.
