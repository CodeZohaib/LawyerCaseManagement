# LawyerCaseManagement

**lawyer Case Management System** : This project is all about helping schools and learning centers run better. It's like a special tool that makes it easy to handle things like classes, teachers, students, and money. With this project, I'm showing how I can create a system that makes schools and learning places work more smoothly. This project was developed for my client, **Ubaid Ullah Khattak**, who is a final year project (FYP) student. They have given me permission to include it in my portfolio and upload it on GitHub.<br><br>

**Features**<br>

**Get Your Account** :Lawyers can make their accounts by giving their name, contact info, email, and a strong password.<br><br>
**Log In Easily** :Lawyers can easily get into the system by using their email and password.<br><br>
**Keep Clients in Check** :Lawyers can keep an eye on clients' info, like names, contact details, and if their cases are open or closed.<br><br>
**Quick Look Dashboard** :There's a place where lawyers can quickly see how many cases and clients they have.<br><br>
**See Case Details** :Lawyers can see all the details about cases, like who the clients are, case numbers, court names, and if cases are done or still going.<br><br>
**Hearing Info** :The system remembers all the times the case was in court, with dates and what the judge said. Lawyers can look at this and print it too.<br><br>
**Sort Cases** :Lawyers can put cases into different types, like Civil, Family, or Criminal, to make things easy to find.<br><br>
**Pick Courts** :Lawyers can add, change, or remove court names, like Supreme Court or Sindh High Court, based on where they work.<br><br>
**Easy Buttons** :The system looks nice and is easy to use, so lawyers can find what they need without any fuss.<br><br>
**Change Data** :Lawyers can add new stuff, update things, or delete things like cases and client info.<br><br>
**Handle Cases Well** :With this system, lawyers can manage cases well and do a great job for their clients.<br><br>
**Project Languages Used** :HTML, CSS, Bootstrap, jQuery, PHP, MySQLi PDO, AJAX<br><br>
**Role** :I was the only person working on this<br>
This special project was made for **Ubaid Ullah Khattak**. It shows how good we are at making software that helps lawyers work better. The Lawyer Case Management System is like a friend for lawyers, making their job smoother and helping them take care of clients and cases in a super way.<br><br>

**Setting Up Your Project**

Before proceeding, ensure that both the project name is set to "case_management" and the database name is set to "case_management_system." Using any other names may result in issues when working in your localhost environment. If you wish to change the project name, follow these steps:

1. Open the "include" folder.
2. Inside the "include" folder, locate the "function.php" file.
3. In the "function.php" file, go to line number 6 and find the line: `define("BASEURL","http://localhost/case_management");`
4. Replace "case_management" with your desired project name.

Next, update the JavaScript file as follows:

1. Open the "files" folder.
2. Inside the "files" folder, navigate to the "js" folder.
3. In the "js" folder, locate the "mycustom.js" file.
4. Open the "mycustom.js" file.
5. Change the following line (line number may vary) to match your project name: 
   ```
   var pageUrl = window.location.origin + '/case_management';
   ```

Finally, update the database name:

1. Open the "include" folder.
2. Inside the "include" folder, locate the "function.php" file.
3. In the "function.php" file, find the connection function where the database name is assigned.
4. Update the database name to your new database name.

By following these steps, you can set up your project with the desired project name and ensure that the database name is correctly configured.<br><br><br>
**Project Screenshot**<br><br>

![1](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/344f8878-5427-43d4-adf0-433d02cb89ed)
**Home Page**<br><br>


![3](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/d657595a-42de-45e8-a53e-d935b4ab2266)
**Registration Page** : Lawyers can create an account by providing their name, mobile number, email, password, and profile image.<br><br>

![2](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/3f5567bf-fb3d-43b0-b25d-afa61338cc2c)
**Login Page** :Lawyers can log in using their email and password<br><br>

![4](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/86568aeb-46fd-4896-8830-843a0ac7da26)
**Dashboard Page** : On the dashboard, lawyers can view the total number of cases and clients. By clicking on total Cases, they can access a comprehensive list of all cases, and similarly, by selecting total Clients, they can access a complete list of all clients.<br><br>

![5](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/b3a55e62-1cdd-413e-a15b-d302c12a01d4)
**Client Page** :Shows client details - name, father's name, CNIC, mobile, address, status. Status: 1 = active (your ongoing case), 2 = inactive (case closed, transferred). Includes options to add, edit, and remove entries.<br><br>

![6](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/88d5496d-9016-4681-b758-297867678f6b)
**Cases Page** : Displays case info - client name, representation, Case No, Case Type, Court name, Section, Case Date, Status. Status: 1 = ongoing, 2 = closed. Details to view case and Hearing info, with printing. Add New Hearing to include date and judge's remarks. Includes options to insert, update, and delete cases<br><br>

![7](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/d097eccc-6b27-4a72-8b57-22f0411e12df)
**Details Button** :When you click the Details button, you'll see all the case info like the client's name, case number, and their ID number. You'll also find a list of all the hearings with dates and what the judge said. If you want, you can use the Print button to get a printed version of all the hearing details<br><br>

![8](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/e2193517-2f8b-4e7e-bc3f-f3eed46dbf26)
**Cases Type Page** :On this page, you can add different types of cases that you handle as a lawyer, such as Civil, Family, and Criminal cases. You have the option to insert new case types, update existing ones, and also delete case types as needed.<br><br>

![9](https://github.com/CodeZohaib/LawyerCaseManagement/assets/142882799/9f2f7b7a-6621-4056-9b56-8f9cc3aadedc)
**Court Type Page** :Here, you can manage the various court names based on the areas where you handle cases. This includes courts like the Supreme Court, Sindh High Court, and Lahore High Court. You have the capability to add new court names, update existing ones, and remove court names as necessary<br><br>



