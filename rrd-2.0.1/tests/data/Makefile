# Makefile for creating data for test
#
# usage from main extension directory for creating fresh data
# make -C tests/data clean
# make -C tests/data all
#
rrd_binary = /usr/local/bin/rrdtool

all: speed.png rrd_updater_fetch.txt speed-dump.xml moreDS-empty.rrd moreDS_fetch.txt
	@echo 'You can run "make test"'

clean:
	rm -f *.rrd *.png *.xml *fetch.txt

speed-empty.rrd:
	$(rrd_binary) create speed-empty.rrd --start 920804400 \
		DS:speed:COUNTER:600:U:U \
		RRA:AVERAGE:0.5:1:24 \
		RRA:AVERAGE:0.5:6:10

speed.rrd: speed-empty.rrd
	cp speed-empty.rrd speed.rrd
	$(rrd_binary) update speed.rrd \
		920804700:12345 920805000:12357 920805300:12363 \
		920805600:12363 920805900:12363 920806200:12373 \
		920806500:12383 920806800:12393 920807100:12399 \
		920807400:12405 920807700:12411 920808000:12415 \
		920808300:12420 920808600:12422 920808900:12423

speed.png: speed.rrd
	$(rrd_binary) graph speed.png \
		--start 920804400 --end 920808000 \
		--vertical-label m/s \
		DEF:myspeed=speed.rrd:speed:AVERAGE \
		CDEF:realspeed=myspeed,1000,* \
		LINE2:realspeed#FF0000

rrd_updater_fetch.txt: speed.rrd
	$(rrd_binary) fetch speed.rrd AVERAGE \
		--start 920804400 --end 920809200 >rrd_updater_fetch.txt

speed-dump.xml: speed.rrd
	$(rrd_binary) dump speed.rrd >speed-dump.xml

moreDS-empty.rrd:
	$(rrd_binary) create moreDS-empty.rrd --start 920804400 \
		DS:speed1:COUNTER:600:U:U \
		DS:speed2:COUNTER:600:U:U \
		RRA:AVERAGE:0.5:1:24 \
		RRA:AVERAGE:0.5:6:10
	cp moreDS-empty.rrd moreDS-updater.rrd
	$(rrd_binary) update moreDS-updater.rrd \
		920804700:12345:11340 920805000:12357:11357 920805300:12363:11363
	$(rrd_binary) fetch moreDS-updater.rrd AVERAGE \
		--start 920804400 --end 920808000 >moreDS_updater_fetch.txt
	rm moreDS-updater.rrd

moreDS.rrd:
	$(rrd_binary) create moreDS.rrd --start 920804400 \
		DS:speed1:COUNTER:600:U:U \
		DS:speed2:COUNTER:600:U:U \
		RRA:AVERAGE:0.5:1:24 \
		RRA:AVERAGE:0.5:6:10
	$(rrd_binary) update moreDS.rrd \
		920804700:12345:11340 920805000:12357:11357 920805300:12363:11363 \
		920805600:12363:11364 920805900:12363:11364 920806200:12373:11373 \
		920806500:12383:11373 920806800:12393:11393 920807100:12399:11399 \
		920807400:12405:11405 920807700:12411:11411 920808000:12415:11415 \
		920808300:12420:11420 920808600:12422:11422 920808900:12423:11423

moreDS_fetch.txt: moreDS.rrd
	$(rrd_binary) fetch moreDS.rrd AVERAGE \
		--start 920804400 --end 920808000 >moreDS_fetch.txt
