# PhosChat: A Revolutionary "Decentralized WITHOUT Blockchain" (DxBC) Chat System

- Parts: [I](https://github.com/udexon/PhosChat/blob/master/README.md) [II](https://github.com/udexon/PhosChat/blob/master/PhosChat_Part_II.md) [III](https://github.com/udexon/PhosChat/blob/master/PhosChat_Part_III.md) [IV](https://github.com/udexon/PhosChat/blob/master/PhosChat_Part_IV.md)


### DxBC: Decentralization WITHOUT Blockchain

Vitalik Buterin popularized the term "decentralized applications" in the now perhaps legendary blog published in 2014:

- https://blog.ethereum.org/2014/05/06/daos-dacs-das-and-more-an-incomplete-terminology-guide/

From a different perspective, the term "decentralized" has been "hijacked and abused" by blockchain advocates in the past few years with some notable, but limited, progress. 

One may even say that blockchain is just a very clumsy way to do decentralized database.

We adopted this term largely due to the fact that our framework has a common root with blockchain in asymmetric cryptography, and it modifies significantly one of the most fundamental step in network computing: user authentication.

Hence the name:

- __DxBC: Decentralization WITHOUT Blockchain__


### Collaborative Development using Phoscript &mdash; a Universal Metaprogramming Script derived from Forth

Another novel feature of this project is the deployment of Phoscript &mdash; a universal metaprogramming script derived from Forth.

- [Phoscript Tutorials](https://github.com/udexon/Multiweb/blob/master/Phoscript_Tutorials.md)

By "universal metaprogramming script", we mean that Phoscript can be implemented as a shell script within any host programming language, ranging from C++, JavaScript to Rust, providing a Forth like Reverse Polish Notation / stack machine interface to the host programming language, function libraries and frameworks.

In PhosChat, we demonstrate that how Phoscript can be used to interface to JavaScript front end and PHP back end, all using one universal metaprogramming script. 

Although the term metaprogramming may sound abstract to many non-programmers or programmers alike, it is not difficult to pick up as we can all learn by examples. 

Further, metaprogramming is also akin to human natural language, where we use words (which incidentally is also the Forth terminology for "function names") to represent "collections" of items. As such, we believe that even non-programmers will be able to learn Phoscript easily, much like:
- how the Logo programming language was invented almost at the same time (1967) as Forth (public release 1968) to teach non-programmers computer graphics (2D turtle drawing lines); or 
- how non-programmers can learn to use spreadsheet quickly, which makes us introduce the pun "as easy as (Lotus) 1-2-3", to remind younger readers of the legendary spreadsheet program; and 
- how a whole generation of engineers used HP (and other brands) Reverse Polish calculators for extremely complicated tasks before computers became a commodity.


## I: Decentralized User Authentication

1. In a previous article, we demonstrated "Decentralized User Authentication" using Hydergraph which overcomes many design flaws in blockchain and cryptocurrencies from the most fundamental level:

- https://github.com/udexon/Hydergraph

Here we demonstrated DUA using AJAX.


2. In an earlier article, we demonstrated DUA using Websocket:

- https://github.com/udexon/XIDT/blob/master/Greet_Secret_Phrase.md


3. In this article, we shall demonstrate a simple Decentralized Chat application based on (1).

The source code for this demo is available at:

- https://github.com/udexon/PhosChat/tree/master/PhosChat

To install, just unpack it to a localhost directory (on Ubuntu `/var/www/html/devel`).

Then it can be accessed from a browser with:

- http://localhost/devel/PhosChat/auth/phos.html

<img src="https://github.com/udexon/PhosChat/blob/master/img/Chat_Start.png" width=400>

We would first like to apologize to readers as the text in `phos.html` page is not directly related to PhosChat as described in this article. This page has been retained during the development to test the continuity of various packages used.

#### (A) Module for Sending Messages

The most relevant files used in PhosChat are:

https://github.com/udexon/PhosChat/tree/master/PhosChat/auth

1. `phos.js`
2. `phos.php`

We have not made use of any GUI element, but instead used only pure JavaScript to accomplish the decentralized user authentication (DUA) as well as sending of messages to the back end.

#### (B) Displaying Messages using Server Side Events (SSE)

https://github.com/udexon/PhosChat/tree/master/PhosChat/auth

Incoming messages are displayed via the Server Side Events protocol with files `./sse` directory.

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


#### (3) Set Nickname (`NN`)

Unlike Centralized User Authentication (CUA) systems, where the User-ID is a unique string approved and managed by a centralized administration system, in Decentralized User Authentication, a user may arbitrarily choose a _"nickname"_ (`NN`), which correspond to his (her) own unique public key (`PBK`), as a convenient label during chat.

The only rule that PhosChat server needs to make sure is the uniqueness of the nickname.

```js
B("foxy nick")
B("SESSION: s:")
S[S.length-1].response
```

<img src="https://github.com/udexon/PhosChat/blob/master/img/B_foxy_nick.png" width=400>

`B("foxy nick")` follows Reverse Polish Notation convention, where `foxy` is pushed on to the stack first, then `nick` is executed.

`NN` is part of `AUTH` array as returned by AJAX `.response`.

```
AUTH' => array ( 
'SP' => 'c5fb97e7', 
'PASS' => '20200919_211637', 
'NN' => 'foxy', ), )
```

We chose `foxy` as the nickname as we are using Firefox for this user.

To simulate another user, we will be using Chromium browser and thus nickname `chromy`.

<img src="https://github.com/udexon/PhosChat/blob/master/img/Chat_Start_Chromium.png" width=400>

<img src="https://github.com/udexon/PhosChat/blob/master/img/B_chromy_nick.png" width=400>

- Parts: [I](https://github.com/udexon/PhosChat/blob/master/README.md) [II](https://github.com/udexon/PhosChat/blob/master/PhosChat_Part_II.md) [III](https://github.com/udexon/PhosChat/blob/master/PhosChat_Part_III.md) [IV](https://github.com/udexon/PhosChat/blob/master/PhosChat_Part_IV.md)
