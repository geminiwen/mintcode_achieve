DIST_PATH := /var/www
dist:
	chmod -R 755 *
	cp -R * $(DIST_PATH)