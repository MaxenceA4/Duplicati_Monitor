# Duplicati Monitor
A web application that provides a visual representation of backup reports collected from different computers. It uses PHP and a DDB to handle and process the reports sent by the Duplicati backup software.

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/MaxenceA4/Duplicati_Monitor/blob/master/LICENSE)
[![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)](https://developer.mozilla.org/en/docs/Web/JavaScript)
[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/manual/en/intro-whatis.php)

# Table of Contents

1. [🛡 Duplicati Monitor](#duplicati-monitor)
2. [✨ Features](#features)
3. [🛠 Requirements](#requirements)
4. [📸 Screenshots](#screenshots)
5. [👥 Authors and License](#authors-and-license)
6. [🚀 Setup](#setup)
7. [🤝 Contributing](#contributing)
8. [📝 Notes](#notes)

   
## Features

- Lists all backup reports in a tabulated format.
- Displays the percentage of backups made in the last 24 hours and 7 days, using a circular progress bar.
- Provides detailed information on computers that did not make backups in a specified time frame.
- Extra tab that give more detailled informations on all the backup.



## Requirements
- PHP server (with mysqli extension enabled)
- MySQL database
- Setup
- Clone the Repository:
## Screenshots

![Screen of website](Screen.png?raw=true)
![Screen of duplicati settings](image.png?raw=true)


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
   - Create a MySQL database and import the `duplicati_monitoring.sql` file to set up the necessary tables.
   - Modify the `LoginConnection/connection.php` file with your database credentials (username, password, database name, etc.).

3. **Place the Files:**
   - Place the entire contents of the `project-repo` directory into the root of your web server or in a subdirectory.

4. **Configure Duplicati:**
   - For each computer you are monitoring, configure Duplicati to send its backup reports to `http://yourserver/path_to_project/receive.php?nameOfComputer=computer_name`. You can do this by modyfing in Advanced Options the `send-http-url`
   - Modify the `send-http-result-output-format` to `Json`
   - Modify the `send-http-message` to `Duplicati Backup Report\n\nOperation: %OPERATIONNAME%\nResult: %PARSEDRESULT%\nDate: %DATE%\nDetails: %DETAILS%`

5. **Run the Application:**
   - Open a web browser and navigate to `http://yourserver/path_to_project/index.php` to view the backup reports.

## Contributing

We welcome contributions to the Duplicati Monitor project! Whether you are interested in writing code, reporting bugs, or suggesting new features, your help is highly appreciated. Here's how you can contribute:

1. **Fork the Repository:**
   - Fork this repository to your own GitHub account and clone it to your local machine.

2. **Create a New Branch:**
   ```sh
   git checkout -b name-of-your-new-feature-or-bug-fix
   ```
   
3. **Make Your Changes:**
   - Make your changes and improvements to the codebase. Ensure that your code is clean and efficient.

4. **Commit and Push Your Changes:**
   ```sh
   git commit -m "Describe your changes here"
   git push origin name-of-your-new-feature-or-bug-fix
   ```
   
5. **Submit a Pull Request:**
   - Go to the repository on GitHub and create a new pull request for your changes.

6. **Wait for Code Review:**
   - Wait for your changes to be reviewed. Be responsive to feedback and make necessary changes as needed.

Please ensure that your code follows the existing style and structure of the project to maintain consistency.

### Thank you for helping to make Duplicati Monitor better!

## Notes
The wheel of cheese circular progress bars are controlled by the percentage of backups found in the last 24 hours and 7 days. This percentage is calculated based on the total number of backup reports found. <br>
You can modify the time intervals for the backup reports by changing the SQL queries in the index.php file.
