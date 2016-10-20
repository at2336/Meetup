What each URL does: 
index displays the homepage with various links to features. A user can signup, login, or logout.
Login allows a user to enter the system if he or she already has an account.
Register allows a user to join the system by creating an account that can be used to access the features and the system.
Find events is open to everyone and allows a user to select 2 dates that a user wants to find all events occuring between.
Create event allows a user to create an event. 
Create group allows a user to create a group.
View Group allows a user to view all the groups he or she is part of.
Upcoming events allows a user to see all events occuring within the next 3 days that he has RSVP'd to.
Find Group allows a user to find a group based on interest.
RSVP allows a user to state that he or she would like to attend an event.
Create interest allows a user to add an interest to the database.
The Search bars allow a user to search for events or groups based on ID or name.

List of files:

attend.php is responsible for letting a user RSVP for an event
rsvp.php is responsible for the backend of attend, selecting and inserting into the database

create_event.php is responsible for letting the user input information about an event to be created
update_event.php is the backend of create_event.php that actually creates the event in the database

create_group.php is used to let the user create a group. It is responsible for both the interface and backend.
	The username is automatically pulled from who is signed in and the group ID is automatically generated.

create_interest.php allows a user to create an interest. Create_interest is responsible for both the interface
	and backend. 
	
forgot-password.php is the interface for a user to verify his or her account and to reset a password.
create_new_password is the back end of forgot-password to change the old password to a desired one. 

find_event allows a user to search for an event based on date range. It does both the interface and
	backend. The user can select a desire date range and all events occuring within that range will be displayed.
	
index.php is the main interface a user will see. It has all the links other features. It is what a user will be shown
	once logged in. On failure to do an action, a user will be redirected back here.
indexNotLogged.php is the same as index, but it is shown when a user is not logged in. The other features a user can
	perform are finding events and 

interest_group.php is responsible for being the interface to allow a user to search for a group based on interests.
	A user can search by interests he has already or by an interest he isn't part of.
Search_group_interests.php is the backend responsible for finding groups related to that interest.

Login.php is responsible for letting a user sign into the system to access features only registered users can perform.
	It is both the interface and backend.
	
logout.php is displayed and performed when a user logs out.

Signup.html is the interface for a user to register. A user inputs the information here.
register.php is responsible for adding a user to the system, assuming the username is not taken.

RSVP allows a user to search for an event and RSVP to attend.

search_events is used to search for events based on ID or name

upcoming_events.php shows the user all the events he or she is rsvp'd to and lists all events occuring within the current 
	date and for the next 3 dates.
	
view_group.php is responsible for showing the user all the groups he or she is part of

Additional features: 
Create Group - A user can add a group to the system.
Create interest - A user can add an interest to the system.
Forgot password - A user can change his or her password by verifying with some information. The user will be asked for a new password.
View Group - A user can view all the groups he or she is part of.
Search for Groups - A user can search for groups using the ID or name of the group.
Search for events - A user can search for events using the ID or name of the event.