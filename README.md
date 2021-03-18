# Bicycle Manufacturing ERP System [SOEN-390] (Team 5)

## Objective
Create an ERP system for a bicycle manufacturing company. 

## Description
An ERP (Enterprise Resource Planning) system is a piece of software meant to help 
streamline a company's business processes. From retrieving inventory to gathering financial
reports, the ERP system is an all-in-one software to view the status of the company from
many different level. Such features included in the ERP system are:

- Planning
- Scheduling
- Vendors
- Production
- Quality Management
- Packaging
- Transport Planning/Shipping
- Sales
- Accounting


## Authors
- Celia Cai (ID: 40098535) (Github Username: CeliaCaii)
- Kelvin Chow Wan Chuen (ID: 40029677) (Github Username: WanProduction)
- Daniel Gauvin (ID: 40061905) (Github Username: DGovi)
- Michael Lee (ID: 40054375) (Github Username: mlee97)
- Armando Mancino (ID:40078466) (Github Username: mandocino)
- Muhammad Shah Newaz (ID: 25067022)(GitHub Username: abirshah)
- Pasha Pishdad (ID: 40042599) (Github Username: pashapishdad)
- Piravien Suntharalingam (ID:40035136) (Github Username: pirasunt)
- Julien Xu (ID: 40095332) (Github Username: xujulien99)


## Changelog
### [3.0](https://github.com/mlee97/SOEN-390-Team5/tree/v3.0) - 2021-03-17
### Added
- Defects tracking report
- Release Plan (Sprint #4 planning)
- UI modeling of Sprint #4 user stories
- Updated deliverables: SAD, USB, RMP, Testing Plan

### [2.0](https://github.com/mlee97/SOEN-390-Team5/tree/v2.0) - 2021-02-24
### Added
- Defects tracking report
- Release Plan (Sprint #3 planning)
- UI modeling of Sprint #3 user stories
- Updated deliverables: SAD, USB, RMP, Testing Plan

### [1.0](https://github.com/mlee97/SOEN-390-Team5/tree/v1.0) - 2021-02-03
### Added
- User Stories Backlog (USB)
- Release Plan (Sprint #2 planning)
- Software Architecture Document (SAD)
- Risk Assessment & Risk Management Plan (RMP)
- UI prototypes for Sprint #2 user stories
- Testing Plan
- Running prototype


## Technologies
Project is created using the following:
- [Laravel version: 8.16.1](https://laravel.com/)
  <dd>Laravel is a free, open_source  PHP web framework for developping web applications following a MVC (model-view-controller) architectural pattern. Laravel will make it           simple for us to access/create our relational databases and make deployement easier.</dd>
- [Docker version: 20.10.5](https://www.docker.com/)
  <dd>Docker is a set of platform as a service products that use OS-level virtualization to deliver siftware in packages called containers. These containers run all and only the       required applications which simplifies and accelerates our workflow.</dd>
- [Ubuntu version: 20.10](https://ubuntu.com/)
  <dd>Ubuntu is an open-source software Linux operating system.</dd>
- [Xdebug Code Coverage version 3.0.3](https://xdebug.org/)
  <dd>Xdebug is a PHP extension which provides debugging and profiling capabilities.</dd>
- [GitHub](https://github.com/)
  <dd>Github is a free service that allows open-source projects or unlimited private repositories.</dd>
- [Discord version: 74432](https://discord.com/)
  <dd>Discord is a VoIP, instant messaging and digital distribution platform designed for creating communities.</dd>


## Architecture
The software will implement a model-view-controller (MVC) architectural pattern for a faster development process.


## Install
1. Install [Laravel framework](https://laravel.com/docs/8.x/installation#getting-started-on-windows) using the following guideline.
2. Install [Ubuntu Groovy](https://releases.ubuntu.com/20.10/).
3. Install [Docker Engine on Ubuntu](https://docs.docker.com/engine/install/ubuntu/) using the following guide.
4. Install [Xdebug](https://xdebug.org/docs/install).
   
   
## Steps for generating code coverage
1. open CLI in docker and type "pecl install xdebug".
2. if xdebug appears when you run "php -v" in the CLI then skip to step 8.
3. After you install xdebug, theres a message at the end that say "you should add 'extension' to php.ini". Save that extension somewhere (for me the extension was    "zend_extension=/usr/lib/php/20200930/xdebug.so:").
4. Find your php.ini file. (its in \wsl$ -> docker-desktop-data then type "php.ini" in search).
5. Open you php.ini and add your extension from step 3 (for me it was "zend_extension=/usr/lib/php/20200930/xdebug.so:") and "xdebug.mode=coverage" under ";zend_extension=opcache". Save the file.
6. Restart the erp_laravel.test_1 port in docker.
7. Type "php -v" in the CLI. If xdebug appears then youre good to go.
8. To generate code coverage. Type "./vendor/bin/phpunit --coverage-html reports/" in the CLI. The report should be in the project in the reports folder.

![1](https://user-images.githubusercontent.com/48234317/111553020-e6443180-8759-11eb-9ada-1a6efe1ee7b6.PNG)
![2](https://user-images.githubusercontent.com/48234317/111553024-e8a68b80-8759-11eb-8c54-02f27dd0b83b.PNG)
![3](https://user-images.githubusercontent.com/48234317/111553030-ea704f00-8759-11eb-8ec6-abb810a1eab5.PNG)

