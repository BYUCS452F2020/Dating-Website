### Database Schema
* Users(<ins>user_id</ins>, date_of_birth, email, phone, password, gender)
  * This table contains information about users that will not be displayed to users


* Profile(<ins>user_id</ins>, bio, first_name, last_name, height, major, work, hometown)
  * This table contains information that other users will be able to see on a user's profile page
  * Foreign key user_id references Users


* Image(<ins>image_id</ins>, user_id, image_path)
  * This table contains the file path to images that are displayed on a user's profile page
  * Foreign key user_id references Users

* Liked(<ins>liked_id</ins>, person1, person2, matched)
  * This table contains information about who has reacted to another user's profile
  * person1 is the person who said yes to person2’s profile
  * matched is a Boolean (0 is person2 says no to person1, 1 is person2 says yes to person1, and NULL means person2 hasn’t decided on person1 yet)
