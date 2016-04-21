How to use flask-login
Moreover, you need mongoDB to be installed and running.

I included a script (populateDB.py) that you can use to setup the DB with the user and password you want to test.

Last, but not least: generally config.py file should not be shared because contains sensitive information, but in this case it's needed to make all work and it's not containing so much ;)

If you have any improvement or suggestion, please let me know!

------
How to use flask-server

1. Run requirement installation
   sudo pip install -r requirements.txt
2. Create database on mongo
   a. In terminal, use command 'mongo'
   b. If u see '>', ure ready to query data
   c. First, show all db with command 'show dbs'
   d. Create your database with command 'use [ur_database_name]'
      Ex : use test
   e. Your database is ready to use
3. Run flask_gridfs_server.py
4. Access with localhost:port