#!/bin/sh
MUSER="crm_dev"
MPASS="crm_dev"
MHOST="localhost"
MYSQL="/usr/local/zend/mysql/bin/mysql"


qry="select work_order_id,work_order_tracking_number from work_order where work_order_tracking_number and work_order_ship_status is null"

DBS="$($MYSQL -u$MUSER -p$MPASS -bse  'use crm_dev;select work_order_id from work_order where work_order_tracking_number and work_order_ship_status is null')"

for db in ${DBS[@]}
do
	#echo "http://crm.rapidmedicalresponse.com/auto/fedextracking/$db"
	curl http://crm.rapidmedicalresponse.com/auto/fedextracking/$db

done
