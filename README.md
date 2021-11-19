**Expected Outcome:**
  A simple dating web app with both Laravel and Bootstrap using the Latest version.

**Feature List:**
1. Registration with Name, Email, Password, Location (PC/Browser geolocation -
latitude, longitude), Date of Birth and Gender
2. Upload single profile photo
3. Login panel with email and password
4. See other user lists (in a table or any other simplified view) around 5 KM (Using
geolocation distance driven query) and show it in the Map with basic information.
5. Show user Name, image, distance, gender and age in user list
6. A like and dislike button for each user. Keep like and dislike mapping in the database.
7. Mutual like indication - Show a popup with a message (It's a Match!) if the user likes one person
and the liked person previously likes him. (Use Case: Consider two users - ‘A’ and ‘B’. User ‘A’
logged in and likes ‘B’s profile. Once ‘B’ logged in and likes ‘A’s profile - a simple popup will
be invoked with the message.)
8. Integrate a real time chat between A and B profile users.

**API Implementation:**
1. Make an Authentication API for this application
2. Create Login and Registration Responses, remind that you have to make an email based otp
verification at every time of login.
3. If Authentication is successful return a list of mutual users of the dating application
