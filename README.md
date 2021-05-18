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

# Updates
1. Users have to view the course first before they edit or delete course
2. Edit and delete button only show for users that created the course, if that condition is not met, it will be on read only
3. Users could access the edit and delete page of courses they didn't create by just change the course ID number on their own edit/delete page to a different one, so new sets of code was written to ensure that if users tried to do this it will redirect them to just read.php page of the course.
4. If users did the same thing as above and change the ID to course that didn't exist the page loaded but gave errors where variables were unset, so I added code to make redirect users to the homepage if they tried to access a curse that didn't exist.
5. The interface was change from a list view to a grid view, for better aesthetics and space usage, I still have some issues with skipping grid anyway.
6. Show/Hide password with JS on the Login, Signup and Reset password form input


This was a Lovely learning and long process, I will try and make it live as soon as I can. 

Update (Live website deployed with Heroku.com, Database - Remotefreemysql.com) - https://courserep-crud.herokuapp.com/
