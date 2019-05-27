# Elephant Resort
Luxury Hotel Website - Developed in PHP and hosted on AWS
http://elephantresort.ap-southeast-2.elasticbeanstalk.com 

## Dependencies
1. **L**inux or Windows Subsystem Linux (WSL)
2. **A**pache2 Server   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> https://httpd.apache.org/download.cgi
3. **M**ariaDB/MySQL           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> https://mariadb.org/download/
4. **P**hp (v5+)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> https://www.php.net/downloads

## Setup

### Install dependencies
1. _Install Ubuntu (WSL/Windows 10 only)_ :
   * If WSL (Windows Subsystem Linux) feature is not already enabled on your computer:
     * Open PowerShell as Administrator and run
        ```powershell
        Enable-WindowsOptionalFeature -Online -FeatureName Microsoft-Windows-Subsystem-Linux
        ```
     * Restart your computer when prompted.
   * Download and install Ubuntu (WSL)  from the windows store
   * Launch Ubuntu and complete initial startup steps

2. _Install Apache2_
   * Add the following PPA to get latest version of Apache. In Ubuntu/WSL Bash run: 
  `sudo add-apt-repository ppa:ondrej/apache2`
   * Update local package index; `sudo apt-get update`
   * Install Apache; `sudo apt-get install apache2`

3. _Install MariaDB/MySQL_
   * Add repo with the latest MariaDB packages
        ```bash
        sudo apt-get install software-properties-common
        sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xF1656F24C74CD1D8
        sudo add-apt-repository 'deb [arch=amd64,i386,ppc64el] http://ams2.mirrors.digitalocean.com/mariadb/repo/10.2/ubuntu xenial main'
       ```
   * Install MariaDB
        ```bash
        sudo apt-get update
        sudo apt-get install mariadb-server
        ```
   * Start MariaDB:`sudo service mysql start`
   * Run the following and follow prompts: `mysql_secure_installation`
  
4. _Install PHP_
   * Add PPA to get the latest version of php:
        ```bash
        sudo add-apt-repository ppa:ondrej/php
        sudo apt-get update
        ```
   * Install PHP 7.1 packages:
        ```bash
        sudo apt-get install php7.1 libapache2-mod-php7.1 php7.1-mcrypt php7.1-mysql php7.1-mbstring php7.1-gettext php7.1-xml php7.1-json php7.1-curl php7.1-zip
        ```
### Clone & Run
1. Configure Apache (WSL/Windows 10 only)
   * Edit Apache default virtual host configuration file: 
       ```bash 
       sudo nano /etc/apache2/sites-enabled/000-default.conf
       ```
   * Ensure _ServerName_ is set to _localhost_: `ServerName localhost` then `Ctrl+o` `Enter` `Ctrl+x` to save and exit
   * Enable Apache modules that are necessary and restart/start server:
        ```bash
        sudo a2enmod rewrite
        sudo service apache2 restart
        ```
2. cd into apache default DocumentRoot folder `cd /var/www/html`
3. Clone repo: `git clone https://github.com/lenzoburger/ElephantResort.git`
4. Launch browser and Navigate to url: `http://localhost/ElephantResort`
5. Launch preferred IDE/Editor in folder `/var/www/html/ElephantResort` to edit project

## Tools
1. phpMyAdmin            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> https://www.phpmyadmin.net/downloads/
2. Composer              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> https://getcomposer.org/download/
3. Git                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> https://git-scm.com/downloads
4. VSCode + _Extensions_ &nbsp;-> https://code.visualstudio.com/download
   * _PHP Intellisense - Crane (Hvy Industries)_
   * _Auto Rename Tag (Jun Han)_
   * _Debugger for chrome (Microsoft)_
   * _Markdown All in One_ (Yu Zhang)
   * _Markdown Preview Enhanced (Yiyi Wang)_
   * _Meterial Icon Theme (Philipp Kief)_
   * _Path Intellisense (Christian Kohler)_
   * _Prettier - Code Formatter (Esben Peterson)_
