# PseudoPHPServer
Software for sending, identifying, authorizing data sending between PC (PseudoClient) and PS (PseudoServer).
We split PPS files into 3 groups:
- PCFiles - files used by PC
- PSFiles - files used by PS
- PPSFiles - files used by PPS

| type | name     | parameters                       | auth  | desc                                    |
| ---- | -------- | -------------------------------- | ----- | --------------------------------------- |
| PPSF | admin    | server=pass                      |       | check if caller is the server           |
| PPSF | log      |                                  |       | save info in log                        |
| PPSF | login    | user=login, pass=pass            |       | check if user's login data is correct   |
| PPSF | mysql    |                                  |       | settings for database server connection |
| PSF  | log      | log=msg                          | admin | save info in log                        |
| PSF  | pop      |                                  | admin | pop event from event queue              |
| PSF  | reply    | text=text, user=user             | admin | reply to client                         |
| PSF  | varread  | name=var, user=user              | admin | read var                                |
| PSF  | varwrite | name=var, user=user, value=value | admin | set var                                 |
| PCF  | push     | event=element                    | login | push event to event queue               |
| PCF  | refresh  |                                  | login | refresh data from server                |
| PCF  | register | user=login, pass=pass            |       | register new user                       |
