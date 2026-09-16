#!/bin/bash
find /var/www/html/uploads -type f -mmin +60 -delete 2>/dev/null
exit 0
