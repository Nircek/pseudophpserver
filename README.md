# PseudoPHPServer
Software for sending, identifying, authorizing data sending between PC (PseudoClient) and PS (PseudoServer).
## Types
We split PPS files into 3 groups:
- PCF - files used by PC
- PSF - files used by PS
- PPSF - files used by PPS

## List of files
|type   |name           |parameters                      |auth |desc                                 |
|-------|---------------|--------------------------------|-----|-------------------------------------|
|PPSF   |admin          |server=pass                     |     |check if caller is the server        |
|PPSF   |log            |                                |     |save info in log                     |
|PPSF   |login          |user=login, pass=pass           |     |check if user's login data is correct|
|PPSF   |mysql          |                                |     |functions for database connection    |
|PPSF   |data           |                                |     |settings for database connection     |
|PSF    |log            |log=msg                         |admin|save info in log                     |
|PSF    |pop            |                                |admin|pop event from event queue           |
|PSF    |reply          |text=text, user=user            |admin|reply to client                      |
|PSF    |varread        |name=var, user=user             |admin|read var                             |
|PSF    |varwrite       |name=var, user=user, value=value|admin|set var                              |
|PCF    |push           |event=element                   |login|push event to event queue            |
|PCF    |refresh        |                                |login|refresh data from server             |
|PCF    |register       |user=login, pass=pass           |     |register new user                    |
|PSF/PCF|pseudophpserver|                                |     |get version of pseudophpserver       |

## Replies
To use some file you must do GET request for this file with parameters. Then in the response to this request, you get a reply.
Reply starts with char, which defines a type.

| type     | char |
|----------|------|
| good     | `0`  |
| error    | `-`  |
| DB-error | `+`  |

Good type specifies the success of the request.
DB-error type specifies a database error. Request of this type provides in parameters code of error and its description, what is an output of mysqli. You can get more info [here](http://php.net/manual/en/mysqli.connect-errno.php) and [here](http://php.net/manual/en/mysqli.errno.php).
Error type specifies a PPS error. Request of this type provides in parameters code of error and/or its description. There're error codes in the table below.

| code | description                          |
|------|--------------------------------------|
| 1    | Not enough parameters in the request |
| 2    | User privileges denied               |
| 3    | Admin privileges denied              |
| 4    | Log file problem                     |
| 5    | No elements in the queue             |
| 6    | A user with the same login exists    |

There can be a parameter after first char of reply. Ending of this parameter can be spotted by end of reply or separator char. Separator char is a `\xB2` char which is a byte with 0xB2 or 178 value. After separator char, there can be next parameter.
