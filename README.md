# Duplicati Monitor
A web application that provides a visual representation of backup reports collected from different computers. It uses PHP to handle and process the reports sent by the Duplicati backup software.

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

## Features

- Lists all backup reports in a tabulated format.
- Displays the percentage of backups made in the last 24 hours and 7 days, using a circular progress bar (wheel of cheese).
- Provides detailed information on computers that did not make backups in a specified time frame, via modal windows.

- Highlights backup reports based on their date:
| Color             | Meaning                                                                |
| ----------------- | ------------------------------------------------------------------ |
| Red | backups older than 7 days. |
| Orange | backups made between 24 hours and 7 days ago |
| Green | backups made in the last 24 hours|




## Requirements
- PHP server (with mysqli extension enabled)
- MySQL database
- Setup
- Clone the Repository:
## Screenshots

![App Screenshot](https://via.placeholder.com/468x300?text=App+Screenshot+Here)


## Authors and License

- [@MaxenceA4](https://www.github.com/MaxenceA4)
- [MIT](https://choosealicense.com/licenses/mit/)
## Setup

1. **Clone the Repository:**
   ```sh
   git clone https://github.com/MaxenceA4/Duplicati_Monitor
   cd project-repo
   ```
   
2. **Database Configuration:**
   - Create a MySQL database and import the `database_schema.sql` file to set up the necessary tables.
   - Modify the `LoginConnection/connection.php` file with your database credentials (username, password, database name, etc.).

3. **Place the Files:**
   - Place the entire contents of the `project-repo` directory into the root of your web server or in a subdirectory.

4. **Configure Duplicati:**
   - For each computer you are monitoring, configure Duplicati to send its backup reports to `http://yourserver/path_to_project/receive.php?nameOfComputer=computer_name`.

5. **Run the Application:**
   - Open a web browser and navigate to `http://yourserver/path_to_project/index.php` to view the backup reports.

## Notes
The wheel of cheese circular progress bars are controlled by the percentage of backups found in the last 24 hours and 7 days. This percentage is calculated based on the total number of backup reports found. <br>
You can modify the time intervals for the backup reports by changing the SQL queries in the index.php file.
