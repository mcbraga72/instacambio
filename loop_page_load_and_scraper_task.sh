#!/bin/sh

var=1
while [ $var -eq 1 ]
do
   php page_load_task.php
   php scraper_task.php
done
