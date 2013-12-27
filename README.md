#Angular Music Database

>One-page Web Application built with [AngularJS](http://angularjs.org/),[TypeScript](http://typescriptlang.org),and [Yii framework](http://www.yiiframework.com/).

## Overview
This application demonstrates a one page web application where all the logic has been moved to the frontend.The page loads only once.The backend (Yii) serves JSON data and the frontend consumes it as it renders partial views,which have been baked into the concatenated and minified javascript.To demonstrate Create/Read/Update/Delete features a Music Database is set up with Artists,Albums,and Tracks information.The application features deep linking:when you refresh the page at any location,the application reloads and lands at the same location.Modern frontend  tools like  [Grunt](http://gruntjs.com/) are used to showcase their effectiveness in development workflow.Tests (unit/e2e) are also integrated into this project and ran with [Karma Test Runner](http://karma-runner.github.io/) and [Protractor](https://github.com/angular/protractor).


## [See It Online](http://rest.kabasakalis.tk/music_db/)

## Installation


### Backend
_PHP version 5.4 at least is required.This is a requirement for RestFullYii extension _
- Clone the git repo ```git@github.com:drumaddict/angular-music-db.git``` - or [download it](https://github.com/drumaddict/angular-music-db/archive/master.zip),and copy it to your local server's public folder.Let's assume it's the webroot ```\```.
- Specify your local development domain in index.php,(constant ```LOCAL_DOMAIN```) so that the configuration file can differentiate between local and production environment.For example,you can fill in database info for both environments and the script will figure it out,assuming your virtual host does'nt have the same domain name as your real host.
- Hook up your Yii framework path in ```index.php```,(both local and live on server).
- Fill in database info in ```config/main.php``` and ```config/console.php```.(both local and live on server).
- Import the tables in your database from the sql file,```protected/data/music_db.sql```.Optionally you can import the ```user_table.sql```,but this is related to the Yii application,not the one page application. 
- Verify that the Yii app is installed and responding (navigate to webroot ```\```).

### Frontend

- Change directory to ```\music_db_src```.This is the angular application source folder.
- Install [node.js](http://nodejs.org/)
- Install [Grunt](http://gruntjs.com/) CLI with ```npm install -g grunt-cli ```
- Install [Bower](http://bower.io/) globally  with ```npm install -g bower```.Bower is a package manager that will handle most of the frontend dependencies.
- In ```music_db_src```, run in your command line ```npm install ```.This command will read all the  dependencies needed for  development workflow from the ```package.json``` file.These dependencies will be downloaded in ```node_modules``` folder.
- Once ```npm install``` is finished,run  ```grunt install```.This will install [Protractor](https://github.com/angular/protractor),an end to end (e2e) test framework for AngularJS. 
- Run ```bower install ```.This will read the ```bower.json``` file and download in ```libs``` folder all but four dependencies which are already in that folder:```angular-table```,```angular-ui-router```,```assets```and```toastr ```.```angular-table``` has been slightly modified for the purpose of the application,so downloading the original is not an option.```angular-ui-router``` is a special build of [Angular UI-Router](https://github.com/angular-ui/ui-router) when the version was 0.2.0 and supports keyframe CSS3 animations,which don't work for some reason with later versions.Last,I use a modified version of [Toastr](https://github.com/CodeSeven/toastr) which exports it as window global.
- Open ```music_db_src\libs\spinjs\spin.js ``` and comment (remove) this line at the top of the file
 
 ```else if (typeof define == 'function' && define.amd) define(factory)  ```,

  so that spin exports as a window global.
- This is it.You are ready to start development.

## Development
- Make sure you are always in ```music_db_src```folder
- Open ```js/config/Constants.ts``` and specify the application's base url.For development,
 this is ```APP_BASE_URL = '/music_db_src/'```.Set your domain.For exmple,if you work in a virtual host (recommended) ```rest.dev```,set ```DOMAIN='rest.dev'```.You can change the credentials,but then you will have to change them on the server side also ,(see ```protected/config/restConfig.php```).
- Open ```Gruntfile.js ```,in ```env``` task,set the base URL for both development and production.You'll be OK if you leave the defaults (```music_db_src``` and ```music_db```).If for some reason you need to move the base source folder```music_db_src ``` in a deeper folder,you must include the whole path from the root.
- Open ```App.ts ``` and make sure ```'templates-main'``` module is commented out.Also in ```loader.js``` you should comment out ```views``` in the final require call.This is enabled only for production to bake the partial html files into the javascript.
- Run ```grunt copy:fontsdev``` to copy  fonts from ```libs\bootstrap``` to ```libs\bootswatch``` folder.
- Last,run simply  ```grunt``` (shortcut for ```grunt dev```).This task will compile the ```index.tpl.html``` file into ```index.html``` and also compile all the typescript files into one javascript file,```app.js```.Now point your browser to ```\music_db_src``` and the application should load.
- You can now start developing.If you edit the typescript files they will automatically compile to ```app.js``` every time you save,because of a watcher registered in ```grunt ts``` task._Don't edit the compiled ```index.html``` file_.If you need to edit the index file,you must edit ```index.tpl.html``` and then run 
```grunt compileindex ```,to regenerate the new ```index.html```.
- If you take a look inside ```index.html```,you will notice that there is only one script tag that loads ```loader.js```.[requirejs](http://requirejs.org/) loads all javascript files in the right order based on ```loader.js``` requirejs configuration.

## Tests
[Karma Test Runner](http://karma-runner.github.io/) is used to run the tests.They are written for [Jasmine](http://pivotal.github.io/jasmine/).

### Unit Tests
Unit tests are located in ```test\unit ``` folder.```test\karma-unit.conf.js ``` is the configuration file and you don't need to change anything in it,at least for starters.There is a sample unit test  for Resource.Resource is the class that makes all API calls to Yii.The test uses AngularJS's [$httpBackend](http://docs.angularjs.org/api/ngMock.$httpBackend) to fake a backend.To run the unit tests,in your command line,run ```grunt test:unit ```.
### End To End (e2e) Tests
*Make sure you have Java Runtime installed in your machine.*

Open ```test\protractor.conf.js```.You must specify the domain base url of your virtual host as ```baseUrl```.For example ```baseUrl:'http://rest.dev'```.Do the same in ```params.DOMAIN```.Last,set ```params.BASE_URL``` to be the application base URL-default is```\music_db_src\```.
You can find some sample tests in ```test\e2e ```.Make sure the data used in these tests is actual data in the database.Protractor acts like a robot,it will start the browser and perform actions like a real user,(navigate to a url,click a button, etc).See [Protractor API](https://github.com/angular/protractor/blob/master/docs/api.md) for more details.When you have everything set up and ready,run ```grunt test:e2e ```,and the tests will run.

You can run both unit and e2e test in one go with ``` grunt test```.

### Code Coverage
You can get code coverage reports with ```grunt test:coverage```.This task will genarate html code coverage reports in ```coverage``` folder.

## Production

When you compile the project for production,a ```music_db```folder will be generated,sibling to ```music_db_src ```.Before you compile for production,you must change ```APP_BASE_URL``` in ```music_db_src\config\Constants.ts ```.Remember,it was ```\music_db_src\``` for development,now it has to change to ```\music_db\```.In `Gruntfile.js`in `env` task,make sure ```env.prod.BASEURL``` is also set to ```\music_db\```.
In ```App.ts```,uncomment(enable) the ```templates-main``` module,and in ```loader.js ``` uncomment  ```views``` in final require call.Last,run ```grunt prod```.This task will compile the typescript files, compile the ```index.tpl.html``` file ,concatenate and minify all javascript files (single minified javascript file output),concatenate and minify the css,minify the one and only html file,bake partial html files into a single ```views.js```file which will be merged with the rest of the javascript,optimize the images and last,copy all files to ```music_db```.Point the browser to ```\music_db ``` and the application should load.


**NOTICE**.
_It is recommended that you stick with the dependency versions declared in ```package.json```,```bower.json ``` as the application is fine tuned to use these.This is specially true with code that is under rapid development like angular-ui-router and Protractor._

_Please consider that my instructions are based on my Windows7 development environment,I guess most of it is valid no matter what your environment is._

## LICENSE
Angular Music Database is released under the [WTFPL](http://sam.zoy.org/wtfpl/) license.This means that you can literally do whatever you want with this software.

## RESOURCES

* [AngularJS](http://angularjs.org/)
* [TypeScript](http://typescriptlang.org) 
* [Yii framework](http://www.yiiframework.com/)
* [RESTFullYii](http://evan108108.github.io/RESTFullYii/)
* [Restangular](https://github.com/mgonto/restangular)
* [Angular Gallery Manager](https://github.com/drumaddict/angular-yii)
* [RequireJS](http://requirejs.org/)
* [node.js](http://nodejs.org/)
* [Grunt](http://gruntjs.com/)
* [Bower](http://bower.io/)
* [AngularStrap](http://mgcrea.github.io/angular-strap/)
* [AngularUI](http://angular-ui.github.io/)
* [AngularUI Router](https://github.com/angular-ui/ui-router/)
* [angular-table](https://github.com/ssmm/angular-table)
* [John Lindquist's Egghead.io](http://www.youtube.com/playlist?list=PLP6DbQBkn9ymGQh2qpk9ImLHdSH5T7yw7)
* [YearOfMoo](http://www.yearofmoo.com)
* [Jasmine](http://pivotal.github.io/jasmine/)
* [Karma Test Runner](http://karma-runner.github.io/)
* [Protractor](https://github.com/angular/protractor)
* [Toastr](http://codeseven.github.io/toastr/)
* [Noty](http://needim.github.io/noty/)
* [spin.js](http://fgnass.github.io/spin.js/)
* [Bootswatch](http://bootswatch.com/)
* [DefinitelyTyped](https://github.com/DefinitelyTyped/DefinitelyTyped)
