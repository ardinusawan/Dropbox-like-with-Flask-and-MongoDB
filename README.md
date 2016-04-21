To install the requirements simply run the following command (you need pip to be installed on your system):
sudo pip install -r requirements.txt

Moreover, you need mongoDB to be installed and running.

I included a script (populateDB.py) that you can use to setup the DB with the user and password you want to test.

Last, but not least: generally config.py file should not be shared because contains sensitive information, but in this case it's needed to make all work and it's not containing so much ;)

If you have any improvement or suggestion, please let me know!
