How to use

1. Run requirement installation
   sudo pip install -r requirements.txt
2. You need mongoDB to be installed and running.
3. Create database on mongo
   a. In terminal, use command 'mongo'
   b. If u see '>', ure ready to query data
   c. First, show all db with command 'show dbs'
   d. Create your database with command 'use [ur_database_name]'
      Ex : use test
   e. Your database is ready to use
4. I included a script (populateDB.py) that you can use to setup the DB with the user and password you want to test.
5. Last, but not least: generally config.py file should not be shared because contains sensitive information, but in this case it's needed to make all work and it's not containing so much ;)
   Ex :
   At populateDB.py, collection = MongoClient()["blog"]["users"]
   And at config.py, DB_NAME = 'blog'

4. Run
   a. First, run 'populateDB.py' to create your user
   b. Second, run 'run-dev.py' to run login flask

If you have any improvement or suggestion, please let me know!
