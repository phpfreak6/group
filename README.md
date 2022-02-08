Important Things - 

1. Please create a user in users table before testing the apis as I have not implemented
JWT Auth or some other package for authentication and using static authentication id for now (Mentioned in controller constructors).

2. API responses are based on a parameter returned as TRUE and FALSE. We can also implement a class for sending different response codes according
to the errors or events occurence.

3. Migrations are done without foreign key bindings which is used for cascading data in case of deletion from different tables and foreign key 
indexing.

4. Postman API Collection is placed in root directory of the project. 
   Kindly replace the BASE URL according to your local environment.
   I use laragon for local development.
   