# Teacher Assistant
This project would provide opportunities for teachers to save they free-time and create different reports as fast as they can.

## Installation
### Aplication repository

    git clone https://github.com/sammmium/TeacherAssistant.git

### Application settings
Go to directory with your application (do not forget to change /path/to/project to your path)

    cd /path/to/project

Change access to some diredtories for application. There would be input root password.

    cd /storage
    sudo chmod 777 -R logs/
    cd /framework
    sudo chmod 777 -R cache/
    sudo chmod 777 -R sessions/
    sudo chmod 777 -R views/

### Migrations
Go to directory with your application

    cd /path/to/project
    php artisan migrate

