A basic event management application made by using PHP, MySQL.
Purpose: Introduction to web development 

Team:
FNU Gauravdeep Singh - 1001827248
Jeevesh Sehgal - 1001773372

Homepage: https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/inicio.php

Brief Description:
Project is an event management system where an admin can manage events and users can register for events.

Features:
	1. Project is made by using HTML5, CSS, JavaScript, PHP and MySQL.
	2. Responsive design for various devices and resolutions.
	3. HTML5, JavaScript and PHP validations used on all forms.
	4. Functional discussion forum for the communication.
	5. CRUD operations for events along with image upload functionality.
	6. My profile option for customers to edit personal information
	7. Feedback and rating system for reviewing registered events.	

All webpages in the project:
	1. Main Pages:
		i) Inicio (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/inicio.php) :
			It is the homepage of the website consisting of the basic information, registration form and the login form modal.
		   
		ii) Nosotros (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/nosotros.php)
			It consists of the additional information about the company.

		iii) Equipos (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/equipos.php)
			All the info of the team are retrived from the database.

		iv) Blog (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/blog/) : 
			Responsive and dynamic blog using Wordpress.

		v) Contact Us (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/contacto.php) :
			Any user can use the form to enquire about events, lodge complaints or ask queries. 

	2. Customer Pages:
		i) Events (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/dashboard_events.php) :
			1. Customer can view all the events added by the admin/manager. 
			2. After opening an event, the user is able to view the details of events(such as date, location, number of participants etc). 
			3. The user can register for events by adding it to his event's list.
	
		ii) My Profile (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/dashboard_profile.php) :
			1. Customer can view/edit basic profile information( such as Name, Location, Phone no, etc). 
			2. User will be able to add/update his profile picture which can also be seen in event discussions.

		iii) My Events (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/added-events.php) :
			1. Customer can view details of all her/his added events. 
			2. If theres a change in plan, the customer has the feature to delete the events from thier lists.
			3. The user even can provide feedback to the added events.

		iv) My Reviews (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/my-reviews.php) :
			User can view his/her submitted ratings and feedback for all events. 

		v) Discussion Board (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/discussion.php?event_id=1) :
			The discussion forum for the events where the participants can communicate with each other.

	3. Admin Pages:
		When a user logs in using the credentials for an admin, he is redirected to 'All Events' page.
		i) Add/Edit Events (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/admin/create-event.php) :
			1. Admin can create(add), modify, remove and view all events on this page. 
			2. He/She can check the feedback for a specific event.

		ii) Customers (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/admin/all-users.php) :
			Admin can view all registered users on this page.
		
		iii) Contact Us Issues (https://gaurav.uta.cloud/fnu-gauravdeep-singh_ciudad/admin/contact-queries.php) :
			Admin can view all the issues reported by the customers from the Contact Us page (i.e. contacto.php);

SQL Script:
	The project includes the SQL script file named 'gauravut_event_management.sql'
	(The database connection uses credentials for 'localhost' along with a commented lines for uta.cloud)
	NOTE: Change in credentials required for using uta.cloud database

NOTES:
	Customer login: gauravdeep2@gmail.com, Gaurav@123
	Admin login: admin@gmail.com, Admin@123
