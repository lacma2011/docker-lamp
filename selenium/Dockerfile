# derived from official
# https://github.com/SeleniumHQ/docker-selenium


FROM selenium/node-chrome:3.141.59-europium

#other choices (chrome, firefox, debug or no debug) require other scripts to copy
#FROM selenium/node-chrome-debug:3.141.59-europium
#FROM selenium/node-firefox:3.141.59-europium
#FROM selenium/node-firefox-debug:3.141.59-europium

LABEL authors=SeleniumHQ

USER seluser

#====================================
# Scripts to run Selenium Standalone
#====================================
COPY Standalone/start-selenium-standalone.sh /opt/bin/start-selenium-standalone.sh

#==============================
# Supervisor configuration file
#==============================
#COPY selenium.conf /etc/supervisor/conf.d/


EXPOSE 4444

#needed for "-debug" images only
#EXPOSE 5900


