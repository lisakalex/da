#0 7 * * * /var/www/hyip.com/public_sh/get_hyip_seeds.py
#* * * * * /var/www/hyip.com/public_sh/seed1.sh
#* * * * * /var/www/hyip.com/public_sh/monitor.sh
#* * * * * /var/www/hyip.com/public_sh/hyip.sh
#* * * * * /var/www/hyip.com/public_sh/hyip1.sh
#* * * * * /var/www/hyip.com/public_sh/rate.sh
#0 19 * * * /usr/bin/php8.1 /var/www/hyip.com/public_sh/copyall.php
#* * * * * /usr/bin/php8.1 /var/www/hyip.com/public_pay_cron.php
#* * * * * /bin/bash -l -c 'date > ~/cron-test.txt'
#* * * * * /var/www/hyip.com/public_sh/get_top.py
#0 7 * * * cd /var/www/da.com/a/ && wget -i ./download.txt
#0 7 * * * cd /var/www/da.com/ && ./downloadfiles.py
#0 19 * * * cd /var/www/ && ./editallfiles.py
#* * * * * cd /var/www/test/click-iframe/ && ./tor.py
#*/3 * * * * cd /var/www/ && ./tor.py
* * * * * cd /var/www/ && ./tor.py
* * * * * cd /var/www/ && ./tor1.py
* * * * * cd /var/www/ && ./tor2.py
* * * * * cd /var/www/ && ./tor3.py
* * * * * cd /var/www/ && ./tor4.py
* * * * * cd /var/www/ && ./tor5.py
