DIST_PATH := /var/www/
dist:
	chmod -R 777 *
	cp -R * $(DIST_PATH)
clean:
	rm -fr $(DIST_PATH)
