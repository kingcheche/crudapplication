# CRUD APPLICATION
This is a simple CRUD application I am calling Courserep, it is a
Zuritask that is meant to be able to perform basic CRUD operations. Users
create and manage course. 

# Zuritask 
Goals for the task: Achieved ⚡
1. Connect to MYSQL database to save and process data input
2. Registers new users, does basic authentication to make sure users input the correct details.
3. Logs in in existing user
4. Logs out user
5. Reset password
6. CREATE new course
7. READ existing course
8. UPDATE existing course
9. DELETE existing course

# Behind the scene process👏
These are what I was able to achieve/learn in the course doing this. 
1. Error handling, this is to ensure that from login to course creation and management, any error is not sent, and user get notified of what was wrong and how to go about it.
2. Sending data to the database with prepared statement, a safe practice to ensure proper data is sent to the database.
3. Restricting user from accessing some pages through back doors  and also making sure only logged in user can access the dashboard and other pages that are used for CRUD operations.
4. Users can only edit the course they created

This was a Lovely learning and long process, I will try and make it live as soon as I can. 
