
# InFund  

InFund is a crowdfunding solution that takes the ease and intuitiveness of raising funds to a whole new level. We (the creators of InFund) are university students and we have seen firsthand how gruesome and tiring putting money together for various payments can be. It was created to facilitate funding and billing in higher institutions of learning.  

InFund allows students of an institution to set up campaigns for various educational purposes. Campaigns are used by students for fundraising. InFund also provides a way for lecturers to set up bills for students. Some examples of campaigns are fundraisers to purchase student handouts, textbooks, or even a much-needed utility like a projector or PA system. Bills could be fees set by the institution or by a lecturer for specific faculties, departments, colleges, or levels.  

InFund provides means for users to share their campaigns on various social media and messaging platforms to spread their awareness.  

InFund also provides user and administrative dashboards for students and institution officials. User dashboards allow students to create, view, and donate to campaigns. The institution officials' dashboard allows lecturers and other administrative staff to put up new bills for students and vet any new campaigns. The Payaza API was integrated into our solution to facilitate transfers for crowdfunding and billing.  

Our solution also makes use of powerful LLMs for campaign classification and general user-friendliness.  

InFund comes with support for major institutions across the country and their various faculties, departments, or colleges. New institutions can easily join and add their faculties to the institution list.  

---

## Screenshots  



---

## Getting Started  

### Setup Instructions  

1. **Clone the Repository:**  
   ```bash  
   git clone https://github.com/baqx/infund  
   cd infund  
   ```  

2. **Database Configuration:**  
   - Import the `infund.sql` file located in the `config/` directory into your database.  
   - Edit `config/config.php` with your database connection details.  

3. **Secrets Configuration:**  
   - Create a new file named `secrets.php` in the `config/` folder. The file should contain:  
     ```php  
     <?php  
     //This PHP file contains app secrets  
     $PAYAZA_API_KEY = "";  
     $PAYAZA_API_KEY_ENCODED = "";  
     $APP_EMAIL = "";  
     $APP_EMAIL_PASSWORD = "";  
     ?>  
     ```  

4. **Dependencies:**  
   The project includes libraries like:  
   - **Payaza API** for payment gateway.
   - **PhpSpreadsheet** for Excel processing.  
   - **FPDF** for PDF generation.  
   - **PHPMailer** for email notifications.  

5. **Assets Directory:**  
   - CSS files: `assets/css/`  
   - JavaScript files: `assets/js/`  
   - Images: `assets/images/`  

---

## Demo and Live Site  

- **Video Demo:** [View Demo](#)  
- **Live Site:** [Visit InFund](#)  

---

## Contributors  

- [Kunle-Ajayi Oluwasetemi](https://github.com/johnojure)  
- [Adegbola Abdulbaqee](https://github.com/baqx)  

---
