# totd
Decide who will be...! Ticketflipper of the Day

I created this scipt to select a person daily, based on the lastest dates. If four persons are active, the list should cycle equaly, so every person should get selected. However there is the possability to set a person on inactive.

This script uses a database to store its data, this is tested with 5.5.52-MariaDB, for Linux (x86_64). To create the database use the following command:

```sh
mysql -u <user> -p < totd.sql
```
